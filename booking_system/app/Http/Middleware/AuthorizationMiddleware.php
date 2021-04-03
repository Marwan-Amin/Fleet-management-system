<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'status' => false,
                'message' => "You are not authorized to perform this action",
                'data' => null
            ]);
        }
        return $next($request);
    }
}
