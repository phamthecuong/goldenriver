<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/24/2019 05:53 PM
 */

namespace Modules\cms\repository;


use App\Constants\AppConstants;
use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\cms\models\Post;
use Modules\cms\models\PostMeta;

class PostRepository
{
    public function index(Request $request)
    {
        $sortOrder = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        $sortBy = $request->get('sort_by') ? $request->get('sort_by') : 'created_at';
        $category = $request->get('category_id') ? $request->get('category_id') : '';
        $title = $request->get('title') ? $request->get('title') : '';
        $status = $request->get('status') != null  ? $request->get('status') : '';

        $query = Post::query()->where('deleted_f', AppConstants::UNCHECKED);

        if ($category){
            $query->where('category_id', $category);
        }

        if ($title) {
            $query->where('title', 'like', "%$title%");
        }

        if ($status != null) {
            $query->where('published_f', $status);
        }

        return $posts = $query->orderBy($sortBy, $sortOrder)->paginate(25);

    }

    public function listDeleted(Request $request)
    {
        $sortOrder = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        $sortBy = $request->get('sort_by') ? $request->get('sort_by') : 'created_at';
        $category = $request->get('category_id') ? $request->get('category_id') : '';
        $title = $request->get('title') ? $request->get('title') : '';
        $status = $request->get('status') != null  ? $request->get('status') : '';

        $query = Post::query()->where('deleted_f', AppConstants::CHECKED);

        if ($category){
            $query->where('category_id', $category);
        }

        if ($title) {
            $query->where('title', 'like', "%$title%");
        }

        if ($status != null) {
            $query->where('published_f', $status);
        }

        return $posts = $query->orderBy($sortBy, $sortOrder)->paginate(25);
    }

    public function update($id, Request $request, &$errors = [])
    {
        $model = $this->findModel($id);
        $postMeta = $model->postMeta;
        $errors = [];
        $model->fill($request->all());
        $oldAvatar = $model->avatar;
        if ($file = $request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $dir = config('params.post_thumbnail_upload_dir', 'uploads/posts/thumbnails');

            if (!$upload = FileHelper::upload($file, $dir, null, $errors )) {
                return false;
            }

            $model->avatar = $upload;
            $model->checkAndRemoveAvatar($oldAvatar);
        }

        $model->slug = Str::slug($model->title);
        $postMeta->fill($request->all());

        DB::beginTransaction();
        if (!$model->save()) {
            DB::rollBack();
            $errors = __('Update unsuccessfully');
            return false;
        }

        $postMeta->post_id = $model->post_id;

        if (!$postMeta->save()) {
            DB::rollBack();
            $errors = __('Update unsuccessfully');
            return false;
        }

        DB::commit();
        return true;
    }

    public function store(Request $request, &$errors = [])
    {
        $model = new Post();
        $postMeta = new PostMeta();
        $errors = [];
        $file = $request->file('avatar');
        $dir = config('params.post_thumbnail_upload_dir', 'uploads/posts/thumbnails');
        $model->fill($request->all());

        if (!$upload = FileHelper::upload($file, $dir, null, $errors )) {
            return false;
        }

        $model->avatar = $upload;
        $model->slug = Str::slug($model->title);
        $postMeta->fill($request->all());

        DB::beginTransaction();
        if (!$model->save()) {
            DB::rollBack();
            $errors = __('Create unsuccessfully');
            return false;
        }

        $postMeta->post_id = $model->post_id;

        if (!$postMeta->save()) {
            DB::rollBack();
            $errors = __('Create unsuccessfully');
            return false;
        }

        DB::commit();
        return true;
    }

    public function changeState($id, $field)
    {
        $model = $this->findModel($id);
        $model->$field = $model->$field ? AppConstants::UNCHECKED : AppConstants::CHECKED;

        return $model->save();
    }

    public function findModel($id)
    {
        $model = Post::query()->findOrFail($id);

        if ($model->deleted_f) {
            throw (new ModelNotFoundException);
        }

        return $model;
    }
}