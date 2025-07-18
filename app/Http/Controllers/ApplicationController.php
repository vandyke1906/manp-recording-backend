<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\UploadedFile;
use App\Classes\ApiResponseClass;
use App\Models\Application;
use App\Models\Approval;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Constants\Roles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Interfaces\ApplicationInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Resources\ApplicationResource;


use App\Interfaces\ApplicantTypeApplicationInterface;
use App\Interfaces\ApplicationFilesInterface;

use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    private ApplicationInterface $interface;
    private ApplicantTypeApplicationInterface $applicant_application_interface;
    private ApplicationFilesInterface $application_files_interface;

    public function __construct(ApplicationInterface $obj){
        $this->interface = $obj;
        $this->applicant_application_interface = app(ApplicantTypeApplicationInterface::class);
        $this->application_files_interface = app(ApplicationFilesInterface::class);

    }

    public function index(Request $request)
    {
        $data = $this->interface->index($request->user(), $request->query('perPage', 10));
        return ApiResponseClass::sendResponse($data,'',200);
    }

    public function create()
    {
    }

    public function store(StoreApplicationRequest $request)
    {
        $user = (object)$request->user()->only(['id', 'first_name', 'middle_name', 'last_name', 'suffix', 'email']);
        $application_data =[
            'application_date' => $request->application_date,
            'first_name' => $user->first_name,
            'middle_name' => $user->middle_name,
            'last_name' => $user->last_name,
            'suffix' => $user->suffix,
            'email_address' => $user->email,
            'contact_number' => $request->telephone_number ? "{$request->mobile_number}, {$request->telephone_number}"  : "{$request->mobile_number}",
            'address' => $request->address,
            'user_id' => $user->id,
            'application_type_id' => $request->application_type_id,
            'business_name' => $request->business_name,
            'business_address' => $request->business_address,
            'business_description' => $request->business_description,
            'business_nature_id' => $request->business_nature_id,
            'business_status_id' => $request->business_status_id,
            'capitalization_id' => $request->capitalization_id,
            'business_type_id' => $request->business_type_id,
        ];
        $application_files = [
            'proof_of_capitalization' => $request->proof_of_capitalization,
            'barangay_clearance' => $request->barangay_clearance,
            'birth_certificate_or_id' => $request->birth_certificate_or_id,
            'ncip_document' => $request->ncip_document,
            'fpic_certification' => $request->fpic_certification,
            'business_permit' => $request->business_permit, 
        ];
        if ($request->hasFile('authorization_letter')) {
            $application_files['authorization_letter'] = $request->authorization_letter;
        }

        DB::beginTransaction();
        try{
            $application = $this->interface->store($application_data);

            //application applicant_types
            foreach ($request->applicant_type_id as $app_type_id) {
                $this->applicant_application_interface->store(['application_id' => $application->id, 'applicant_type_id' => $app_type_id]);
            }

            //application files
            $folder_business = Str::slug($request->business_name);
            foreach ($application_files as $key => $file) {
                if ($file instanceof UploadedFile && !$file->getError()) {
                    // $mimeType = $file->getClientMimeType();
                    $mimeType = $file->getMimeType();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = "{$key}.{$extension}";
                    $tempPath = 'application_files' . DIRECTORY_SEPARATOR . $folder_business . DIRECTORY_SEPARATOR . $fileName;
                    $filePath = $file->storeAs($tempPath);
                    $data_file = [
                        'application_id' => $application->id,
                        'name' => $key,
                        'file_name' => $fileName,
                        'file_size' => $file->getSize(),
                        'file_type' => $mimeType,
                        'file_path' => $filePath,
                    ];
                    $this->application_files_interface->store($data_file);
                } else {
                    Log::warning("Error uploading $key");
                }
            }

            // Generate PDF summary
           // Generate PDF with static or custom data
            // Store the PDF
            $pdfFileName = 'sapa_application_form.pdf';
            // $pdfFilePath = "application_files{DIRECTORY_SEPARATOR}{$folder_business}{DIRECTORY_SEPARATOR}{$pdfFileName}";
            $pdfFilePath = 'application_files' . DIRECTORY_SEPARATOR . $folder_business . DIRECTORY_SEPARATOR . $pdfFileName;
            $pdf = Pdf::loadView('documents.sapa_application_template', [
                'title' => 'SAPA Application Form',
                'data' => $application,
            ])->setPaper('folio', 'portrait');

            Storage::put($pdfFilePath, $pdf->output(), ['visibility' => 'private','ContentType' => 'application/pdf']);

            // Save metadata like other files
            $data_file = [
                'application_id' => $application->id,
                'name' => 'sapa_application_form',
                'file_name' => $pdfFileName,
                'file_size' => Storage::size($pdfFilePath),
                'file_type' => 'application/pdf',
                'file_path' => $pdfFilePath,
            ];
            $this->application_files_interface->store($data_file);
            // Generate PDF summary

            //intial empty approval
            Approval::create([
                'application_id' => $application->id,
                'user_id' => null, // No one has approved yet
                'approving_role' => Roles::RPS_TEAM, // First approval step
                'status' => 'pending',
            ]);
            
            DB::commit();
            return ApiResponseClass::sendResponse([],'Application added successfully.',201);

        }catch(\Exception $ex){
            Log::error($ex->getMessage());
            return ApiResponseClass::rollback($ex);
        }
    }

    public function show($id, Request $request)
    {
        if(!$id) return ApiResponseClass::sendResponse([], 'Invalid Application.', 401, false);
        $user = $request->user();
        $application = $this->interface->getById($id, $user);
        if($application){
            $applicant_types = $this->applicant_application_interface->getByApplicationId($id);
            $application_type_ids = [];
            foreach ($applicant_types as $applicant_type) {
                $application_type_ids[] = $applicant_type->applicant_type_id;
            }
            $application->applicant_type_id = $application_type_ids;

            $application_files = $this->application_files_interface->getByApplicationId($id);

            $attachedFiles = [];
            $folder_business = Str::slug($application->business_name);
             foreach ($application_files as $file) {
                // Log::warning($file);
                // $signedUrl = URL::temporarySignedRoute('download-file', now()->addDay(), ['business_name' => $folder_business, 'file_name' => $file->file_name ]);
                $signedUrl = URL::temporarySignedRoute('download-file', now()->addDay(), ['id' => $file->id ]);
                $attachedFiles[] = [
                    'uri' => $signedUrl,
                    'file_id' => $file->id,
                    'title' => $file->name,
                    'name' => $this->humanReadable($file->name),
                    'file_type' => $file->file_type,
                    'file_size' => $file->file_size,
                    'file_name' => $file->file_name,
                    'updated_at' => $file->	updated_at,
                ];
            }
            $application->files = $attachedFiles; // Now safe to assign
            return ApiResponseClass::sendResponse($application,'',200);
        }
        return ApiResponseClass::sendResponse([], 'Invalid Application.', 401, false);
    }

    //Generate Signed URL
    public function getApplicationFile($id, $name, Request $request)
    {
        $userId = $request->user()->id;
        $userRole = $request->user()->role;
        $application  = null;
        if($userRole == hexdec(Roles::PROPONENTS))
            $application = Application::withTrashed()->where('id', $id)->where('user_id', $userId)->first();
        else 
            $application = Application::where('id', $id)->first();

        if (!$application) {
            return ApiResponseClass::sendResponse([], 'Application not found or unauthorized', 404);
        }

        // Find the file
        $application_file = $this->application_files_interface->getByApplicationAppIdAndName($application->id, $name);
        if (!$application_file) {
            return ApiResponseClass::sendResponse([], 'File not found or unauthorized', 404);
        }

        // Define the path inside Laravel's storage
        $folder_business = Str::slug($application->business_name);

        // Generate a **signed URL** that expires after a set duration
        //$signedUrl = URL::temporarySignedRoute('download-file', now()->addDay(), ['business_name' => $folder_business, 'file_name' => $application_file->file_name ]);
        $signedUrl = URL::temporarySignedRoute('download-file', now()->addDay(), ['id' => $$file->id ]);
        return response()->json([
            'uri' => $signedUrl,
            'file_id' => $application_file->id,
            'title' => $application_file->name,
            'file_type' => $application_file->file_type,
            'file_size' => $application_file->file_size,
            'file_name' => $application_file->file_name,
            'updated_at' => $application_file->	updated_at,
            'name' => $this->humanReadable($application_file->name),
        ]);
    }

    public function edit(Application $Application){}

    public function update(UpdateApplicationRequest $request, $id)
    {
        $updateDetails =[
            'name' => $request->name,
            'description' => $request->description,
        ];
        DB::beginTransaction();
        try{
             $data = $this->interface->update($updateDetails,$id);
             DB::commit();
             return ApiResponseClass::sendResponse($data, 'Application updated successfully.',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
        if($this->interface->delete($id))
            return ApiResponseClass::sendResponse($id, 'Application deleted successfully.',201);
        return ApiResponseClass::sendResponse([], 'Failed to delete application.',201, false);
    }

    function humanReadable($string) {
        return ucwords(str_replace('_', ' ', $string));
    }

}
