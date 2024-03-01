<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
{
    $user = Auth::user();
    $active = 'Profile';
    return view('auth.reset', compact('user', 'active'));
}


   public function update(Request $request)
{
       
    $user = Auth::user()->id;
        $akun = User::find($user);
    
        $akun->nama = $request->name;
        $akun->username = $request->username;
        $akun->password = $request->password;
        $akun->save();
    
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
}

}

