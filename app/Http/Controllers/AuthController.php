<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class AuthController extends Controller
{
    public function createaccount(Request $request)
    {

        $account = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phone' => 'required',
            'country' => 'required|string|max:255',
            'shop_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $userid = Str::random(7).now();

        $user = User::create([
            'user_id'=> $userid,
            'fullname' => $account['fullname'],
            'username' => $account['username'],
            'phone' => $account['phone'],
            'country' => $account['country'],
            'shop_name' => $account['shop_name'],
            'email' => $account['email'],
            'password' => Hash::make($account['password']),
        ]);

      return  response([
            'status' => 'success',
            'user' => $user,
            'message' => 'Account created successfully',
            'token' => $user->createToken('tokens')->plainTextToken
        ],200);

        
    }

    public function login (Request $request)
    {
        $account = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if (!auth()->attempt($account)) {
            return [
                'status' => 'failed',
                'message' => 'invalid email address'
            ];
        }

        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return  response([
            'status' => 'success',
            'user' => $user,
            'message' => 'login successful',
            'token' => $user->createToken('tokens')->plainTextToken
        ],200);
    }

    public function signOut(Request $request)
    {
      //  auth('sanctum')->user()->token()->delete();
    $request->user()->tokens()->delete();


        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ],200);
    }
   

}