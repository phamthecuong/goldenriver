<?php

namespace Modules\core\models;


use App\Models\Model;

class PermissionGroup extends Model
{
    protected $table = 'permission_group';
    protected $primaryKey = 'group_id';
    protected $fillable = ['title', 'description'];

    public function getPermission()
    {
        return $this->hasMany(Permission::class, 'group_id', 'group_id');
    }
}
