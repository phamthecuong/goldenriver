<?php

namespace Modules\core\models;


use App\Constants\AppConstants;
use Illuminate\Support\Facades\Auth;

class User extends \App\User
{
    protected $fillable = ['email', 'name', 'is_active', 'password'];

    public static function getInstance()
    {
        return new self();
    }
    
    public function rules()
    {
        return [
            'email' => 'required|email|max:100|unique:users',
            'name' => 'required|max:150',
            'is_active' => 'nullable|numeric|max:1',
            'password' => 'nullable|confirmed|min:6',
        ];
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id')->withTimestamps();
    }

    public function statisticUsers()
    {
        return self::query()->where('is_active', AppConstants::CHECKED)->count();
    }
}
