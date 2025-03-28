<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware 
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::guard('api')->user();
           
        if ($user->role->roleName !== $role) {
            return response()->json([
                'code' => 403,
                'time' => now()->toISOString(),
                'error' => 'Bạn không có quyền truy cập!'
            ], 403);
        }
        return $next($request);
    }
}
