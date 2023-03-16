<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use App\Models\{User, Role, UserRole};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    public function test_attempt()
    {
        $loginId = "loginId";
        $password = "password";
        $user = $this->createAdminUser($loginId, $password);
        $this->assertNull(Auth::user());
        $response = $this->post(
            '/user/login',
            [
                'login_id' => $loginId,
                'password' => $password
            ]
        );
        $response->assertStatus(302)
            ->assertRedirect('/');
        $this->assertInstanceOf(User::class, Auth::user());
    }

    public function test_attemptFailed()
    {
        // Q7 本テストケースを埋めてください。
    }
}
