<?php namespace App\Http\Middleware;

use Closure;

class RedirectIfCantManageUserInformation
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
        if (session('extra_permissions')['users_info_manage']) {
            return $next($request);
        }
        return redirect('services');
    }

}
