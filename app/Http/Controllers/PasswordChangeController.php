<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function showForm()
    {
        return view('auth.password-change');
    }

    public function update(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->force_password_change = false;
        $user->save();

        return redirect()->route('dashboard')->with('success', __('passwords.changed'));
    }
}
