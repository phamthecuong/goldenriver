<?php

namespace Modules\core\models;

use App\Models\Model;

class RoleUser extends Model
{
    protected $table = 'user_role';
    protected $primaryKey = ['user_id', 'role_id'];

}
