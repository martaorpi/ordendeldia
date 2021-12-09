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

Route::get('examenes', function () {
    return view('exam');
})->middleware(['auth','verified'])->name('examenes');



require __DIR__.'/auth.php';

Route::post('formulario-inscripcion', [Controller::class, 'studentUpdateOrCreate']);

Route::post('form_pdf', [Controller::class, 'form_pdf']);



Route::get('getLocalidades/{id}', [Controller::class, 'getLocalidades']);