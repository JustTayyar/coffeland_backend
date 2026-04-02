<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class WorkerController extends Controller
{
    /**
     * Display a listing of the workers.
     */
    public function index()
    {
        $workers = User::where('role', 'worker')->orderBy('created_at', 'desc')->get();
        return response()->json($workers);
    }

    /**
     * Store a newly created worker in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'nullable|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6',
        ]);

        $worker = User::create([
            'name'      => $validated['firstname'] . ' ' . ($validated['lastname'] ?? ''),
            'firstname' => $validated['firstname'],
            'lastname'  => $validated['lastname'] ?? '',
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role'      => 'worker',
        ]);

        return response()->json(['message' => 'İşçi uğurla əlavə edildi', 'data' => $worker], 201);
    }

    /**
     * Update the specified worker in storage.
     */
    public function update(Request $request, $id)
    {
        $worker = User::findOrFail($id);

        if ($worker->role !== 'worker') {
            return response()->json(['message' => 'Bu istifadəçi işçi deyil'], 400);
        }

        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'nullable|string|max:255',
            'email'     => ['required','string','email','max:255', Rule::unique('users')->ignore($worker->id)],
            'password'  => 'nullable|string|min:6',
        ]);

        $worker->firstname = $validated['firstname'];
        $worker->lastname = $validated['lastname'] ?? '';
        $worker->name = $validated['firstname'] . ' ' . ($validated['lastname'] ?? '');
        $worker->email = $validated['email'];

        if (!empty($validated['password'])) {
            $worker->password = Hash::make($validated['password']);
        }

        $worker->save();

        return response()->json(['message' => 'İşçi məlumatları yeniləndi', 'data' => $worker]);
    }

    /**
     * Remove the specified worker from storage.
     */
    public function destroy($id)
    {
        $worker = User::findOrFail($id);
        
        if ($worker->role !== 'worker') {
            return response()->json(['message' => 'Bu istifadəçi işçi deyil'], 400);
        }

        $worker->delete();

        return response()->json(['message' => 'İşçi sistemdən silindi']);
    }
}
