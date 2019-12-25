<?php namespace App\Http\Middleware;

use Closure;

class RedirectIfFormNotSubmitted
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
        if (!session()->has('form_submitted')) {
            return redirect('services');
        }

        return $next($request);
    }

}
