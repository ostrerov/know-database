<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class RolesMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $allowAccess = false;

        if(auth()->check())
        {
            foreach($roles as $role) {
                if($request->user()->role->name === $role) {
                    $allowAccess = true;
                }
            }
        }

        if(!$allowAccess) {
            if (Auth::check()) {
                abort(403);
            }

            return redirect()->route('login');
        }

        return $next($request);
    }
}
