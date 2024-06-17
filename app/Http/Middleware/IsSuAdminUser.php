<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSuAdminUser {
    public function handle(Request $request, Closure $next) {
        if (auth()->check() && auth()->user()->type == 'suadmin' && auth()->user()->blocked_at == null) {
            return $next($request);
        }

        return response()->json([
            'message'    => 'Solo super administradores pueden acceder',
            'errors'     => [],
            'error_name' => 'not authorized',
        ], 405);
    }
}
