<?php

namespace Modules\core\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\core\models\Permission;
use Modules\core\models\Role;
use Modules\core\models\RolePermission;
use Modules\core\repository\RoleRepository;

class RoleController extends Controller
{
    public $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index(Request $request)
    {
        $roles = $this->roleRepository->index($request);

        return view('core::role.index', ['roles' => $roles, 'params' => $request->all()]);
    }

    public function create()
    {
        return view('core::role.create');
    }

    public function view($id)
    {

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Role::getInstance()->rules());

        if ($validator->failed()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        $create = $this->roleRepository->store($request);

        if ($create) {
            session()->flash('success', __('Create successfully'));
            return redirect()->route('admin.core.role.index');
        }

        return redirect()->back()->withErrors(__('Create unsuccessfully'))->withInput($request->all());
    }

    public function update()
    {

    }

    public function permission($id)
    {
        $model = $this->roleRepository->findModel($id);
        $permission = $this->roleRepository->permission();

        return view('core::role.permission', ['model' => $model, 'permissionGroup' => $permission]);
    }

    public function addPermissionRole(Request $request, $id)
    {
        if ($this->roleRepository->rolePermission($request, $id)) {
            session()->flash('success', __('Update successfully'));
            return redirect()->back();
        }

        return redirect()->back()->withErrors(__('Update unsuccessfully'));
    }
}
