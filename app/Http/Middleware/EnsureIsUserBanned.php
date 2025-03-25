<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsUserBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(auth()->user());
        if (auth()->check()) {
            if (auth()->user()->isbanned != 0) {
                $message = 'Ваш учётная запись заблокирована!';
                auth()->logout();
                return redirect()->route('home')->withErrors(["error" => $message]);
            }
        }

        return $next($request);
    }
}
