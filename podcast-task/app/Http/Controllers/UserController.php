<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $response['user'] = UserResource::make($user);
        $response['access_token'] = $user->createToken('auth_token')->plainTextToken;

        return response()->success(__('strings.USER_STORED'), $response, 200);
    }

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages(['password' => __('strings.LOGIN_PASSWORD_INVALID')]);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $response['user'] = UserResource::make($user);
        $response['access_token'] = $user->createToken('auth_token')->plainTextToken;

        return response()->success(__('strings.AUTHENTICATION_LOGIN'), $response, 200);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->success(__('strings.AUTHENTICATION_LOGOUT'), [], 200);
    }
}
