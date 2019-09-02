<?php

namespace Modules\core\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Modules\core\models\User;
use Modules\core\models\UserProfile;
use Modules\core\repository\UserRepository;

class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->index($request);

        return view('core::users.index', ['users' => $users, 'params' => $request->all()]);
    }

    public function view($id)
    {
        $model = $this->userRepository->findModel($id);

        return view('core::users.view', ['model' => $model]);
    }

    public function create()
    {
        return view('core::users.create');
    }

    public function edit($id)
    {
        $model = $this->userRepository->findModel($id);
        return view('core::users.update', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $userRules = User::getInstance()->rules();
        $userRules['password'] = $userRules['password'] . '|required|min:6';
        $rules = array_merge($userRules, UserProfile::getInstant()->rules());

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        try{
            $user = $this->userRepository->store($request);

            if ($user) {
                session()->flash('success', __('Created successfully'));
                return redirect()->route('admin.core.user.index');
            }
            session()->flash('error', __('Created unsuccessfully'));
            return redirect()->back()->withInput($request->all());

        } catch (\Exception $exception) {
            return redirect()->back()->withInput($request->all())->withErrors($exception->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        $userRules = User::getInstance()->rules();
        $userRules['email'] = $userRules['email'] . ',id,' . $id;
        $userRules['email'] = str_replace('required|', '', $userRules['email']);
        $rules = array_merge($userRules, UserProfile::getInstant()->rules());
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        try{
            $user = $this->userRepository->update($request, $id);

            if ($user) {
                session()->flash('success', __('Update successfully'));
                return redirect()->route('admin.core.user.index');
            }
            session()->flash('error', __('Update unsuccessfully'));
            return redirect()->back()->withInput($request->all());

        } catch (\Exception $exception) {
            return redirect()->back()->withInput($request->all())->withErrors($exception->getMessage());
        }
    }

    public function delete($id)
    {
        if ($this->userRepository->delete($id)) {
            session()->flash('success', __('Remove successfully'));
            return redirect()->route('admin.core.user.index');
        }

        return redirect()->back()->withErrors(__('Delete unsuccessfully'));
    }

    public function changeState($id)
    {
        try{
            $user = $this->userRepository->changeState($id);

            if ($user) {
                session()->flash('success', __('Update successfully'));
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->back()->withErrors(__('Update unsuccessfully'));
    }

    public function getUser($id)
    {
        $user = User::query()->with(['roles'])->findOrFail($id);

        return $user;
    }
}
