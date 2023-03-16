<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_exists()
    {
        $this->seed(RoleSeeder::class);
        $roles = Role::all();
        foreach ($roles as $r) {
            $this->assertTrue(Role::exists($r->id));
        }
    }

    public function test_existsRoleDoesNotExist()
    {
        // Q3 - 2 markTestSkipped メソッドを削除しても、本テストケースが通ることを確認してください。
        $this->assertFalse(Role::exists(1));
    }
}
