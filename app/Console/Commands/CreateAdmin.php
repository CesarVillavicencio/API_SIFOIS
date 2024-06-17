<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminUser;
use App\Models\Admin\Configuration;
use App\Helpers\AdminHelpers;
use Validator;

class CreateAdmin extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new admin user';

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
        $fake = $this->choice('Create default admin?', ['No', 'Yes'], 0);
        if ($fake === 'Yes') { $this->createDefaultAdminUser(); }
        else { while (!$this->createCustomAdminUser()){} }
    }

    protected function createDefaultAdminUser() {
        // Check if Exist!
        $user = AdminUser::where('email', 'admin@admin.com')->first();
        if ($user != null) { $this->info('Default Admin User exists!'); }
        else {
            $data = [
                'name'     => 'Admin',
                'lastname' => 'Admin',
                'email'    => 'admin@admin.com',
                'password' => 'admin',
                'type'     => 'suadmin',
                'avatar'   => env('DEFAULT_AVATAR_URL', null)
            ];

            $this->createAdminUser($data);
            $this->info('Admin User Created!');
        }
    }

    protected function createCustomAdminUser() {
        $data = [];
        $data['name'] = $this->ask('Admin user name');
        $data['lastname'] = $this->ask('Admin user lastname');
        $data['email'] = $this->ask('Admin user email');
        $data['password'] = $this->secret('Admin user password');
        $data['password_confirmation'] = $this->secret('Repeat password');
        

        $validator = Validator::make($data, [
            'name'     => 'required',
            'lastname' => 'required',
            'email'    => 'required|email|unique:admin_users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            foreach($validator->errors()->all() as $error) {
                $this->error('Error: ' . $error);
            }
            $this->info('--------------------------------------');
            return false;
        }

        $data['type'] = $this->choice('Admin user type:', config('admin.user_types'), 1);
        $data['avatar'] = env('DEFAULT_AVATAR_URL', null);

        $this->createAdminUser($data);
        $this->info('Admin User Created!');
        $this->checkFirstTime();

        return true;
    }

    protected function createAdminUser($data) {
        AdminUser::create([
            'name'     => $data['name'],
            'lastname' => $data['lastname'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'type'     => $data['type'],
            'avatar'   => $data['avatar']
        ]);
    }

    protected function checkFirstTime()
    {
        $configuration = Configuration::first();
        if ($configuration == null) {
            AdminHelpers::resetAdminConfig();
        }
    }
}
