<?php

namespace Modules\cms\models;


use App\Models\Model;

class PostMeta extends Model
{
    protected $table = 'post_meta';
    protected $primaryKey = 'post_id';
    protected $fillable = ['meta_title', 'meta_keyword', 'meta_description'];

    public static function getInstance()
    {
        return new self();
    }

    public function rules()
    {
        return [
            'meta_title' => 'nullable|max:255',
            'meta_keyword' => 'nullable|max:175',
            'meta_description' => 'nullable|max:255'
        ];
    }
}
