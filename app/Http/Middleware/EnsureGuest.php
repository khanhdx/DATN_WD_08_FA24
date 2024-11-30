<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Kiểm tra nếu người dùng đã đăng nhập (auth)
       if (Auth::check()) {
        // Nếu đã đăng nhập, chuyển hướng đến trang chủ hoặc trang khác
        return redirect()->route('client.home');
    }

    // Nếu chưa đăng nhập, tiếp tục với request
    return $next($request);
    }
}
