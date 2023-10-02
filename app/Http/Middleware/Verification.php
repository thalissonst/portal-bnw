<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class Verification
{

    /**
     * Handle an incoming request.
     * @return mixed
     */
    public function handle($request, $next)
    {
        // If the user doesn't have the correct role
        if(auth()->user()->permission != 'admin')
        {
            return redirect()->route('dashboard');
        }  

        return $next($request);
    }
}
