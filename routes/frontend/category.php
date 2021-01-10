<?php
/**
 * Created by PhpStorm.
 * User: Trung Pham
 * Date: 1/10/2021
 * Time: 11:18 PM
 */

Route::get('/shop/{slug}/{id}', [
        'as'=> 'shop.index',
        'uses' =>'ShopController@index'
    ]
);