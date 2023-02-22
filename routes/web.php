<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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
use App\Http\Controllers\WebhookController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');


Route::get('/dashboard', function () {
    return view('dashboard');
    //return view('errors/403');
})->middleware(['auth','verified'])->name('dashboard');

Route::get('/dashboard-2023', function () {
    return view('dashboard');
    //return view('errors/403');
})->middleware(['auth','verified'])->name('dashboard-2023');

Route::get('/pagos', function () {
    return view('payments');
    //return view('errors/403');
})->middleware(['auth','verified'])->name('pagos');

require __DIR__.'/auth.php';

Route::post('formulario-inscripcion', [Controller::class, 'studentUpdateOrCreate']);
//Route::post('formulario-update', [Controller::class, 'student_update']);
//Route::post('formulario-inscripcion','Controller@student_update');


/*Route::get("form_pdf", function (Request $request) {
    $dompdf = App::make("dompdf.wrapper");
    
    $dompdf->loadView("form_pdf", [
        "estudiante" => auth()->user()->student[0],
    ]);
    return $dompdf->stream('Formulario N° '.auth()->user()->student[0]->dni);
});*/


Route::post('form_pdf', [Controller::class, 'form_pdf']);

Route::get('getLocalidades/{id}', [Controller::class, 'getLocalidades']);

//Route::get('novedades/exportar-cant-planta', [Controller::class, 'exportCantPlanta']);

Route::get('/novedades/exportar-cant-planta', [Controller::class, 'exportCantPlanta']);
Route::get('/novedades/exportar-lic-planta', [Controller::class, 'exportLicPlanta']);

Route::post('webhooks', WebhookController::class);

StudentController::routes();
