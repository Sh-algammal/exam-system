<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        //validation
    $request->validated();

    //hash password
        $hash_password=Hash::make($request->password);

        //create user
        $user=User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$hash_password,
        ]);

        //create token
        $token=$user->createToken("APiToken")->plainTextToken;

           return response()->json([
            "success"=>true,
            "message"=> "user created successfully",
            "token"=>$token,
        ],201);

    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $user=User::where("email",$request->email)->first();

        if(!$user || !Hash::check($request->password,$user->password))
            {
                return response()->json([
                    "success"=>false,
                    "message"=>"Invalid email or password",
                    ],403);
                    }

                    $token=$user->createToken("ApiToken")->plainTextToken;

                         return response()->json([
                "success"=>true,
                "token"=>$token,
                "user"=> new UserResource($user),
            ],200);


                    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
              return response()->json([
                    "success"=>true,
                    "message"=>"user logout successfully",
                ],200);

    }

}
