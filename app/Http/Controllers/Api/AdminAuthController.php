<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','unique:admins,email'],
            'phone' => ['nullable','string','max:30'],
            'password' => ['required', Password::min(6)],
        ]);

        $data['password'] = Hash::make($data['password']);
        $admin = Admin::create($data);

        $token = $admin->createToken('admin_token')->plainTextToken;

        return response()->json(['token' => $token, 'admin' => $admin], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $admin->createToken('admin_token')->plainTextToken;

        return response()->json(['token' => $token, 'admin' => $admin]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete(); // يمسح كل التوكينات
        return response()->json(['message' => 'Logged out']);
    }
}
