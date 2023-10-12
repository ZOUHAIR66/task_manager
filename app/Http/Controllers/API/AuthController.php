<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('my_token')->plainTextToken;
            $response = [
                'success' => true,
                'token' => $token,
                'id'=>$user->id,
                'message' => 'User Logged Successfully'
            ];
            return response()->json($response);
        }


        $response = [
            'success' => false,
            'message' => 'Your Not Registred'
        ];
        return response()->json($response, 401);
    }

    public function register(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $token = $user->createToken('my_token')->plainTextToken;
        $response = [
            'success' => true,
            'token' => $token,
            'id'=>$user->id,
            'message' => 'User Registred Successfully'
        ];
        return response()->json($response);
    }
    public function logout()
    {
        try {
            Session::flush();
            $response = [
                'success' => true,
                'message' => 'Logout Successfully'
            ];
        } catch (QueryException $exeption) {
            $response = [
                'success' => false,
                'message' => $exeption->getMessage()
            ];
        }
        return response()->json($response);
    }
}
