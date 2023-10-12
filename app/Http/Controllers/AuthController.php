<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showUsers(Request $request)
    {
        $user = User::all();
        return $this->successResponse($user, '', 'user List');
    }


    //
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);


        $password = Hash::make($request->password);
        $validator['password'] = $password;

        $user = User::create($validator);

        $token = $user->createToken($user->name)->plainTextToken;

        if ($user) {
            return $this->successResponse($user, $token, 'User Created');
        }
        return $this->errorResponse('fail Create User');
    }


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['User Logout with Delete Tokens']);
    }
}
