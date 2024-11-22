<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();
        if (!$user || $user->role_id != $role) {
            Session::flash('error', 'Bạn không có quyền truy cập trang này');
            return redirect()->route('home');
        }
        return $next($request);
    }
}

