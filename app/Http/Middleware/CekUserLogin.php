<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  $request
     * @param  \Closure $next
     * @param mixed $rules
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $rules): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $user = Auth::user();
        if ($user->level !== $rules) {
            return redirect('login')->withErrors([
                'belumLogin' => "Anda Tidak Memiliki Akses",
            ]);
        }
        return $next($request);
    }
}
