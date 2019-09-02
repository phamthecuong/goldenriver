<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/20/2019 05:56 PM
 */

namespace App\Models;

use \Illuminate\Database\Eloquent\Model as BaseModel;


class Model extends BaseModel
{
    public static function getInstance()
    {
        $class = get_called_class();
        return new $class();
    }
    
    public static function findBySlug($slug, array $conditions = [])
    {
        $childModel = get_called_class();
        $query = $childModel::query()->where('slug', $slug);

        if (!empty($conditions)) {
            $query->where($conditions);
        }

        return $model = $query->first();
    }
}