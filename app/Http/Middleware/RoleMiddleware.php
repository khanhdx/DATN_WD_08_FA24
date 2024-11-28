<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        $user = Auth::user();

        if (!$user) {
            //return redirect()->route('login');
            return $next($request);
        }

        if ($user->role === $role) {
            return $next($request);
        }

        // Chuyển hướng dựa trên vai trò
        if ($user->role === 'Khách hàng') {
            return redirect()->route('client.home');
        }

        if ($user->role === 'Quản lý') {
            return redirect()->route('admin.dashboard');
        }

        return abort(403, 'Unauthorized action.');
    }
}
