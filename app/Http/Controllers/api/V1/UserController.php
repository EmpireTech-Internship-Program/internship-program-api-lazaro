<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    use HttpResponses;

    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->service->getAll();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "userID" => 'required|string|unique:users',
                'email' => 'required|string|unique:users',
                'password' => 'required|min:12',
                'passwordConfirmation' => 'required|same:password'
            ]);
    
            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            }
            
            $userData = [
                'userID' => $request->input('userID'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ];
    
            $created = $this->service->create($userData);

            if($created){
                return $this->response('User created', 200);
            }
        } catch (Exception $exception) {
            Log::error("An error occurred during on creating. Details: {$exception->getMessage()}");
            return response()->json(['error' => 'An error occurred during on create.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->service->find($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = $this->service->find($id);
            if (!$user) {
                return $this->error('User not found', 200);
            }

            $validator = Validator::make($request->all(), [
                'userID' => 'required|string'
            ]);

            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            }

            $this->service->update($user->__get('id'), $request->all());
            return response()->json(['message' => 'Updated successfully', 'user' => (new UserResource($this->service->find($id)))]);
        } catch (Exception $exception) {
            Log::error("An error occurred during on update. Details: {$exception->getMessage()}");
            return response()->json(['error' => 'An error occurred during on update.'], 500);
        }
    }

    public function upload(Request $request, string $id)
    {
        try {
            $user = $this->service->find($id);
            if (!$user) {
                return $this->error('User not found', 200);
            }

            $validator = Validator::make($request->all(), [
                'profile_picture' => 'required|mimes:png,jpg,jpeg',
            ]);

            
            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            }

            $image = $request->file('profile_picture');
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $image->move(public_path('/uploads/'), $imageName);
            $user->profile_picture = $imageName;

            $this->service->update($user->__get('id'), $request->all());
            return response()->json(['message' => 'Updated successfully', 'user' => (new UserResource($this->service->find($id)))]);
        } catch (Exception $exception) {
            Log::error("An error occurred during on update. Details: {$exception->getMessage()}");
            return response()->json(['error' => 'An error occurred during on update.'], 500);
        }
    }
}