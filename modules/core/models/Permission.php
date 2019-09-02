<?php

namespace Modules\core\models;


use App\Models\Model;

class Permission extends Model
{
    protected $table = 'permission';
    protected $primaryKey = 'name';
    protected $fillable = ['name', 'description', 'group_id'];
    public $incrementing = false;
}
