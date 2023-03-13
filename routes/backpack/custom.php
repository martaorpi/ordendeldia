<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

/*Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),

    'middleware' => ['web', 'can:administrar-configuraciones'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('dependence', 'DependenceCrudController');
    Route::crud('crime', 'CrimeCrudController');
    Route::crud('authority', 'AuthorityCrudController');
    Route::crud('document', 'DocumentCrudController');
});

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),

    'middleware' => ['web', 'can:administrar-documentos'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('document', 'DocumentCrudController');
    Route::crud('person', 'PersonCrudController');
});*/

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'info'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        
    ),
    //'middleware' => ['web', 'can:administrar-configuraciones'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('doc', 'DocCrudController');
});