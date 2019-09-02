<?php

namespace Modules\core\models;


use App\Models\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';
    protected $primaryKey = 'user_id';
    protected $fillable = ['title', 'gender', 'phone_number'];
    public $timestamps = false;

    public static function getInstant()
    {
        return new  self();
    }

    public function rules()
    {
        return [
            'title' => 'nullable|max:255',
            'gender' => 'nullable',
            'phone_number' => 'nullable|min:10|max:15'
        ];
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
