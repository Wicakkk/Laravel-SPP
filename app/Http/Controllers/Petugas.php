<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class Petugas extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->level != 'petugas') {
            return redirect()->intended('login');
        }


        return redirect()->route('pembayaran.index');
    }
}
