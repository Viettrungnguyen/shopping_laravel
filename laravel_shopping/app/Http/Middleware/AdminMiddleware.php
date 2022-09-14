<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        foreach (auth()->guard('api')->user()->roles as $role) {
            if ($role->name == "admin") {
                return $next($request);
            }
            if ($role->name == "user") {
                return response()->json([
                    'message' => "Bạn không đủ quyền truy cập "
                ], 201);
            }
        }
        return response()->json([
            'message' => "Đăng nhập thất bại"
        ], 202);
    }
}
