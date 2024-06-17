<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isDevLocalOrStagging {
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'stagging') {
            return $next($request);
        } else {
            return response('Unauthorized', 405);
        }
    }
}
