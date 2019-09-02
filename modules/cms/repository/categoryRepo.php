<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/20/2019 06:00 PM
 */

namespace Modules\cms\repository;


use App\Constants\AppConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\cms\models\Category;

class categoryRepo
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by') ? $request->get('sort_by') : 'created_at';
        $sortOrder = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        $status = $request->get('status') != null  ? $request->get('status') : '';

        $query = Category::query()->where('deleted_f', AppConstants::UNCHECKED);
        
        if ($title = $request->get('title')) {
            $query->where('title', 'like', "%$title%");
        }

        if ($request->get('parent_id')) {
            $query->where('parent_id', $request->get('parent_id'));
        }

        if ($status != null) {
            $query->where('published_f', $status);
        }
        
        $categories = $query->orderBy($sortBy, $sortOrder)->paginate(25);

        return $categories;
    }

    public function create(Request $request)
    {
        $model = new Category();
        $model->fill($request->all());
        $model->slug = Str::slug($model->title);
        return $model->save();
    }

    public function update($id, Request $request)
    {
        $model = $this->findModel($id);
        $model->fill($request->all());
        $model->slug = Str::slug($model->title);
        return $model->save();
    }

    public function findModel($id)
    {
        return Category::query()->findOrFail($id);
    }

    public function changeState($id)
    {
        $model = $this->findModel($id);
        $model->published_f = $model->published_f ? AppConstants::UNCHECKED : AppConstants::CHECKED;
        return $model->save();
    }

    public function destroy($id)
    {
        $category = $this->findModel($id);

        if ($category->getChildren->isNotEmpty() || $category->getPosts->isNotEmpty()) {
            return false;
        }

        return $category->update(['deleted_f' => AppConstants::CHECKED]);
    }
}