<?php

namespace Laralum\Laralum\Middleware;

use Closure;
use Laralum\Laralum\Packages;
use Laralum\Laralum\Injector;

class LaralumBase
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
        // Before request code

        foreach(Packages::all() as $package) {
            Injector::inject('laralum.base', $package);
        }

        return $next($request);
    }
}
