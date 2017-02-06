<?php

namespace Laralum\Laralum\Middleware;

use Auth;
use Closure;

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

        return $next($request);
    }
}
