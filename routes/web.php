<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [
    'as'=> 'home',
    'uses' =>'HomeController@index'
]);


Route::get('/test', [
    'as'=> 'test',
    'uses' =>'HomeController@test'
]);


Route::get('/login', [
    'as'=> 'login',
    'uses' =>'AdminController@loginAdmin'
]);

Route::get('/logout', [
    'as'=> 'logout',
    'uses' =>'AdminController@logoutAdmin'
]);
Route::post('/post-login', 'AdminController@postLoginAdmin'
);

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('home');
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [
                'as'=> 'categories.index',
                'uses' =>'CategoryController@index',
                'middleware'=> 'can:category-list'
            ]
        );
        Route::get('/create', [
                'as'=> 'categories.create',
                'uses' =>'CategoryController@create'
            ]
        );
        Route::post('/store', [
                'as'=> 'categories.store',
                'uses' =>'CategoryController@store'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'categories.edit',
                'uses' =>'CategoryController@edit'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'categories.update',
                'uses' =>'CategoryController@update'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'categories.delete',
                'uses' =>'CategoryController@delete'
            ]
        );
    });
    Route::prefix('menus')->group(function () {
        Route::get('/', [
                'as'=> 'menus.index',
                'uses' =>'MenuController@index'
            ]
        );
        Route::get('/create', [
                'as'=> 'menus.create',
                'uses' =>'MenuController@create'
            ]
        );
        Route::post('/store', [
                'as'=> 'menus.store',
                'uses' =>'MenuController@store'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'menus.edit',
                'uses' =>'MenuController@edit'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'menus.update',
                'uses' =>'MenuController@update'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'menus.delete',
                'uses' =>'MenuController@delete'
            ]
        );
    });

    Route::group(['prefix' => 'product', 'middleware' => ['auth']], function () {
        Route::get('/', [
                'as'=> 'product.index',
                'uses' =>'AdminProductController@index'
            ]
        );
        Route::get('/create', [
                'as'=> 'product.create',
                'uses' =>'AdminProductController@create'
            ]
        );
        Route::post('/store', [
                'as'=> 'product.store',
                'uses' =>'AdminProductController@store'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'product.edit',
                'uses' =>'AdminProductController@edit'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'product.update',
                'uses' =>'AdminProductController@update'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'product.delete',
                'uses' =>'AdminProductController@delete'
            ]
        );
    });

    Route::group(['prefix' => 'slider', 'middleware' => ['auth']], function () {
        Route::get('/', [
                'as'=> 'slider.index',
                'uses' =>'SliderAdminController@index'
            ]
        );
        Route::get('/create', [
                'as'=> 'slider.create',
                'uses' =>'SliderAdminController@create'
            ]
        );
        Route::post('/store', [
                'as'=> 'slider.store',
                'uses' =>'SliderAdminController@store'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'slider.edit',
                'uses' =>'SliderAdminController@edit'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'slider.update',
                'uses' =>'SliderAdminController@update'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'slider.delete',
                'uses' =>'SliderAdminController@delete'
            ]
        );
    });

    Route::group(['prefix' => 'config', 'middleware' => ['auth']], function () {
        Route::get('/', [
                'as'=> 'config.index',
                'uses' =>'CoreConfigController@index'
            ]
        );
        Route::get('/create', [
                'as'=> 'config.create',
                'uses' =>'CoreConfigController@create'
            ]
        );
        Route::post('/store', [
                'as'=> 'config.store',
                'uses' =>'CoreConfigController@store'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'config.edit',
                'uses' =>'CoreConfigController@edit'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'config.update',
                'uses' =>'CoreConfigController@update'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'config.delete',
                'uses' =>'CoreConfigController@delete'
            ]
        );
    });

    Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
        Route::get('/', [
                'as'=> 'user.index',
                'uses' =>'AdminUserController@index'
            ]
        );
        Route::get('/create', [
                'as'=> 'user.create',
                'uses' =>'AdminUserController@create'
            ]
        );
        Route::post('/store', [
                'as'=> 'user.store',
                'uses' =>'AdminUserController@store'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'user.edit',
                'uses' =>'AdminUserController@edit'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'user.update',
                'uses' =>'AdminUserController@update'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'user.delete',
                'uses' =>'AdminUserController@delete'
            ]
        );
    });
    Route::group(['prefix' => 'role', 'middleware' => ['auth']], function () {
        Route::get('/', [
                'as'=> 'role.index',
                'uses' =>'AdminRoleController@index'
            ]
        );
        Route::get('/create', [
                'as'=> 'role.create',
                'uses' =>'AdminRoleController@create'
            ]
        );
        Route::post('/store', [
                'as'=> 'role.store',
                'uses' =>'AdminRoleController@store'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'role.edit',
                'uses' =>'AdminRoleController@edit'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'role.update',
                'uses' =>'AdminRoleController@update'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'role.delete',
                'uses' =>'AdminRoleController@delete'
            ]
        );
    });

    Route::group(['prefix' => 'permission', 'middleware' => ['auth']], function () {
        Route::get('/', [
                'as'=> 'permission.index',
                'uses' =>'AdminPermissionController@index'
            ]
        );
        Route::get('/create', [
                'as'=> 'permission.create',
                'uses' =>'AdminPermissionController@create'
            ]
        );
        Route::post('/store', [
                'as'=> 'permission.store',
                'uses' =>'AdminPermissionController@store'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'permission.edit',
                'uses' =>'AdminPermissionController@edit'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'permission.update',
                'uses' =>'AdminPermissionController@update'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'permission.delete',
                'uses' =>'AdminPermissionController@delete'
            ]
        );
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});