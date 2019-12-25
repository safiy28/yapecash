<?php namespace App\Http\Middleware;

use Closure;

class RedirectIfCantPurchase
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
        if (session('extra_permissions')['purchase']) {
            return $next($request);
        }
        return redirect('services');
    }

}
