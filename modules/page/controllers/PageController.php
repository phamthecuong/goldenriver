<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/31/2019 04:27 PM
 */

namespace Modules\page\controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\page\models\Page;
use Modules\page\repositories\PageRepository;

class PageController extends Controller
{
    public $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index(Request $request)
    {
        $pages = $this->pageRepository->index($request);

        return view('page::pages.index', ['pages' => $pages, 'params' => $request->all()]);
    }

    public function create()
    {
        return view('page::pages.create');
    }

    public function view($id)
    {
        return view('page::pages.view', ['model' => $this->pageRepository->findModel($id)]);
    }

    public function edit($id)
    {
        return view('page::pages.update', ['model' => $this->pageRepository->findModel($id)]);
    }

    public function toggle($id, $field)
    {
        if ($this->pageRepository->toggle($id, $field)) {
            session()->flash('success', __('Update successfully'));
        } else {
            session()->flash('error', __('Update unsuccessfully'));
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        if ($this->pageRepository->remove($id)) {
            session()->flash('success', __('Remove successfully'));

            return redirect()->route('admin.page.index');
        }

        session()->flash('error', __('Remove unsuccessfully'));

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Page::getInstance()->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        try{
            $page = $this->pageRepository->store($request);
        } catch (\Exception $exception) {
            return redirect()->back()->withInput($request->all())->withErrors($exception->getMessage());
        }

        if ($page) {
            return redirect()->route('admin.page.view', $page->page_id);
        }

        return redirect()->back()->withInput($request->all())->withErrors(__('Create unsuccessfully'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), Page::getInstance()->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        try{
            $page = $this->pageRepository->update($id, $request);

            if ($page) {
                return redirect()->route('admin.page.view', $page->page_id);
            }

            return redirect()->back()->withInput($request->all())->withErrors(__('Update unsuccessfully'));
        } catch (\Exception $exception) {
            return redirect()->back()->withInput($request->all())->withErrors($exception->getMessage());
        }
    }
}