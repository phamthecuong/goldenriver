<?php
namespace Modules\cms\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\cms\models\Category;
use Modules\cms\repository\categoryRepo;


class CategoryController extends Controller{
    public $categoryRepository;

    public function __construct(categoryRepo $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->middleware('auth');
    }

    public function index(Request $request){
        $categories = $this->categoryRepository->index($request);
        return view('cms::categories.index', ['categories' => $categories, 'params' => $request->all()]);
    }

    public function create()
    {
        return view('cms::categories.create');
    }

    public function view($id)
    {
        return view('cms::categories.view', ['model' => $this->categoryRepository->findModel($id)]);
    }

    public function edit($id)
    {
        return view('cms::categories.update', ['model' => $this->categoryRepository->findModel($id)]);
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->destroy($id);

        if (!$category) {
            return redirect()->back()->withErrors(__('You can not delete this item'));
        }

        session()->flash('success', __('Remove successfully'));
        return redirect()->route('admin.cms.category.index');
    }

    public function toggleState($id)
    {
        try{
            $this->categoryRepository->changeState($id);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        session()->flash('success', __('Update successfully'));
        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), Category::getInstant()->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        try {
            $this->categoryRepository->update($id, $request);
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', __('Update successfully'));
        return redirect()->route('admin.cms.category.view', $id);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Category::getInstant()->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        try{
            $create = $this->categoryRepository->create($request);

            if (!$create) {
                session()->flash('error', __('Create unsuccessfully'));
                return redirect()->back()->withInput($request->all());
            }

            session()->flash('success', __('Create successfully'));
            return redirect()->route('admin.cms.category.index');

        } catch (\Exception $exception){
            session()->flash('error', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}