<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/31/2019 05:11 PM
 */

namespace Modules\page\repositories;



use App\Constants\AppConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\page\models\Page;

class PageRepository
{
    public $model;

    public function __construct()
    {
        $this->getModel();
    }
    
    public function getModel()
    {
        return $this->model = $this->setModel();
    }

    public function setModel()
    {
        return Page::class;
    }

    public function index(Request $request)
    {
        $sortOrder = $request->get('sort_order') ? $request->get('sort_order') : 'DESC';
        $sortBy = $request->get('sort_by') ? $request->get('sort_by') : 'created_at';
        $query = $this->model::query();

        return $pages = $query->orderBy($sortBy, $sortOrder)->paginate(25);
    }

    public function store(Request $request)
    {
        $model = new $this->model();
        $model->fill($request->all());

        if (!$request->post('slug')) {
            $model->slug = Str::slug($request->post('title'));
        }

        $model->created_by = Auth::user()->id;

        if ($model->save()) {
            return $model;
        }

        return false;
    }

    public function update($id, Request $request)
    {
        $model = $this->findModel($id);
        $model->fill($request->all());

        if ($model->slug == null) {
            $model->slug = Str::slug($model->title);
        }

        if ($model->save()) {
            return $model;
        }

        return false;
    }

    public function remove($id)
    {
        $model = $this->findModel($id);

        return $model->delete();
    }

    public function toggle($id, $field)
    {
        $model = $this->findModel($id);
        $model->$field = $model->$field ? AppConstants::UNCHECKED : AppConstants::CHECKED;
        return $model->save();
    }

    public function findModel($id)
    {
        return $this->model::query()->findOrFail($id);
    }
}