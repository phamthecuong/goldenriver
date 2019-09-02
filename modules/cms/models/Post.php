<?php

namespace Modules\cms\models;

use App\Constants\AppConstants;
use App\Helpers\ImageHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'post_id';
    protected $fillable = ['title', 'description', 'slug', 'category_id', 'content', 'avatar', 'published_f', 'deleted_f', 'is_feature', 'created_by'];

    public static function getInstance()
    {
        return new self();
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:post',
            'category_id' => 'required|numeric',
            'avatar' => 'required|file|image',
            'published_f' => 'numeric|min:0|max:1',
            'is_feature' => 'numeric|min:0|max:1'
        ];
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->created_by = Auth::user()->id;
            $model->slug = Str::slug($model->title, '-');
        });

        self::updating(function ($model) {
            $model->slug = Str::slug($model->title, '-');
        });
    }

    public function postMeta()
    {
        return $this->hasOne(PostMeta::class, 'post_id', 'post_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'category_id', 'category_id');
    }

    public function thumbnail()
    {
        return route('image.resize', ['w' => 100, 'h' => 70, 'src' => $this->avatar]);
    }

    public function checkAndRemoveAvatar($avatar)
    {
        $check = self::query()->where('avatar', $avatar)->exists();

        if (!$check) {
            Storage::disk('public')->delete($avatar);
        }
    }

    public function statisticPost()
    {
        return self::query()->where('deleted_f', AppConstants::UNCHECKED)->count();
    }

    public function statisticPublicPost()
    {
        return self::query()->where('deleted_f', AppConstants::UNCHECKED)->where('published_f', AppConstants::CHECKED)->count();
    }

    public function statisticFeaturePost()
    {
        return self::query()
            ->where('deleted_f', AppConstants::UNCHECKED)
            ->where('published_f', AppConstants::CHECKED)
            ->where('is_feature', AppConstants::CHECKED)
            ->count();
    }
}
