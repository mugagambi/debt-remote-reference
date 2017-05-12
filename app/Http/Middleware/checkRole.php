<?php

namespace App\Http\Middleware;

use Closure;

class checkRole
{
    /**
     * Handle an incoming request.
     * This middle checks that user with roleA does not navigate to restricted routes accessible by only roleB
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->role != 'roleB') {
            flash('Sorry! You are not allowed to perform that action')->error()->important();
            return redirect('home');
        }
        return $next($request);
    }
}
