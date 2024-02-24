<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AgencyResource;
use App\Models\Agency;
use App\Services\AgencyService;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AgencyController extends Controller
{

    use HttpResponses;

    private $service;

    public function __construct(AgencyService $service) 
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agencies = $this->service->getAgencies();

        return AgencyResource::collection($agencies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'bank_name' => 'required|string',
                'name' => 'required|string',
                'number' => 'required|int',
                'address' => 'required|string',
                'code' => 'required|int'
            ]);
    
            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            }
    
            $created = Agency::create($validator->validated());
    
            if($created){
                return $this->response('Agency registered', 200);
            }
        } catch (Exception $exception) {
            Log::error("An error occurred during on creating. Details: {$exception->getMessage()}");
            return response()->json(['error' => 'An error occurred during on create.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $agencies = $this->service->getAgencyByName($name);

        return new AgencyResource($agencies);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $agency = $this->service->find($id);
            if(!$agency){
                return $this->error('Agency not found', 200);
            }

            $validator = Validator::make($request->all(), [
                'bank_name' => 'required|string',
                'name' => 'string',
                'number' => 'int',
                'address' => 'string',
                'code' => 'int'
            ]);

            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            }

            $this->service->update($agency->__get('id'), $request->all());
            return response()->json(['message' => 'Updated successfully', 'agency' => (new AgencyResource($this->service->find($id)))]);
        } catch (Exception $exception) {
            Log::error("An error occurred during on update. Details: {$exception->getMessage()}");
            return response()->json(['error' => 'An error occurred during on update.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agency = $this->service->find($id);

        if(!$agency) {
            return $this->error("Bank with id $id not found", 404);
        }

        $this->service->delete($id);
        return $this->response('Deleted successfully', 200);
    }
}
