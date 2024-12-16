<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckTokenExpiration
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->remember_token) {
            $tokenCreatedAt = $user->tokens()->latest()->first()->created_at;
            $tokenLifetime = now()->diffInMinutes($tokenCreatedAt);

            if ($tokenLifetime > 30) {
                $user->tokens()->delete();
                return response()->json([
                    'message' => 'Token expired. Please login again.',
                    'status' => false,
                ], 401);
            }
        }

        return $next($request);
    }
}
