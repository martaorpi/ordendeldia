<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    /*'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),

    ),*/
    'middleware' => ['web', 'can:administrar-usuarios'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('doc', 'DocCrudController');
    Route::get('doc/example', 'DocCrudController@example');
    Route::get('view-user/addViewsUsers/{id}', 'ViewUserCrudController@addViewsUsers');
    Route::crud('view-user', 'ViewUserCrudController');
});
