<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('layouts.main', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $updateType = $request->input('update_type');

        if ($updateType === 'profile') {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
            ]);

            // Update profile info
            $user = User::findOrFail($id);
            $user->update($validatedData);

            return back()->with('success', 'Profile updated successfully!');
        }
        elseif ($updateType === 'password') {
            $validatedData = $request->validate([
                'current_password' => 'required|current_password',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Update password
            $user = User::findOrFail($id);
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            return back()->with('success', 'Password changed successfully!');
        }

        return back()->with('error', 'Invalid update request');
    }
}
