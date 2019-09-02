<?php

namespace Modules\core\models;


use App\Models\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'role_id';
    protected $fillable = ['name', 'description'];

    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'description' => 'nullable|max:255'
        ];
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'role_permission','role_id','permission')->withTimestamps();
    }
    
    public function getPermissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'role_id');
    }
}
