<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon as Carbon;

class demoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->session()->flash('time', Carbon::now());

        return $next($request);
    }
}
