<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use App\Libraries\Api\Forecast;
use App\Models\{User, Role, UserRole};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Mockery;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $forecastMock;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);

        $this->forecastMock = Mockery::mock(Forecast::class);

    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_login()
    {
        $response = $this->get('/user/login');
        $response->assertStatus(200);
    }

    public function test_mypage()
    {
        // Q10. 定義されたforecastMockを使って、コントローラ内で利用されるForecastクラスの
        //      loadOverviewTextメソッドが呼び出されたときに、'dummy text'を返すように設定してください。
        //      skipを外してテストが実行できるようにしてください。
        $this->forecastMock
             ->shouldReceive('loadOverviewText')
             ->once()
             ->andReturn('dummy text');

        // forecastMockをコントローラ内のforecastの変わりに利用されるように設定
        $this->app->singleton(Forecast::class, function () {
            return $this->forecastMock;
        });

        $loginId = "loginId";
        $password = "password";
        $this->createAdminUserAndLogin($loginId, $password);

        $this->get('/')
             ->assertStatus(200)
             ->assertSee('dummy text');
    }

    public function test_mypageIfNotLogin()
    {
        $response = $this->get('/');
        $response->assertStatus(302)
                 ->assertRedirect('/user/login');
    }
}
