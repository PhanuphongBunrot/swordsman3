<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckUser
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Session::get('authenticated')) {
            // If not authenticated, redirect to login page
            return redirect('/login');
        }

        return $next($request);
    }
}