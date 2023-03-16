<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{Role};
use Database\Seeders\RoleSeeder;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;
    public function test_link()
    {
        $userId = 1;
        $roleId = 2;
        $ur = UserRole::link($userId, $roleId);
        $this->assertNotNull($ur);
        $this->assertEquals($ur->role_id, $roleId);
    }

    public function test_getRole()
    {
        $this->seed(RoleSeeder::class);
        $userId = 1;
        $roleId = 2;
        $ur = UserRole::link($userId, $roleId);
        $role = Role::find($roleId)->first();
        $this->assertEquals($role, $ur->getRole());
    }

    public function test_getRoleNotFound()
    {
        $userId = 1;
        $roleId = 2;
        $ur = UserRole::link($userId, $roleId);
        $this->assertNull($ur->getRole());
    }
}
