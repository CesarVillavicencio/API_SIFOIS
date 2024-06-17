<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use AdminHelpers;

class ResetAdminConfiguration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset:configuration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Admin Configuration Values';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('*************************************');
        $this->info('Admin configuration to default values');
        $this->info('*************************************');

        AdminHelpers::resetAdminConfig();

        $this->info('Everything is fine!');
    }
}
