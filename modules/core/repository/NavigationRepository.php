<?php


namespace Modules\core\repository;


use App\Constants\AppConstants;
use Illuminate\Http\Request;
use Modules\core\models\Navigation;

class NavigationRepository
{
    /**
     * List item and filter by condition
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by') ? $request->get('sort_by') : 'created_at';
        $sortOrder = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        $isActive = $request->get('is_active') != null ? $request->get('is_active') : '';
        $group = $request->get('group') ? $request->get('group') : '';
        $parentId = $request->get('parent_id') ? $request->get('parent_id') : '';


        $query = Navigation::query();

        if ($keyword) {
            $query->where('title', 'like', "%$keyword%");
        }

        if ($isActive != null) {
            $query->where('is_active', $isActive);
        }

        if ($group) {
            $query->where('group', $group);
        }

        if ($parentId) {
            $query->where('parent_id', $parentId);
        }


        $navigations = $query->orderBy($sortBy, $sortOrder)->paginate(25);

        return $navigations;
    }

    /**
     * Handle create item
     *
     * @param Request $request
     *
     * @return bool
     */
    public function store(Request $request)
    {
        $model = new Navigation();
        $model->fill($request->all());
        $model->parent_id = $request->post('parent_id', 0);

        return $model->save();
    }

    /**
     * Handle update item process
     *
     * @param Request $request
     * @param         $id
     *
     * @return bool
     */
    public function update(Request $request, $id)
    {
        $model = $this->findModel($id);
        $model->fill($request->all());
        $model->parent_id = $request->post('parent_id', 0);

        return $model->save();
    }

    /**
     * Change status is active
     *
     * @param $id
     *
     * @return bool
     */
    public function toggle($id)
    {
        $model = $this->findModel($id);
        $model->is_active = $model->is_active ? AppConstants::UNCHECKED : AppConstants::CHECKED;

        return $model->save();
    }

    /**
     * Remove item from database
     *
     * @param $id
     *
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function remove($id)
    {
        $model = $this->findModel($id);
        return $model->delete();
    }

    /**
     * Find model
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function findModel($id)
    {
        return Navigation::query()->findOrFail($id);
    }
}