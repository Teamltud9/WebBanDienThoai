<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json([
                'code' => 401,
                'time' => now()->toISOString(),
                'error' => 'Bạn chưa đăng nhập!'
            ], 401);
        }

        if (!Auth::guard('api')->check()) {
            return response()->json([
                'code' => 401,
                'time' => now()->toISOString(),
                'error' => 'Token không hợp lệ hoặc đã hết hạn!'
            ], 401);
        }


        if (Auth::guard('api')->user()->isDeleted) {
            return response()->json([
                'code' => 423 ,
                'time' => now()->toISOString(),
                'error' => 'Tài khoản của bạn đã bị vô hiệu hóa!'
            ], 423);
        }

        return $next($request);
    }
}
