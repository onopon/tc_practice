<?php
namespace App\Libraries;
use \App\Models\{User, Role, UserRole};
use \App\Exceptions\RoleDoesNotExistException;
use DateTime;

class UserUtil
{
    /**
     * roleと一緒にユーザ登録を行います。
     * 
     * @param loginId: string
     * @param name: string
     * @param password: string
     * @param birthday: string(Y-m-d)
     * @param roleId: int
     * @return user
     */
    public static function registerWithRole($loginId, $name, $password, $birthday, $roleId)
    {
        if (! Role::exists($roleId)) throw new RoleDoesNotExistException();
        $user = User::register($loginId, $name, $password, $birthday);
        UserRole::link($user->id, $roleId);
        return  $user;
    }
}
