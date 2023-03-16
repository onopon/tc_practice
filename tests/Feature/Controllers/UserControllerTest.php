<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use App\Models\{User, Role, UserRole};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    public function test_login()
    {
        $response = $this->get('/user/login');
        $response->assertStatus(200);
    }

    public function test_mypage()
    {
        $loginId = "loginId";
        $password = "password";
        $this->createAdminUserAndLogin($loginId, $password);
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_mypageIfNotLogin()
    {
        $response = $this->get('/');
        $response->assertStatus(302)
            ->assertRedirect('/user/login');
    }
}
