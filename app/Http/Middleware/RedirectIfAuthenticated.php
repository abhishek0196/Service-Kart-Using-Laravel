<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch($guard)
        {
            case 'admin':
            if (Auth::guard($guard)->check()) {
                return redirect('/admin/home');
            }
            break;
            case 'customer':
            if (Auth::guard($guard)->check()) {
                return redirect('/customer/home');
            }
            break;
            case 'serviceprovider':
            if (Auth::guard($guard)->check()) {
                return redirect('/serviceprovider/home');
            }
            break;
            default:
            return redirect()->guest(route('login'));
                break;

        }
       

        return $next($request);
    }
}
