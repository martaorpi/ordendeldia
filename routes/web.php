<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controller;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('formulario-inscripcion', [Controller::class, 'student_create']);
Route::post('formulario-update', [Controller::class, 'student_update']);
//Route::post('formulario-inscripcion','Controller@student_update');


Route::get("form_pdf", function (Request $request) {
    $dompdf = App::make("dompdf.wrapper");
    $dompdf->loadView("form_pdf", [
        "estudiante" => auth()->user()->student[0],
    ]);
    return $dompdf->stream();
});