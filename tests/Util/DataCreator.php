<?php

namespace Tests\Util;

use Tests\TestCase;
use App\Libraries\UserUtil;
use App\Models\Role;

trait DataCreator
{
    public function createAdminUser($loginId, $password)
    {
        $faker = \Faker\Factory::create('ja_JP');
        $name = $faker->name;
        $birthday = "1990-09-01";

        return UserUtil::registerWithRole(
            $loginId,
            $name,
            $password,
            $birthday,
            Role::ID_ADMIN);
    }

    public function createAdminUserAndLogin($loginId, $password)
    {
        $user = $this->createAdminUser($loginId, $password);
        $this->post(
            '/user/login',
            [
                'login_id' => $loginId,
                'password' => $password
            ]
        );
        return $user;
    }
}
?>
