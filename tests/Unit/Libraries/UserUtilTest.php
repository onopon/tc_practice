<?php

namespace Tests\Unit\Libraries;

use Tests\TestCase;
use App\Libraries\UserUtil;
use Database\Seeders\RoleSeeder;
use App\Models\{User, Role, UserRole};
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\RoleDoesNotExistException;
use Illuminate\Database\QueryException;

class UserUtilTest extends TestCase
{
    use RefreshDatabase;

    public function test_registerWithRole()
    {
        $this->seed(RoleSeeder::class);
        $user = UserUtil::registerWithRole(
            'loginId',
            'name',
            'password',
            '1990-09-01',
            Role::ID_ADMIN);
        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(UserRole::class,
            UserRole::whereUserId($user->id)->first());
    }

    public function test_registerWithRoleExceptionOccured()
    {
        $this->expectException(RoleDoesNotExistException::class);
        UserUtil::registerWithRole(
            'loginId',
            'name',
            'password',
            '1990-09-01',
            Role::ID_ADMIN);
    }

    public function test_registerWithDuplicateIdExceptionOccured()
    {
        $this->seed(RoleSeeder::class);
        UserUtil::registerWithRole(
            'loginId',
            'name',
            'password',
            '1990-09-01',
            Role::ID_ADMIN);
        $this->expectException(QueryException::class);
        UserUtil::registerWithRole(
            'loginId',
            'name_2',
            'password_2',
            '2000-09-01',
            Role::ID_ADMIN);
    }
}
