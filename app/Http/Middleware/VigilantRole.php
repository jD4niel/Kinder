<?php

namespace App\Http\Middleware;

use Closure;

class VigilantRole
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

        if ($role == 4) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
