<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response ;


class AuthTokensController extends Controller
{
    public function index (Request $request)
    {
        return $request->user()->tokens;
    }

    public function store (Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'device_name' => 'required',
            'permissions' => 'array',
            'fcm_token'=> 'nullable',
        ]);

        $user = User::where('email','=', $request->email)->first();
        if($user && Hash::check($request->password , $user->password))
        {
            $token = $user->createToken($request->device_name,['*']);
            return Response::json([
                'token'=> $token->plainTextToken ,
                'user' => $user ,
            ],201);
        }
        return Response::json([
            'message' => 'invalid credentials',
        ],401);
    }

    public function destroy ($id)
    {
        $user = Auth::guard('sanctum')->user();
        //logout current device
        //$user->currentAccessToken()->delete();
        //logout all devices
        //$user->tokens()->delete();
        //delete once device
        $user->tokens()->findOrFail($id)->delete();
        return [
            'message' => 'token deleted',
        ];

    }
}
