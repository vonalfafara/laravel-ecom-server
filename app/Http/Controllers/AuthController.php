<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            "username" => "required|string|unique:users,username",
            "first_name" => "required|string",
            "last_name" => "required|string",
            "middle_name" => "nullable|string",
            "email" => "required|string|unique:users,email|email",
            "password" => "required|string|confirmed"
        ]);

        $user = User::create([
            "username" => $fields["username"],
            "first_name" => $fields["first_name"],
            "last_name" => $fields["last_name"],
            "middle_name" => $fields["middle_name"],
            "email" => $fields["email"],
            "password" => bcrypt($fields["password"])
        ]);

        $token = $user->createToken("test")->plainTextToken;

        return response([
            "user" => $user,
            "token" => $token
        ], 201);
    }
    
    public function login(Request $request) {
        $fields = $request->validate([
            "username" => "required|string",
            "password" => "required|string"
        ]);

        $user = User::where("username", $fields["username"])->first();

        if (!$user || !Hash::check($fields["password"], $user->password)) {
            return response([
                "message" => "Username or password is incorrect"
            ], 401);
        }

        $token = $user->createToken("test")->plainTextToken;

        return response([
            "user" => $user,
            "token" => $token
        ], 200);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return response([
            "message" => "Logged out"
        ], 200);
    }
}
