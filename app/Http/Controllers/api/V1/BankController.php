<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BankResource;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Services\BankService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{

    use HttpResponses;

    protected $service;

    public function __construct(BankService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = $this->service->getBanks();

        return BankResource::collection($banks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'code' => 'required|string|max:4',
            ]);
    
            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            }
    
            $created = $this->service->create($validator->validated());
    
            if($created) {
                return $this->response('Bank registered', 200);
            }
        } catch(Exception $exception) {
            Log::error("An error occurred during on creating. Details: {$exception->getMessage()}");
            return response()->json(['error' => 'An error occurred during on create.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $bank = $this->service->getBankByName($name);

        return new BankResource($bank);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $bank = $this->service->find($id);
            if (!$bank) {
                return $this->error('Bank not found', 200);
            }
    
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'code' => 'string|max:4'
            ]);
    
            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            } 
    
            $this->service->update($bank->__get('id'), $request->all());
            return response()->json(['message' => 'Updated successfully', 'bank' => (new BankResource($this->service->find($id)))]);
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
        $bank = $this->service->find($id);

        if(!$bank) {
            return $this->error("Bank with id $id not found", 404);
        }

        $this->service->delete($id);
        return $this->response('Deleted successfully', 200);
    }
}
