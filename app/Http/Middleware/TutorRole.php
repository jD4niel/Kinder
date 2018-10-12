<?php

namespace App\Http\Middleware;

use Closure;

class TutorRole
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

        if ($role == 2 || $role ==3) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
