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


Route::get("test", function (Request $request) {
    ini_set('memory_limit', '8192M');
    $dompdf = App::make("dompdf.wrapper");
    $dompdf->loadView("ejemplo", [
        "nombre" => "Luis Cabrera Benito",
    ]);
    return $dompdf->stream();
});