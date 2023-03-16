<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Role extends Model
{
    const ID_ADMIN = 1;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * $roleIdがroles table内に存在するかどうかを確認します。
     *
     * @param roleId: int
     * @return bool
     **/
    public static function exists($roleId)
    {
        // Q3 - 1 tests/Unit/Models/RoleTest.php のテストケースをパスできるようにロジックを書いてください。
        return true;
    }
}
