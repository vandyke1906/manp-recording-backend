<?php

namespace App\Http\Controllers;

use App\Models\Zoning;
use App\Http\Requests\StoreZoningRequest;
use App\Http\Requests\UpdateZoningRequest;

use Illuminate\Support\Facades\DB;
use App\Classes\ApiResponseClass;
use App\Interfaces\ZoningInterface;
use App\Http\Resources\ZoningResource;


class ZoningController extends Controller
{
    private ZoningInterface $interface;

    public function __construct(ZoningInterface $obj){
        $this->interface = $obj;
    }

    public function index()
    {
        $data = $this->interface->index()->sortBy('name')->values();;
        return ApiResponseClass::sendResponse(ZoningResource::collection($data),'',200);
    }

    public function create()
    {
    }

    public function store(StoreZoningRequest $request)
    {
        $details =[
            'name' => $request->name,
            'description' => $request->description,
        ];
        DB::beginTransaction();
        try{
             $obj = $this->interface->store($details);

             DB::commit();
             return ApiResponseClass::sendResponse(new ZoningResource($obj),'Zoning classification added successfully.',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    public function show($id)
    {
        $obj = $this->interface->getById($id);
        return ApiResponseClass::sendResponse(new ZoningResource($obj),'',200);
    }

    public function edit(Zoning $zoning)
    {
    }

    public function update(UpdateZoningRequest $request, $id)
    {
        
        $updateDetails =[
            'name' => $request->name,
            'description' => $request->description,
        ];
        DB::beginTransaction();
        try{
             $data = $this->interface->update($updateDetails,$id);
             DB::commit();
             return ApiResponseClass::sendResponse($data, 'Zoning classification updated successfully.',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
        $this->interface->delete($id);
        return ApiResponseClass::sendResponse($id, 'Zoning classification deleted successfully.',201);
    }
}
