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
        // Q11 - 1 本メソッドのロジックを書いてください。
        $datetime = new DateTime($this->birthday);
        $monthDate = (int)"{$datetime->format('n')}{$datetime->format('j')}";
        if ((int)"0121" <= $monthDate && $monthDate <= (int)"0218") {
            return "水瓶座";
        } elseif ((int)"0219" <= $monthDate && $monthDate <= (int)"0320") {
            return "魚座";
        } elseif ((int)"0321" <= $monthDate && $monthDate <= (int)"0419") {
            return "牡羊座";
        } elseif ((int)"0420" <= $monthDate && $monthDate <= (int)"0520") {
            return "牡牛座";
        } elseif ((int)"0521" <= $monthDate && $monthDate <= (int)"0621") {
            return "双子座";
        } elseif ((int)"0622" <= $monthDate && $monthDate <= (int)"0722") {
            return "蟹座";
        } elseif ((int)"0723" <= $monthDate && $monthDate <= (int)"0822") {
            return "獅子座";
        } elseif ((int)"0823" <= $monthDate && $monthDate <= (int)"0922") {
            return "乙女座";
        } elseif ((int)"0923" <= $monthDate && $monthDate <= (int)"1023") {
            return "天秤座";
        } elseif ((int)"1024" <= $monthDate && $monthDate <= (int)"1122") {
            return "蠍座";
        } elseif ((int)"1123" <= $monthDate && $monthDate <= (int)"1221") {
            return "射手座";
        } else {
            // 1222 - 0120
            return "山羊座";
        }
    }
}
