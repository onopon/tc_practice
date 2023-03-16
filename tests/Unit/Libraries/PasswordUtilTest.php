<?php

namespace Tests\Unit\Libraries;

use Tests\TestCase;
use App\Libraries\PasswordUtil;

class PasswordUtilTest extends TestCase
{
    public function test_toHash()
    {
        $pu = new PasswordUtil();
        $plain = 'password';
        $hash = $pu->toHash($plain);
        // Q1 - 1. $hashが文字列であることをテストしてください。
        $this->assertIsString($hash);
        // Q1 - 2. $plainと$hashの値が異なることをテストしてください。
        $this->assertNotEquals($plain, $hash);

    }

    public function test_isCorrectTrue()
    {
        $pu = new PasswordUtil();
        $plain = 'password';
        $hash = $pu->toHash($plain);
        $this->assertTrue($pu->isCorrect($plain, $hash));
    }

    public function test_isCorrectFalse()
    {
        // Q2. test_isCorrectTrueを参考にして、
        //     isCorrectメソッドがfalseになる状況となるテストコードを書いてください。
        $pu = new PasswordUtil();
        $hash = $pu->toHash("password");
        $this->assertFalse($pu->isCorrect("wrong password", $hash));
    }
}
