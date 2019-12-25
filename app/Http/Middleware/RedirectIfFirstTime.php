<?php namespace App\Http\Middleware;

use Closure;

class RedirectIfFirstTime
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session('first_time')) {
            return redirect('profile/changeLogin');
        }
        return $next($request);
    }


}
