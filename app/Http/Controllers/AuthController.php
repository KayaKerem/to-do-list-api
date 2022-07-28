<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {

        $request->validated();
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'is_admin'=>$request['is_admin'],
            'verification_number'=>strval(random_int(100000, 999999))
        ]);


        event(new UserRegistered($user));

        return $this->getUserWithToken($user);
    }
    public function login(LoginRequest $request): JsonResponse
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ],
                ]
            ], 422);
        }

        $user = User::where('email', $request['email'])->first();
        return $this->getUserWithToken($user);
    }


    private function getUserWithToken($user): JsonResponse
    {
        $authToken = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'access_token' => $authToken,
            'user' => new ProfileResource($user),

        ]);
    }
}
