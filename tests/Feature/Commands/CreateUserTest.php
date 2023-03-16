<?php

namespace Tests\Feature\Commands;

use Tests\TestCase;
use App\Libraries\UserUtil;
use Database\Seeders\RoleSeeder;
use App\Models\{User, Role, UserRole};
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\Exceptions\RoleDoesNotExistException;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_handle()
    {
        $this->seed(RoleSeeder::class);
        $loginId = 'onopon';
        $name = 'おのぽん';
        $password = "password";
        $birthday = "1990-09-01";
        $console = $this->artisan("create:user --loginId={$loginId} --name={$name} --password={$password} --birthday={$birthday}");
        $console->assertExitCode(0);
        $console->expectsOutput("SUCCESS to create user! loginId: ${loginId} password: {$password}");
    }

    public function test_handleExceptionOccured()
    {
        $console = $this->artisan("create:user");
        $console->assertExitCode(1);
        $console->expectsOutput("FAIL to create user. A role id you selected does not exist in the table.");
    }
}
