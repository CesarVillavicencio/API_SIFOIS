<?php

namespace App\Http\Middleware;

use Closure;

class IsAjax {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (! $request->ajax()) {
            // Handle the non-ajax request
            return response('Unauthorized', 405);
        }

        return $next($request);
    }
}

