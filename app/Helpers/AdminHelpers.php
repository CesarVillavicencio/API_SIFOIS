<?php

namespace App\Helpers;

use App\Models\Admin\Configuration;
use App\Models\AdminUser;
use Artisan;
use Carbon\Carbon;
use Exception;
use Storage;
use Log;

class AdminHelpers {
    public static function getConfigurationData(): Configuration {
        return Configuration::first();
    }

    public static function getAdminUserCount(): int {
        return AdminUser::count();
    }

    public static function getWeekDates(): string {
        $startOfWeek = Carbon::today()->startOfWeek();
        $endOfWeek = Carbon::today()->endOfWeek();

        $start_day = $startOfWeek->day;
        $start_month = $startOfWeek->month;

        $end_day = $endOfWeek->day;
        $end_month = $endOfWeek->month;

        $month_español = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        return $month_español[$start_month - 1].' '.$start_day.' - '.$month_español[$end_month - 1].' '.$end_day;
    }

    public static function resetAdminConfig() {
        $options = config('admin.configuration');
        $configuration = Configuration::first();
        if ($configuration == null) {
            $configuration = Configuration::create(['options' => $options]);
        } else {
            $configuration->fill(['options' => $options]);
            $configuration->save();
        }

        // Crear link para la carpeta storage
        if (! Storage::exists(public_path('storage'))) {
            Artisan::call('storage:link');
        }

        self::copyDefaultAvatar();
        self::copyDefaultAdminLogo();
    }

    public static function copyDefaultAvatar(): bool {
        try {
            $directory = 'images/preparation/';
            Storage::disk('public')->put('admin/avatars/pablo.png', Storage::disk('real_public')->get($directory.'pablo.png'));
            Storage::disk('public')->put('users/avatars/pug.png', Storage::disk('real_public')->get($directory.'pug.png'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

        return true;
    }

    public static function copyDefaultAdminLogo(): bool {
        try {
            Storage::disk('public')->put(
                'admin/configuration/komvac-icon-144x144.png',
                Storage::disk('real_public')->get(
                    'images/preparation/komvac-icon-144x144.png'
                )
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

        return true;
    }

    public static function getInitialConfigurationTable(): string {
        return config('admin.configuration');
    }

    public static function formatBytes(int $bytes, int $precision = 2): string {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision).' '.$units[$pow];
    }
}
