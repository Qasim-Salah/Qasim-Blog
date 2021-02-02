<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if (Auth::check()) {
            $role = Auth::user()->role_id;
            if ($role <= 2) {
                return $next($request);
            } else {
                return redirect(route('user.dashboard'));
            }
        } else {
            return redirect(route('user.dashboard'));

        }
    }
}



