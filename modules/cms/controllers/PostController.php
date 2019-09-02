<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/24/2019 02:53 PM
 */

namespace Modules\cms\controllers;


use App\Constants\AppConstants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\cms\models\Post;
use Modules\cms\models\PostMeta;
use Modules\cms\repository\PostRepository;

class PostController extends Controller
{
    public $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request)
    {
        $posts = $this->postRepository->index($request);
        return view('cms::posts.index', ['posts' => $posts, 'params' => $request->all()]);
    }

    public function create()
    {
        return view('cms::posts.create');
    }

    public function listDeleted(Request $request)
    {
        $posts = $this->postRepository->listDeleted($request);
        return view('cms::posts.deleted', ['posts' => $posts, 'params' => $request->all()]);
    }

    public function view($id)
    {
        $model = $this->postRepository->findModel($id);

        dd($model->thumbnail());
    }

    public function edit($id)
    {
        return view('cms::posts.update', ['model' => $this->postRepository->findModel($id)]);
    }

    public function store(Request $request)
    {
        $rules = array_merge(Post::getInstance()->rules(), PostMeta::getInstance()->rules());
        $postValidator = Validator::make($request->all(), $rules);

        if ($postValidator->fails()) {
            return redirect()->back()->withErrors($postValidator->errors())->withInput($request->all());
        }

        try{
            $post = $this->postRepository->store($request);
            
            if ($post) {
                session()->flash('success', __('Create successfully'));
                return redirect()->route('admin.cms.post.index');
            }

            return redirect()->back()->withErrors(__('Created unsuccessfully'))->withInput($request->all());
        } catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage())->withInput($request->all());
        }
    }

    public function update(Request $request, $id)
    {
        $rules = array_merge(Post::getInstance()->rules(), PostMeta::getInstance()->rules());
        $rules['avatar'] = 'nullable|file|image';
        $postValidator = Validator::make($request->all(), $rules);

        if ($postValidator->fails()) {
            return redirect()->back()->withErrors($postValidator->errors())->withInput($request->all());
        }

        try{
            $update = $this->postRepository->update($id, $request, $errors);

            if ($update) {
                session()->flash('success', __('Update successfully'));
                return redirect()->back();
            }

            return redirect()->back()->withErrors($errors)->withInput($request->all());
        } catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage())->withInput($request->all());
        }
    }

    public function delete($id)
    {
        $model = $this->postRepository->findModel($id);
        $model->deleted_f = AppConstants::CHECKED;
        if ($model->save()) {
            session()->flash('success', __('Delete successfully'));
            return redirect()->route('admin.cms.post.index');
        }

        return redirect()->back()->withErrors(__('Delete unsuccessfully'));
    }

    public function state($id, $field = 'published_f')
    {
        $changeState = $this->postRepository->changeState($id, $field);

        if ($changeState) {
            session()->flash('success', __('Update successfully'));
        } else {
            session()->flash('error', __('Update unsuccessfully'));
        }

        return redirect()->back();
    }
}