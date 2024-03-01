<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordController extends Controller
{
    public function showResetForm(Request $request, $token, $username = null)
{
    return view('auth.reset', ['token' => $token, 'username' => $username]);
}


    public function reset(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
            'token' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['username' => 'Username not found.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password has been reset successfully.');
    }

    public function broker()
    {
        return Password::broker();
    }
}
