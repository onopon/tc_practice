<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Libraries\UserUtil;
use App\Models\Role;
use App\Exceptions\RoleDoesNotExistException;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {--loginId=} {--name=} {--password=} {--birthday=} {--roleId=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'テストユーザを作成します。';

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
     * @return int
     */
    public function handle()
    {
        try {
            DB::transaction(function () {
                $loginId = $this->option('loginId') ?: 'test';
                $name = $this->option('name') ?: 'テストアカウント';
                $password = $this->option('password') ?: 'test';
                $birthday = $this->option('birthday') ?: '2000-01-01';
                $roleId = $this->option('roleId') ?: Role::ID_ADMIN;
                UserUtil::registerWithRole($loginId, $name, $password, $birthday, $roleId);
                $this->line("SUCCESS to create user! loginId: {$loginId} password: {$password}");
            });
        } catch (RoleDoesNotExistException $e) {
            $this->line("FAIL to create user. ". $e->getMessage());
            return 1;
        }
    }
}
