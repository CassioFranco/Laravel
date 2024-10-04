<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(AuthRequest $request)
    {

        $user= User ::where('email',$request->email)->first();

        Hash::check($request->password, $user->password);

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages(
            [ 'email' => ['The provided credentials are incorrect']]
            );
        }

        // Logout others devices
        // if ($request->has('Logout_others_devices'))
        $user->tokens()->delete();

        $token = $user->createToker($request->device_name)->plainTextToken;

        return response()->json([
            'token'=>$token,

        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();



        return response()->json([
            'message'=>'success',

        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'me'=>$user,

        ]);
    }
}
