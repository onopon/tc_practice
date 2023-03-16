<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use App\Models\{User, Role, UserRole};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class LogoutControllerTest extends TestCase
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
        $user = $this->createAdminUserAndLogin($loginId, $password);
        $this->assertInstanceOf(User::class, Auth::user());
        $response = $this->post('/user/logout');
        // Q6 ログアウト完了後、
        // 　 ・ページ遷移はどうなるのか
        //  　・Auth::user()はどうなるのか
        // 　 をassertで表現してください。
        $response->assertStatus(302)
            ->assertRedirect('/');
        $this->assertNull(Auth::user());
    }
}
