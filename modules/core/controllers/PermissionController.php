<?php

namespace Modules\core\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\core\repository\PermissionRepository;

class PermissionController extends Controller
{
    public $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $users = $this->permissionRepository->getUser();
        $roles = $this->permissionRepository->getRole();

        return view('core::permission.index', ['users' => $users, 'roles' => $roles]);
    }

    public function permission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $addRole = $this->permissionRepository->permission($request);

        if ($addRole) {
            session()->flash('success', __('Update successfully'));
            return redirect()->back()->withInput($request->all());
        }

        return redirect()->back()->withInput($request->all())->withErrors(__('Update unsuccessfully'));
    }
}
