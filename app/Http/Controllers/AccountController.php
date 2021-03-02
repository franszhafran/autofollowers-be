<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\JWTAuthenticationService;

class AccountController extends Controller
{
    public function __construct(
        private JWTAuthenticationService $authenticationService,
    ) {}

    public function login(LoginRequest $request) {
        try {
            $user = User::firstOrCreate([
                "username" => $request->username,
                "password" => $request->password,
            ]);

            $token = $this->authenticationService->createToken($user->id);

            return $this->sendOk($token);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }    
    }
}   
