<?php

namespace App\Helpers;

class MetasHelper {
    // https://github.com/davmixcool/laravel-meta-manager
    protected static function defaultMetas() {
        return [
            'title' => env('META_TITLE'),
            'description' => env('META_DESCRIPTION'),
            'image' => env('META_IMAGE'),
            'author' => env('META_AUTHOR'),
            'geo_position' => env('META_GEO_POSITION'),
            'geo_region' => env('META_GEO_REGION'),
            'keyword' => env('META_KEYWORD'),
            'fb_app_id' => env('META_FBAPPID'),
        ];
    }

    public static function getDefaultMetas($newMetas = []) {
        $metas = self::defaultMetas();

        return array_replace($metas, $newMetas);
    }
}
