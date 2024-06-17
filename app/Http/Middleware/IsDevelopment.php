<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDevelopment {
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (env('APP_DEBUG') === false) {
            return response('Unauthorized', 405);
        }

        return $next($request);
    }
}
