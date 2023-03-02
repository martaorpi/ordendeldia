<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderCrudController;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    //'middleware' => ['web', 'admin'],
    'middleware' => ['web', 'admin', 'can:administracion_academica'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('student', 'StudentCrudController');
    Route::post('student/{id}/sign_up', 'StudentCrudController@signUp');
    Route::post('student/{id}/custom_email', 'StudentCrudController@customEmail');
    Route::post('student/{id}/check_status', 'StudentCrudController@checkStatus');
    Route::get('student/mass_check', 'StudentCrudController@massCheck');
    Route::post('student/{id}/sign_on', 'StudentCrudController@signOn'); 
    
});


Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    //'middleware' => ['web', 'admin'],
    'middleware' => ['web', 'admin', 'can:administracion_del_personal'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
}); // this should be the absolute last line of this file

