<?php
/**
 * Created by PhpStorm.
 * User: Trung Pham
 * Date: 1/10/2021
 * Time: 9:53 PM
 */

function getConfigValue($configKey)
{
    $setting = \App\CoreConfig::where('config_key',$configKey)->first();
    if(!empty($setting)) {
        return $setting->config_value;
    }
    return null;
}

function getCategoryUrl($category = null)
{
    if($category && $category->id) {
        return route('shop.index', ['id'=> $category->id, 'slug'=>$category->slug]);
    }
    return null;
}