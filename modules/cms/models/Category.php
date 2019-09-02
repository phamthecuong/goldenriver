<?php

namespace Modules\cms\models;


use App\Constants\AppConstants;
use App\Models\Model;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $fillable = ['title', 'description', 'parent_id', 'published_f', 'deleted_f', 'created_by', 'slug'];

    public static function getInstant()
    {
        return new self();
    }
    
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
            'parent_id' => 'numeric',
            'published_f' => 'nullable|numeric|max:1',
            'slug' => 'nullable|max:255'
        ];
    }
    
    protected static function boot()
    {
        parent::boot();

        self::updated(function ($model) {
            $model->slug = Str::slug($model->title);
        });

        self::creating(function ($model) {
            $model->created_by = Auth::user()->id;
        });

        self::updating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }

    public function getChildren()
    {
        return $this->hasMany(self::class, 'parent_id', 'category_id');
    }

    public function getParent()
    {
        return $this->hasOne(self::class, 'category_id', 'parent_id');
    }

    public function userCreated()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function getPosts()
    {
        return $this->hasMany(Post::class, 'category_id', 'category_id');
    }

    public function buildCategoryTree()
    {
        $results = [];

        $query = self::query()
            ->where('published_f', AppConstants::CHECKED)
            ->where('deleted_f', AppConstants::UNCHECKED);
        $query->where('parent_id', AppConstants::UNCHECKED);
        $categories = $query->get();

        foreach ($categories as $category) {
            $results[] = [
                'category_id' => $category->category_id,
                'title' => $category->title
            ];

            if (!$category->getChildren->isEmpty()) {
                $children = $this->buildTree($category->getChildren);
                array_push($results, ...$children);
            }
        }

        return $results;
    }

    public function buildTree($categories, $level = 1, $char = '- - ')
    {
        $results = [];
        foreach ($categories as $category) {
            $results[] = [
                'category_id' => $category->category_id,
                'title' => str_repeat($char, $level) . $category->title
            ];

            if(!$category->getChildren->isEmpty()) {
                $children = $this->buildTree($category->getChildren, $level + 1);
                array_push($results, ...$children);
            }
        }

        return $results;
    }

    public function statisticCategory()
    {
        return self::query()->where('deleted_f', AppConstants::UNCHECKED)->count();
    }
}
