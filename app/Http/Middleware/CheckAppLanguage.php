<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CheckAppLanguage {
    public function handle(Request $request, Closure $next) {
        $app_lang = $request->header('app_language', 'es');

        // Check correct lang values
        if (! in_array($app_lang, ['en', 'es'])) {
            $app_lang = config('app.locale');
        }

        App::setLocale($app_lang);

        return $next($request);
    }
}
