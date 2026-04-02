<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Get the authenticated admin's profile.
     */
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Update admin profile details and optionally password.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'email'     => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => 'nullable|required_with:new_password|string', 
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->email = $validated['email'];

        // If new password is provided, verify old password and update
        if (!empty($validated['new_password'])) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return response()->json(['message' => 'Hazırkı şifrə yanlışdır.'], 400);
            }
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return response()->json([
            'message' => 'Profil məlumatları uğurla yeniləndi.',
            'user' => $user
        ]);
    }
}
