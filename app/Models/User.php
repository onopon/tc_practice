<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Libraries\PasswordUtil;
use \App\Exceptions\UserAlreadyExistsException;
use DateTime;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login_id',
        'name',
        'password',
        'birthday'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * ユーザを登録します。
     *
     * @param loginId: string
     * @param name: string
     * @param password: string
     * @param birthday: string(Y-m-d)
     * @return user
     **/
    public static function register($loginId, $name, $password, $birthday)
    {
        $pu = new PasswordUtil();
        return self::create([
            'login_id' => $loginId,
            'name'     => $name,
            'password' => $pu->toHash($password),
            'birthday' => $birthday
        ]);
    }

    /**
     * ユーザを探します。
     *
     * @param loginId: string
     * @param password: string
     * @return user | null
     **/
    public static function findWith($loginId, $password)
    {
        $user = self::whereLoginId($loginId)->first();
        if (!$user) return null;
        $pwHash = $user->makeVisible('password')->toArray()['password'];
        $pu = new PasswordUtil();
        if ($pu->isCorrect($password, $pwHash)) return $user;
        return null;
    }

    /**
     * 自身のRole名を取得します。
     *
     * @return string
     **/
    public function getRoleName()
    {
        return UserRole::where($this->user_id)->first()->getRole()->name;
    }

    /**
     * 自身の誕生日から星座を取得します。
     *
     * @return string
     **/
    public function getSign()
    {
        // Q9 - 1 本メソッドのロジックを書いてください。
        return '乙女座';
    }
}
