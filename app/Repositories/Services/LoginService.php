<?php

namespace App\Repositories\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoginService
{
    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Set token expiration time in minutes, casting to integer
            $expiration = (int) config('session.lifetime');

            // Generate token with expiry
            $token = $user->createToken('MyApp', ['*'], now()->addMinutes($expiration))->plainTextToken;


            // Append token and expiry to the response data
            $user['token'] = $token;
            $user['expires_at'] = Carbon::now()->addMinutes($expiration);


            return [
                'status' => true,
                'data' => $user,
                'message' => 'User logged in successfully.',
                'statusCode' => 200,
            ];
        }else{
            return [
                'status' => false,
                'message' => 'The credentials do not match our records.',
                'statusCode' => 404,
            ];
        }
    }
}
