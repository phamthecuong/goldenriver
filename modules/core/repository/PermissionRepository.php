<?php


namespace Modules\core\repository;


use App\Constants\AppConstants;
use Illuminate\Http\Request;
use Modules\core\models\Role;
use Modules\core\models\User;

class PermissionRepository
{
    public function index()
    {
        
    }

    public function permission(Request $request)
    {
        $userId = $request->post('user_id');
        $user = User::query()->findOrFail($userId);
        $roles = $request->post('role');

        return $user->roles()->sync($roles);
    }

    public function getUser()
    {
        return User::query()->where('is_active', AppConstants::CHECKED)->get();
    }

    public function getRole()
    {
        return Role::all();
    }
}