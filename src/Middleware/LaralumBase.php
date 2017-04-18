<?php

namespace Laralum\Laralum\Middleware;

use Aitor24\Localizer\Middlewares\LocalizerMiddleware as Localizer;
use Closure;
use Laralum\Laralum\Injector;
use Laralum\Laralum\Packages;

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
        $localizer->setLang();

        return $next($request);
    }
}
