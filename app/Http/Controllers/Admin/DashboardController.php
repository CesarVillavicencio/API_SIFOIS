<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\Blog\Post;
use App\Models\Gallery\Photo;

class DashboardController extends Controller {
    public function getLatestUsers() {
        $users = AdminUser::orderBy('created_at', 'desc')->take(5)->get();

        return response()->json($users);
    }

    public function getLatestPosts() {
        $posts = Post::with(['category', 'admin_user'])
        ->orderBy('created_at', 'desc')->take(5)->get();

        return response()->json($posts);
    }

    public function getLatestPhotos() {
        $photo = Photo::with(['category', 'admin_user'])
        ->orderBy('created_at', 'desc')->take(5)->get();

        return response()->json($photo);
    }

    public function getServerStats() {
        $data = [];

        // Hard Disk
        $ds = disk_total_space('/');
        $df = disk_free_space('/');
        $disk_progress = round(($df * 100) / $ds, 2);
        $free_space = $ds - $df;
        $data['disk'] = [
            'ds' => $ds,
            'df' => $df,
            'disk_progress' => $disk_progress,
            'free_space' => $free_space,
        ];

        // Memory
        $memUsage = $this->getServerMemoryUsage(false);
        $data['memory'] = [
            'used' => $this->getNiceFileSize($memUsage['total'] - $memUsage['free']),
            'total' => $this->getNiceFileSize($memUsage['total']),
            '%' => round($this->getServerMemoryUsage(true), 2),
        ];

        // CPU
        if (stripos(PHP_OS, 'WIN') === 0) {
            $data['cpu'] = [
                'load' => 0,
            ];
        } else {
            $load = sys_getloadavg();
            $data['cpu'] = [
                'load' => $load[0],
            ];
        }

        // Server Up Time
        if (stripos(PHP_OS, 'WIN') === 0) {
            $data['uptime'] = [
                'secs' => 0,
                'mins' => 0,
                'hours' => 0,
                'days' => 0,
            ];
        } else {
            $str = @file_get_contents('/proc/uptime');
            $num = floatval($str);
            $secs = fmod($num, 60);
            $num = (float) intdiv((int) $num, 60);
            $mins = $num % 60;
            $num = (float) intdiv((int) $num, 60);
            $hours = $num % 24;
            $num = (float) intdiv((int) $num, 24);
            $days = $num;

            $data['uptime'] = [
                'secs' => $secs,
                'mins' => $mins,
                'hours' => $hours,
                'days' => $days,
            ];
        }

        return response()->json($data);
    }

    // Returns used memory (either in percent (without percent sign) or free and overall in bytes)
    protected function getServerMemoryUsage($getPercentage = true) {
        $memoryTotal = null;
        $memoryFree = null;

        if (stristr(PHP_OS, 'win')) {
            // Get total physical memory (this is in bytes)
            $cmd = 'wmic ComputerSystem get TotalPhysicalMemory';
            @exec($cmd, $outputTotalPhysicalMemory);

            // Get free physical memory (this is in kibibytes!)
            $cmd = 'wmic OS get FreePhysicalMemory';
            @exec($cmd, $outputFreePhysicalMemory);

            if ($outputTotalPhysicalMemory && $outputFreePhysicalMemory) {
                // Find total value
                foreach ($outputTotalPhysicalMemory as $line) {
                    if ($line && preg_match('/^[0-9]+$/', $line)) {
                        $memoryTotal = $line;
                        break;
                    }
                }

                // Find free value
                foreach ($outputFreePhysicalMemory as $line) {
                    if ($line && preg_match('/^[0-9]+$/', $line)) {
                        $memoryFree = $line;
                        $memoryFree = (float) $memoryFree * 1024;  // convert from kibibytes to bytes
                        break;
                    }
                }
            }
        } else {
            if (is_readable('/proc/meminfo')) {
                $stats = @file_get_contents('/proc/meminfo');

                if ($stats !== false) {
                    // Separate lines
                    $stats = str_replace(["\r\n", "\n\r", "\r"], "\n", $stats);
                    $stats = explode("\n", $stats);

                    // Separate values and find correct lines for total and free mem
                    foreach ($stats as $statLine) {
                        $statLineData = explode(':', trim($statLine));

                        //
                        // Extract size (TODO: It seems that (at least) the two values for total and free memory have the unit "kB" always. Is this correct?
                        //

                        // Total memory
                        if (count($statLineData) == 2 && trim($statLineData[0]) == 'MemTotal') {
                            $memoryTotal = trim($statLineData[1]);
                            $memoryTotal = explode(' ', $memoryTotal);
                            $memoryTotal = $memoryTotal[0];
                            $memoryTotal = (float) $memoryTotal * 1024;  // convert from kibibytes to bytes
                        }

                        // Free memory
                        if (count($statLineData) == 2 && trim($statLineData[0]) == 'MemFree') {
                            $memoryFree = trim($statLineData[1]);
                            $memoryFree = explode(' ', $memoryFree);
                            $memoryFree = $memoryFree[0];
                            $memoryFree = (float) $memoryFree * 1024;  // convert from kibibytes to bytes
                        }
                    }
                }
            }
        }

        if (is_null($memoryTotal) || is_null($memoryFree)) {
            return null;
        } else {
            if ($getPercentage) {
                return 100 - ($memoryFree * 100 / $memoryTotal);
            } else {
                return [
                    'total' => $memoryTotal,
                    'free' => $memoryFree,
                ];
            }
        }
    }

    protected function getNiceFileSize($bytes, $binaryPrefix = true) {
        if ($binaryPrefix) {
            $unit = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];
            if ($bytes == 0) {
                return '0 '.$unit[0];
            }

            return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2).' '.(isset($unit[$i]) ? $unit[$i] : 'B');
        } else {
            $unit = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
            if ($bytes == 0) {
                return '0 '.$unit[0];
            }

            return @round($bytes / pow(1000, ($i = floor(log($bytes, 1000)))), 2).' '.(isset($unit[$i]) ? $unit[$i] : 'B');
        }
    }
}
