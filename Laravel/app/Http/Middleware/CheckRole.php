<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            foreach ($roles as $role) {
                if (Auth::user()->hasRole($role)) {
                    return $next($request);
                }
            }
        }

        return abort(403, 'Acesso não autorizado!');
    }
}
