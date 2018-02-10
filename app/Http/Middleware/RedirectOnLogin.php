<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class RedirectOnLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        if (Auth::guard($guard)->check()) {
//            echo Request::url();
//
//            die();
//            if (Request::is('admin')) {
//                $role = Auth::user()->roles->first()->toArray();
//                $number = str_replace('Postbemanning ', '', $role['name']);
//
//                return redirect('/admin#/admin/form/' . $number);
//            }
//
//
//        }

        return $next($request);
    }
}
