<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class BearerTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {

        $token = $request->bearerToken();
    
    
        if ($request->is('api/login')) {
            return $next($request);
        }
    
        if (!$token) {
            return response()->json(['message' => 'Gunakan Auth Bearer'], 401);
        }
        if (!Auth::guard('sanctum')->check()) {
            return response()->json(['message' => 'Token tidak valid'], 401);
        }

    
        return $next($request);
    }
}
