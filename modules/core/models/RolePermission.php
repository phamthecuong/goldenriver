<?php

namespace Modules\core\models;

use App\Models\Model;

class RolePermission extends Model
{
    protected $table = 'role_permission';
    protected $primaryKey = ['role_id', 'permission'];
    protected $fillable = ['role_id', 'permission'];
    public $incrementing = false;

    public function getPermission()
    {
        return $this->hasOne(Permission::class, 'name', 'permission');
    }

    public function getRole()
    {
        return $this->hasOne(Role::class, 'role_id', 'role_id')->with(['getPermission']);
    }
}
