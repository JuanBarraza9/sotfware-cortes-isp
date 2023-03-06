<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        $role = "";

        if(auth()->check()){
            if ( $request->user()->role === 'admin' ) {
                $role = "admin";
            } elseif ($request->user()->role === 'empleado') {
                $role = 'empleado';
            } elseif($request->user()->role === 'user') {
                $role = 'user';
            }
        }
        

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::dashboardDinamic($role));
            }
        }

        return $next($request);
    }
}
