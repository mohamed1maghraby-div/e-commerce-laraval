<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiCheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->api_password != env("API_PASSWORD", 'RTYxas@$dasd*%^&')){
            return response()->json(['message' => 'Unauthenticated.']);
        }

        return $next($request);
    }
}
