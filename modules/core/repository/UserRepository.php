<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/22/2019 05:42 PM
 */

namespace Modules\core\repository;


use App\Constants\AppConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\core\models\User;
use Modules\core\models\UserProfile;

class UserRepository
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by') ? $request->get('sort_by') : 'id';
        $sortOrder = $request->get('sort_order') ? $request->get('sort_order') : 'ASC';
        $active = $request->get('is_active') != null ? $request->get('is_active') : '';

        $query = User::query();

        if ($active != null) {
            $query->where('is_active', $active);
        }

        $query->with('profile');
        return $users = $query->orderBy($sortBy, $sortOrder)->paginate(25);
    }

    public function store(Request $request)
    {
        $model = new User();
        $profile = new UserProfile();
        $model->fill($request->all());
        $model->password = Hash::make($model->password);

        DB::beginTransaction();
        if (!$model->save()) {
            DB::rollBack();
            return false;
        }

        $profile->fill($request->all());
        $profile->user_id = $model->id;

        if (!$profile->save()) {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }

    public function update(Request $request, $id)
    {
        $model = $this->findModel($id);
        $profile = $model->profile;
        unset($request['email']);

        if (!$password = $request->post('password')) {
            unset($request['password'], $request['password_confirmation']);
        } else {
            $model->password = Hash::make($password);
        }

        $model->fill($request->all());
        $profile->fill($request->all());

        if ($model->save() && $profile->save()) {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $model = $this->findModel($id);
        return $model->delete();
    }

    public function changeState($id)
    {
        $model = $this->findModel($id);
        $model->is_active = $model->is_active ? AppConstants::UNCHECKED : AppConstants::CHECKED;

        return $model->save();
    }

    /**
     * Find model object with primary
     *
     * @param $id
     *
     * @return Object
     */
    public function findModel($id)
    {
        return User::query()->findOrFail($id);
    }
}