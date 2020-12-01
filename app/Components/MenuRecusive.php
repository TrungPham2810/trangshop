<?php
/**
 * Created by PhpStorm.
 * User: Trung Pham
 * Date: 12/2/2020
 * Time: 12:02 AM
 */

namespace App\Components;


use App\Menu;

class MenuRecusive
{
    protected $htmlSelect = '';
    protected $data = [];

    public function menuRecusiveAdd($parentId = 0, $delimiter = '') {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $value) {
            $this->htmlSelect .= "<option value='$value->id'>".$delimiter.$value->name."</option>";
            $this->menuRecusiveAdd($value->id, $delimiter.'--');
        }
        return $this->htmlSelect;
    }
}