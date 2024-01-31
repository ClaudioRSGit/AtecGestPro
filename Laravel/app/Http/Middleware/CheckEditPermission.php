<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class CheckEditPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = $request->route('user');
        $loggedInUser = Auth::user();

        if ($loggedInUser && $loggedInUser->hasRole('funcionario') && $loggedInUser->id == $userId) {
            return $next($request);
        }

        return redirect()->route('master.main')->with('error', 'Sem permissão para acessar essa página.');
    }
}
