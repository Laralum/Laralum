<?php

namespace Laralum\Laralum\Middleware;

use Auth;
use Closure;
use Laralum\Laralum\Packages;
use Laralum\Laralum\Injector;

class LaralumAuth
{
    /**
     * Run the request filter.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('laralum::login')->with('warning', 'You need to log in first');
        }

        foreach(Packages::all() as $package) {
            Injector::inject('laralum.auth', $package);
        }

        return $next($request);
    }
}
