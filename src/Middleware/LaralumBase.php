<?php

namespace Laralum\Laralum\Middleware;

use Closure;
use Laralum\Laralum\Injector;
use Laralum\Laralum\Packages;
use Aitor24\Localizer\Middlewares\LocalizerMiddleware as Localizer;

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

        foreach (Packages::all() as $package) {
            Injector::inject('laralum.base', $package);
        }

        // Setting locale
        $localizer = new Localizer();
        $localizer->handle($request, $next);

        return $next($request);
    }
}
