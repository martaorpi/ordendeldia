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
    Route::crud('examenes', 'ExamCrudController');
    Route::crud('student', 'StudentCrudController');
    Route::post('student/{id}/sign_up', 'StudentCrudController@signUp');
    Route::post('student/{id}/custom_email', 'StudentCrudController@customEmail');
    Route::post('student/{id}/check_status', 'StudentCrudController@checkStatus');
    Route::get('student/mass_check', 'StudentCrudController@massCheck');
    Route::post('student/{id}/sign_on', 'StudentCrudController@signOn'); 
    Route::crud('subject', 'SubjectCrudController');
    Route::crud('staff', 'StaffCrudController');
    Route::crud('career', 'CareerCrudController');
    Route::crud('cycle', 'CycleCrudController');

    Route::crud('study-plan', 'StudyPlanCrudController');
    Route::crud('educative-offer', 'EducativeOfferCrudController');
    Route::crud('academic-unit', 'AcademicUnitCrudController');
    Route::crud('tariff-category', 'TariffCategoryCrudController');
    Route::crud('correlative', 'CorrelativeCrudController');
    Route::crud('job', 'JobCrudController');
    Route::crud('sworn-declaration', 'SwornDeclarationCrudController');
    Route::crud('exam-inscriptions', 'ExamInscriptionsCrudController');
    Route::crud('exam-table', 'ExamTableCrudController');
    Route::get('exam-table/{id}/showExamTable', 'ExamTableCrudController@showExamTable');
    Route::get('exam-table/{id}/actPDF', 'ExamTableCrudController@actPDF');
    Route::get('exam-table/act_pdf/{id}', 'ExamTableCrudController@act_pdf');
    Route::get('exam-table/act_pdf_reg/{id}', 'ExamTableCrudController@act_pdf_reg');
    Route::crud('exam-shift', 'ExamShiftCrudController');
    Route::get('sworn-declaration/{id}/get_subjects2', 'SwornDeclarationCrudController@getSubjects');
    Route::post('sworn-declaration/{id}/delete_subject', 'SwornDeclarationCrudController@deleteSubject');
    Route::crud('regularity', 'RegularityCrudController');
    Route::post('sworn-declaration/{id}/sworn-declaration-item', 'SwornDeclarationCrudController@storeSwornDeclarationItems');
    Route::get('correlative/getSubjects/{id}', function ($id) {
        $subject = App\Models\Subject::orderBy('description', 'ASC')->where('career_id',$id)->get();
        return response()->json($subject);
    });
    
});

Route::group([
    'namespace'  => 'App\Http\Controllers\Admin',
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
], function () { 
    OrderCrudController::routes();
});

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    //'middleware' => ['web', 'admin'],
    'middleware' => ['web', 'admin', 'can:administracion_del_personal'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::post('staff/{id}/licenses', 'StaffLicenseCrudController@storeLicenses');
    Route::get('staff/{id}/get_licenses', 'LicenseCrudController@getLicenses');
    Route::post('staff/{id}/delete_licenses', 'StaffLicenseCrudController@deleteLicenses');
    Route::post('license/{id}/staff-licenses', 'StaffLicenseCrudController@storeLicenses2');
    Route::get('license/{id}/get_staff', 'StaffCrudController@getStaff');
    Route::get('discount/{id}/get_staff', 'StaffCrudController@getStaff');
    Route::post('license/{id}/delete_staff', 'StaffLicenseCrudController@deleteStaff');

    Route::post('staff/{id}/discounts', 'StaffDiscountCrudController@storeDiscounts');
    Route::post('discount/{id}/staff-discounts', 'StaffDiscountCrudController@storeDiscounts2');
    Route::get('staff/{id}/get_discounts', 'DiscountCrudController@getDiscounts');
    Route::post('staff/{id}/delete_discounts', 'StaffDiscountCrudController@deleteDiscounts');
    Route::post('discount/{id}/delete_staff', 'StaffDiscountCrudController@deleteStaff');
    
    Route::crud('subject', 'SubjectCrudController');
    Route::crud('staff', 'StaffCrudController');
    Route::get('staff/export', 'StaffCrudController@exportExcel');
    Route::get('staff/exportLicense', 'StaffCrudController@exportLicense');
    Route::crud('staff-license', 'StaffLicenseCrudController');
    Route::crud('license', 'LicenseCrudController');

    Route::get('novedades', 'StaffCrudController@novedades');
    Route::crud('family-member', 'FamilyMemberCrudController');

    Route::crud('staff-discount', 'StaffDiscountCrudController');
    Route::crud('discount', 'DiscountCrudController');
    Route::crud('staff-subject', 'StaffSubjectCrudController');

    Route::get('staff/calculator', 'StaffCrudController@calculator');

    Route::get('staff/calculator_pdf/{param}', 'StaffCrudController@calculator_pdf');
}); // this should be the absolute last line of this file

