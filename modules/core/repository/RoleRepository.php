<?php


namespace Modules\core\repository;


use Illuminate\Http\Request;
use Modules\core\models\Permission;
use Modules\core\models\PermissionGroup;
use Modules\core\models\Role;
use Modules\core\models\RolePermission;

class RoleRepository
{
    public function index(Request $request)
    {
        $sortOrder = $request->get('sort_order') ? $request->get('sort_order') : 'asc';
        $sortBy = $request->get('sort_by') ? $request->get('sort_by') : 'created_at';
        $title = $request->get('keyword') ? $request->get('keyword') : '';

        $query = Role::query();

        if ($title) {
            $query->where('name', 'like', "%$title%");
        }

        $roles = $query->orderBy($sortBy, $sortOrder)->paginate(25);

        return $roles;
    }

    public function store(Request $request)
    {
        return Role::create($request->all());
    }

    public function permission()
    {
        $permission = PermissionGroup::query()->get();

        return $permission;
    }

    public function rolePermission(Request $request, $id)
    {
        $model = $this->findModel($id);

        $permissions = $request->post('permission');

        $permissions = array_keys(array_filter($permissions, function ($permissions) {
            return $permissions == 1;
        }));

        return $model->permissions()->sync($permissions);
    }

    public function findModel($id)
    {
        return Role::query()->findOrFail($id);
    }
}