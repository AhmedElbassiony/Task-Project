<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->loginCredentials();

        if(!auth()->attempt($credentials)) {
            return api_response(false, 'These credentials do not match our records.', [], 422);
        }

        return api_response(true, 'login successfully', new UserResource(auth()->user()));

      }
    }



