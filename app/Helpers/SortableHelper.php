<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/22/2019 05:50 PM
 */

namespace App\Helpers;


class SortableHelper
{
    public static function sortLink($field, string $route, $params = [], $title = '')
    {
        if (isset($params['sort_by']) && $params['sort_by'] == $field) {
            if (isset($params['sort_order']) && strtolower($params['sort_order']) == 'asc') {
                $params['sort_order'] = 'desc';
            } else {
                $params['sort_order'] = 'asc';
            }

            return static::renderSortLink($field, $route, $params, $title);
        }

        $params['sort_by'] = $field;
        $params['sort_order'] = 'asc';

        return static::renderSortLink($field, $route, $params, $title);
    }

    public static function renderSortLink(string $field, string $route, array $params, $title = '')
    {
        $route = route($route, $params);

        $html = "<a href='$route'>";
        $html .= $title ? $title : ucfirst($field);
        $html .= $params['sort_order'] == 'asc' ? '<span class="float-right"><i class="fas fa-sort-amount-down"></i></span>' : '<span class="float-right"><i class="fas fa-sort-amount-up"></i></span>';
        $html .= '</a>';

        return $html;
    }
}