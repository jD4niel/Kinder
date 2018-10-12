<?php

namespace App\Http\Middleware;

use Closure;

class AdministratorRole
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
        $role = $request->user()->role_id;

        if ($role == 1) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
