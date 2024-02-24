<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PersonResource;
use App\Models\Person;
use App\Services\PersonService;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{

    use HttpResponses;

    protected $service;

    public function __construct(PersonService $service) 
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = $this->service->getPeople();

        return PersonResource::collection($people);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required|string',
                'date_of_birth' => 'required|date',
                'cpf' => 'required|string',
                'address' => 'required|string',
                'phone_number' => 'required|string',
                'email' => 'required|string'
            ]);
    
            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            }

            $created = $this->service->create($validator->validated());
    
            if($created) {
                return $this->response('Person registered', 200);
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
        $person = $this->service->getPersonByName($name);

        return new PersonResource($person);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $person = $this->service->find($id);
            if (!$person) {
                return $this->error('Bank not found', 200);
            }
    
            $validator = Validator::make($request->all(), [
                'fullname' => 'string',
                'date_of_birth' => 'date',
                'cpf' => 'string',
                'address' => 'string',
                'phone_number' => 'string',
                'email' => 'string',
            ]);
    
            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            } 
    
            $this->service->update($person->__get('id'), $request->all());
            return response()->json(['message' => 'Updated successfully', 'person' => (new PersonResource($this->service->find($id)))]);
        } catch (Exception $exception) {
            Log::error("An error occurred during on updating. Details: {$exception->getMessage()}");
            return response()->json(['error' => 'An error occurred during on update.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $person = $this->service->find($id);

        if(!$person) {
            return $this->error("Bank with id $id not found", 404);
        }

        $this->service->delete($id);
        return $this->response('Deleted successfully', 200);
    }
}
