<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Проверка роли пользователя
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Если роль не совпадает, перенаправляем на главную страницу
        return redirect('/');
    }
}
