<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class IsAdminUserBlocked {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next) {
        if (! $request->is('admin/logout')) {
            if (auth()->check() && isset(auth()->user()->blocked_at)) {
                return response()->json([
                    'server_unauthorized' => true,
                    'server_error_reason' => 'blocked admin user',
                    'blocked_at'          => auth()->user()->blocked_at,
                ], 403);
            }
        }

        return $next($request);
    }
}
