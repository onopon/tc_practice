<?php
namespace App\Libraries;

class PasswordUtil
{
    /**
     * passwordをHash化します。
     *
     * @param password: string
     * @return string
     */
    public function toHash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * 生のpasswordとHash化されてるpasswordを比較し、合っているかどうかを確認します。
     *
     * @param password: string
     * @param passwordHash: string
     * @return bool
     */
    public function isCorrect($password, $passwordHash)
    {
        return password_verify($password, $passwordHash);
    }
}
