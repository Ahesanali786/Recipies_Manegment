<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLogin
{
    public function handle(Request $request, Closure $next)
    {
        // Agar user login nahi hai to error page pe redirect kare
        if (!Auth::check()) {
            return redirect('error');
        }

        return $next($request);
    }
}
