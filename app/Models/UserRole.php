<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;

class UserRole extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'role_id',
    ];

    /**
     * ユーザIDとRoleIDを紐づけます。
     *
     * @param userId: string
     * @param roleId: string
     * @return userRole
     **/
    public static function link($userId, $roleId)
    {
        return UserRole::create([
            'user_id' => $userId,
            'role_id' => $roleId,
        ]);
    }

    /**
     * 自身のrole_idよりRoleを取得します。
     *
     * @return role | null
     **/
    public function getRole()
    {
        return Role::where($this->rold_id)->first();
    }
}


