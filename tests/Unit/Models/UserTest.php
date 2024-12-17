<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use App\Models\{User, Role, UserRole};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_register()
    {
        // Q4 Fakerを利用し、nameがランダム文字列となるようにしてください。
        $faker = \Faker\Factory::create('ja_JP');
        $loginId = $faker->userName;
        $name = $faker->name;
        $password = $faker->password();
        $birthday = $faker->dateTimeBetween('1day', '20year')->format('Y-m-d');
        User::register($loginId, $name, $password, $birthday);
        $user = User::whereLoginId($loginId)->first();
        $this->assertNotNull($user);

        $pwHash = $user->makeVisible('password')->toArray()['password'];
        $this->assertTrue(password_verify($password, $pwHash));
        $this->assertEquals($name, $user->name);
        $this->assertEquals($birthday, $user->birthday);
    }

    public function test_registerDuplicatedLoginId()
    {
        $faker = \Faker\Factory::create('ja_JP');
        $loginId = $faker->userName;
        $password = $faker->password();
        $birthday = $faker->dateTimeBetween('1day', '20year')->format('Y-m-d');
        User::register($loginId, 'name', 'password', '1990-01-01');

        $this->expectException(QueryException::class);
        User::register($loginId, 'name2', 'password2', '1991-01-01');
    }

    public function test_findWith()
    {
        $loginId = "loginId";
        $password = "password";
        $this->registerUser($loginId, $password);
        $result = User::findWith($loginId, $password);
        $this->assertInstanceOf(User::class, $result);
    }

    public function test_findWithUserNotFound()
    {
        $loginId = "loginId";
        $password = "password";
        $result = User::findWith($loginId, $password);
        $this->assertNull($result);
    }

    public function test_findWithPasswordFailed()
    {
        // Q5 本テストケースを完成させてください。
        $loginId = "loginId";
        $password = "password";
        $this->registerUser($loginId, $password);
        $result = User::findWith($loginId, "WrongPassword");
        $this->assertNull($result);
    }

    public function test_getRoleName()
    {
        $this->seed(RoleSeeder::class);
        $user = $this->registerUser();
        UserRole::link($user->id, Role::ID_ADMIN);
        $role = Role::find(Role::ID_ADMIN);
        $this->assertEquals($role->name, $user->getRoleName());
    }

    public function test_getSign()
    {
        // Q11 - 2  本テストケースを書き直してください。
        $user = $this->registerUser();
        $testData = [
            ['牡羊座', '1990-03-21'],
            ['牡羊座', '1990-04-19'],
            ['牡牛座', '1990-04-20'],
            ['牡牛座', '1990-05-20'],
            ['双子座', '1990-05-21'],
            ['双子座', '1990-06-21'],
            ['蟹座',   '1990-06-22'],
            ['蟹座',   '1990-07-22'],
            ['獅子座', '1990-07-23'],
            ['獅子座', '1990-08-22'],
            ['乙女座', '1990-08-23'],
            ['乙女座', '1990-09-22'],
            ['天秤座', '1990-09-23'],
            ['天秤座', '1990-10-23'],
            ['蠍座',   '1990-10-24'],
            ['蠍座',   '1990-11-22'],
            ['射手座', '1990-11-23'],
            ['射手座', '1990-12-21'],
            ['山羊座', '1990-12-22'],
            ['山羊座', '1991-01-20'],
            ['水瓶座', '1991-01-21'],
            ['水瓶座', '1991-02-18'],
            ['魚座',   '1991-02-19'],
            ['魚座',   '1990-03-20']
        ];
        foreach ($testData as $td) {
            [$expectedSign, $birthday] = $td;
            $user->birthday =  $birthday;
            $this->assertEquals($expectedSign, $user->getSign());
        }
    }

    private function registerUser($loginId = "loginId", $password = "password")
    {
        $faker = \Faker\Factory::create('ja_JP');
        $name = $faker->name;
        $birthday = "1990-09-01";
        return User::register($loginId, $name, $password, $birthday);
    }
}
