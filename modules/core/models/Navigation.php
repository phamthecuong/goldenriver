<?php

namespace Modules\core\models;


use App\Constants\AppConstants;
use App\Models\Model;

class Navigation extends Model
{
    protected $table = 'navigation';
    protected $primaryKey = 'navigation_id';
    protected $fillable = ['title', 'url', 'group', 'parent_id', 'is_active'];

    const GROUP_HEADER = 1; // Menu header
    const GROUP_FOOTER = 2; // Menu footer

    public function rules()
    {
        return [
            'title' => 'required|max:32',
            'url' => 'nullable|max:255',
            'parent_id' => 'numeric|max:1',
            'group' => 'required'
        ];
    }

    public function getChildren()
    {
        return $this->hasMany(self::class, 'parent_id', 'navigation_id');
    }

    public function getParent()
    {
        return $this->hasOne(self::class, 'navigation_id', 'parent_id');
    }

    public function buildNavTree()
    {
        $results = [];

        $query = self::query()
            ->where('is_active', AppConstants::CHECKED)
            ->where('parent_id', AppConstants::UNCHECKED);
        $navs = $query->get();

        foreach ($navs as $nav) {
            $results[] = [
                'navigation_id' => $nav->navigation_id,
                'title' => $nav->title
            ];

            if (!$nav->getChildren->isEmpty()) {
                $children = $this->buildTree($nav->getChildren);
                array_push($results, ...$children);
            }
        }

        return $results;
    }

    public function buildTree($navigations, $level = 1, $char = '- - ')
    {
        $results = [];
        foreach ($navigations as $navigation) {
            $results[] = [
                'navigation_id' => $navigation->navigation_id,
                'title' => str_repeat($char, $level) . $navigation->title
            ];

            if(!$navigation->getChildren->isEmpty()) {
                $children = $this->buildTree($navigation->getChildren, $level + 1);
                array_push($results, ...$children);
            }
        }

        return $results;
    }
}
