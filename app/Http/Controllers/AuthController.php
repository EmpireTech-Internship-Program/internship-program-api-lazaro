<?php

namespace App\Http\Controllers;


use App\Services\UserService;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use HttpResponses;
    
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            return $this->response('Authorized', 200, [
                'token' => $request->user()->createToken('apiToken')->plainTextToken
            ]);
        }
        return $this->response('Not Authorized', 403);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->response('Token Revoked', 200);
    }

    public function forgotPassword(Request $request, string $email)
    {
        try {
            $user = $this->service->getByEmail($email);
            if (!$user) {
                return $this->error('Email not found', 200);
            }

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return $this->error('data invalid', 422, $validator->errors());
            }

            $status = Password::RESET_LINK_SENT($request->only('email'));

            
        } catch (Exception $exception) {

        }
    }
}
