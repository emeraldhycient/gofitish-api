<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



class AuthController extends Controller
{
    public function createaccount(Request $request)
    {

        $account = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phone' => 'required|digit:11',
            'address' => 'string|max:255',
            'country' => 'required|string|max:255',
            'shop_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'fullname' => $account['fullname'],
            'username' => $account['username'],
            'phone' => $account['phone'],
            'address' => $account['address'],
            'country' => $account['country'],
            'shop_name' => $account['shop_name'],
            'email' => $account['email'],
            'password' => Hash::make($account['password']),
        ]);

        return $this->success([
            'token' => $user->createToken('tokens')->plainTextToken
        ]);
    }

    public function login (Request $request)
    {
        $account = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if (!auth()->attempt($account)) {
            return $this->error('Invalid credentials');
        }

        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $this->success([
            'token' => $user->createToken('tokens')->plainTextToken
        ]);
    }

    public function signOut(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
   

}