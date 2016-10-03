<?php

namespace Laralum\Laralum\Middleware;

use Closure;

class LaralumBase
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->session()->get('laralum_menu')){
            $request->session()->put('laralum_menu', []);
        }

        $response = $next($request);

        $request->session()->forget('laralum_menu');

        return $response;
    }

}
