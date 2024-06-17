<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class FileHelpers {

    public static function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision).' '.$units[$pow];
    }

    public static function getStorageFilePath(string $path): string {
        if (Str::startsWith($path, "http")) return $path;
        return "storage/".$path;
    }

}
