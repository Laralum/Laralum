<?php

namespace Laralum\Laralum\Middleware;

use Closure;

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

        $response = $next($request);

        // After request code

        return $response;
    }
}
