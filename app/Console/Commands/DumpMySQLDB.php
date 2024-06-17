<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class DumpMySQLDB extends Command {
    protected $signature = 'mysql:dump';
    protected $description = 'Dump Actual App Mysql DB Command';
    public function handle() {

        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        $directory = config("filesystems.disks.mysqlbackups.root");
        if (! File::isDirectory($directory)) {
            File::makeDirectory($directory, 0777, true, true);
        }

        $config = $this->getOrCreateConfigFile($directory, $username, $password);
        
        shell_exec("mysqldump --defaults-extra-file={$config} {$database} | gzip > {$directory}/{$database}.sql.gz");

        $this->info("backup created at {$directory}/{$database}.sql.gz!");
    }

    protected function getOrCreateConfigFile(string $directory, string $username, string $password) {
        $file = $directory."/config.cnf";
        File::delete($file);
        $config = fopen($file, "w");
        fwrite($config, "[client]\n");
        fwrite($config, "user = {$username}\n");
        fwrite($config, "password  = {$password}\n");
        fclose($config);
        return $file;
    }
}
