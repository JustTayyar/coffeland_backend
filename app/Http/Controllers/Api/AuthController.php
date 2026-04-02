<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|min:3|max:50',
            'lastname'  => 'required|string|min:3|max:50',
            'address'   => 'required|string|min:5|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:8',
        ]);

        $user = User::create([
            'name'      => $validated['firstname'] . ' ' . $validated['lastname'],
            'firstname' => $validated['firstname'],
            'lastname'  => $validated['lastname'],
            'address'   => $validated['address'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Qeydiyyat uğurla tamamlandı!',
            'token'   => $token,
            'user' => [
                'id'        => $user->id,
                'name'      => $user->name,
                'firstname' => $user->firstname,
                'lastname'  => $user->lastname,
                'address'   => $user->address,
                'email'     => $user->email,
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'E-poçt və ya şifrə yanlışdır.'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Giriş uğurludur!',
            'token'   => $token,
            'user' => [
                'id'        => $user->id,
                'name'      => $user->name,
                'firstname' => $user->firstname,
                'lastname'  => $user->lastname,
                'address'   => $user->address,
                'email'     => $user->email,
                'role'      => $user->role, // Returning Role
                'shop_id'   => $user->shop_id // If they belong to a shop
            ]
        ], 200);
    }
}
