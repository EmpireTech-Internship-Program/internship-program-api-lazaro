<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AccountResource;
use App\Models\Account;
use App\Services\AccountService;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    use HttpResponses;

    protected $service;

    public function __construct(AccountService $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = $this->service->getAccounts();

        return AccountResource::collection($accounts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'person_cpf' => 'required|string',
                'agency_name' => 'required|string',
                'type' => 'required|string',
                'number' => 'required|string',
                'holder' => 'required|string',
                'opening_balance' => 'required|int',
                'opening_date' => 'required|date'
            ]);
    
            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            }
    
            $created = $this->service->create($validator->validated());

            if($created){
                return $this->response('Account registered', 200);
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
        $account = $this->service->getAccountByName($name);
        
        return new AccountResource($account);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $account = $this->service->find($id);
            if (!$account) {
                return $this->error('Bank not found', 200);
            }
    
            $validator = Validator::make($request->all(), [
                'person_cpf' => 'required|string',
                'agency_name' => 'required|string',
                'type' => 'string',
                'number' => 'string',
                'holder' => 'string',
                'opening_balance' => 'int',
                'opening_date' => 'date'
            ]);
    
            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            } 
    
            $this->service->update($account->__get('id'), $request->all());
            return response()->json(['message' => 'Updated successfully', 'account' => (new AccountResource($this->service->find($id)))]);
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
        $account = $this->service->find($id);

        if(!$account) {
            return $this->error("account with id $id not found", 404);
        }

        $this->service->delete($id);
        return $this->response('Deleted successfully', 200);
    }
}
