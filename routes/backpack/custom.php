<?php
use Illuminate\Support\Facades\Route;

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
    Route::crud('examenes', 'ExamCrudController');
    Route::crud('student', 'StudentCrudController');

    Route::post('student/{id}/sign_up', 'StudentCrudController@signUp');
    Route::post('student/{id}/custom_email', 'StudentCrudController@customEmail');
    Route::post('student/{id}/check_status', 'StudentCrudController@checkStatus');    
    Route::post('student/{id}/sign_on', 'StudentCrudController@signOn'); 

    Route::post('staff/{id}/licenses', 'StaffLicenseCrudController@storeLicenses');
    Route::get('staff/{id}/get_licenses', 'LicenseCrudController@getLicenses');
    Route::post('staff/{id}/delete_licenses', 'StaffLicenseCrudController@deleteLicenses');
    Route::post('license/{id}/staff-licenses', 'StaffLicenseCrudController@storeLicenses2');
    Route::get('license/{id}/get_staff', 'StaffCrudController@getStaff');
    Route::post('license/{id}/delete_staff', 'StaffLicenseCrudController@deleteStaff');
    
    Route::crud('subject', 'SubjectCrudController');
    Route::crud('staff', 'StaffCrudController');
    Route::get('staff/export', 'StaffCrudController@exportExcel');
    Route::get('staff/exportLicense', 'StaffCrudController@exportLicense');
    Route::crud('staff-license', 'StaffLicenseCrudController');
    Route::crud('license', 'LicenseCrudController');

    Route::get('novedades', 'StaffCrudController@novedades');
    Route::crud('family-member', 'FamilyMemberCrudController');

    Route::crud('career', 'CareerCrudController');
    Route::crud('cycle', 'CycleCrudController');
    Route::crud('staff-discount', 'StaffDiscountCrudController');
    Route::crud('discount', 'DiscountCrudController');
}); // this should be the absolute last line of this file