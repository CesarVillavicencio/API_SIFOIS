<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LogViewerAccess {
    public function handle(Request $request, Closure $next) {
       
        if ($request->session()->has('admin_user_data')) {

            $admin_user_data = json_decode(Crypt::decryptString($request->session()->get('admin_user_data')));

            if ($admin_user_data->type == 'suadmin') {
                return $next($request);
            }

            return response('Unauthorized - Admin User is not suadmin', 405);
        }

        return response('Unauthorized - Admin User is not logged in', 405);
    }
}
