<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    

     
     protected function redirectTo($request)
    {
   
        // Check if the user is authenticated for API
        if (!$this->auth->guard('api')->check()) {
            // If not authenticated, return a 401 Unauthorized response
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // If it's a web request (non-API), perform the standard redirection
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
