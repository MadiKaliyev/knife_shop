<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        // Проверяем, является ли пользователь администратором
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Если нет, перенаправляем на главную страницу или страницу с ошибкой
        return redirect('/');
    }
}
