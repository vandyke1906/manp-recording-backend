<?php

namespace App\Http\Controllers;

use App\Models\ApplicationFiles;
use Illuminate\Http\Request;
use App\Http\Requests\Storeapplication_filesRequest;
use App\Http\Requests\Updateapplication_filesRequest;

use App\Classes\ApiResponseClass;
use App\Interfaces\ApplicationFilesInterface;
use \Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Constants\Roles;
use Illuminate\Support\Facades\Storage;

class ApplicationFilesController extends Controller
{
    private ApplicationFilesInterface $interface;

    public function __construct(ApplicationFilesInterface $obj){
        $this->interface = $obj;

    }

    public function index(){ }
    public function create(){ }
    public function store(Storeapplication_filesRequest $request){ }
    public function show($id, Request $request) {
        if(!$id) return response()->json(['message' => 'File not found.'], 404);
        if (!$request->hasValidSignature()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }
        
        $application_file = $this->interface->getById($id);
        if(!$application_file){
            return response()->json(['message' => 'File not found.'], 404);
        }
        
        $user = $request->user();
        if($user->id != $application_file->application->user_id && $user->role == Roles::PROPONENTS){
            return response()->json(['message' => 'Unauthorized access.'], 403);
        }
        
        $path = storage_path('app' . DIRECTORY_SEPARATOR .'private' . DIRECTORY_SEPARATOR .$application_file->file_path);

        if (!file_exists($path)) {
            return response()->json(['message' => 'File not found'], 404); 
        }

        return response()->file($path, [
            'Content-Type' => $application_file->file_type,
            'Content-Disposition' => 'inline; filename="' . $application_file->file_name . '"'
        ]);
        
        
        // //return response(Storage::disk('local')->get($application_file->file_path), 200)->header('Content-Type', $application_file->file_type);
        // $relativePath = $application_file->file_path;
        // $mime = Storage::disk('local')->mimeType($relativePath);
        // $content = Storage::disk('local')->get($relativePath);

        // return response($content, 200)
        //     ->header('Content-Type', $mime)
        //     ->header('Content-Disposition', 'inline; filename="' . $application_file->file_name . '"');
    }
    public function edit($id, Request $request) { }
    
    public function update(Updateapplication_filesRequest $request, $id)
    {
        $key = collect($request->allFiles())->keys()->first();
        $file = $request->file($key);
        Log::info($file);

        if ((!$file || !$file->isValid()) && !$request->business_name) {
            return ApiResponseClass::sendResponse([], 'No valid file uploaded.', 422, false);
        }

        if ($file instanceof UploadedFile && !$file->getError()) {
            $mimeType = $file->getClientMimeType();
            $folder_business = Str::slug($request->business_name);
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$key}.{$extension}";
            $filePath = $file->storeAs("application_files/{$folder_business}", $fileName);
            $data_file = [
                'name' => $key,
                'file_name' => $fileName,
                'file_size' => $file->getSize(),
                'file_type' => $mimeType,
                'file_path' => $filePath,
            ];
            Log::debug($data_file);
            Log::info($id);
            $this->interface->update($data_file, $id);
            return ApiResponseClass::sendResponse([],'Application file updated.',201);
        } else {
            Log::warning("Error uploading $key");
            return ApiResponseClass::sendResponse([], 'Upload Failed',500, false);
        }
    }
    public function destroy($id, Request $request){ }
}
