<?php

namespace Modules\core\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\core\models\Navigation;
use Modules\core\repository\NavigationRepository;

class NavigationController extends Controller
{
    public $navigationRepository;

    public function __construct(NavigationRepository $navigationRepository)
    {
        $this->navigationRepository = $navigationRepository;
    }

    public function index(Request $request)
    {
        $navigations = $this->navigationRepository->index($request);

        return view('core::navigations.index', ['navigations' => $navigations, 'params' => $request->all()]);
    }

    public function create()
    {
        return view('core::navigations.create');
    }

    public function edit($id)
    {
        $model = $this->navigationRepository->findModel($id);

        return view('core::navigations.update', ['model' => $model]);
    }

    public function remove($id)
    {
        $toggleActive = $this->navigationRepository->toggle($id);

        if ($toggleActive) {
            session()->flash('success', __('Update successfully'));
            return redirect()->route('admin.core.nav.index');
        }

        return redirect()->back()->withErrors( __('Update unsuccessfully'));
    }

    public function toggle($id)
    {
        $toggleActive = $this->navigationRepository->toggle($id);

        if ($toggleActive) {
            session()->flash('success', __('Update successfully'));
        } else {
            session()->flash('error', __('Update unsuccessfully'));
        }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Navigation::getInstance()->rules());

        if ($validator->failed()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        $createNavigation = $this->navigationRepository->store($request);

        if ($createNavigation) {
            session()->flash('success', __('Create successfully'));

            return redirect()->route('admin.core.nav.index');
        }

        return redirect()->back()->withErrors(__('Create unsuccessfully'))->withInput($request->all());
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Navigation::getInstance()->rules());

        if ($validator->failed()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        $createNavigation = $this->navigationRepository->update($request, $id);

        if ($createNavigation) {
            session()->flash('success', __('Update successfully'));
            return redirect()->back();
        }

        return redirect()->back()->withErrors(__('Update unsuccessfully'))->withInput($request->all());
    }
}
