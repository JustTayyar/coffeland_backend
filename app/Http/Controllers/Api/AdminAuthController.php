<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function registerStaff(Request $request)
    {
        $validated = $request->validate([
            "name"      => "required|string|max:100",
            "email"     => "required|email|unique:users,email",
            "password"  => "required|string|min:6",
            "role"      => "required|in:admin,worker",
        ]);

        $user = User::create([
            "name"      => $validated["name"],
            "firstname" => current(explode(" ", $validated["name"])),
            "lastname"  => "",
            "email"     => $validated["email"],
            "password"  => Hash::make($validated["password"]),
            "role"      => $validated["role"],
        ]);

        return response()->json([
            "message" => "Yetkili şəxs və ya işçi uğurla yaradıldı!",
            "user" => [
                "id"        => $user->id,
                "name"      => $user->name,
                "email"     => $user->email,
                "role"      => $user->role,
            ]
        ], 201);
    }
}
