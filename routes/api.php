<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SensorRestController;
use App\Http\Controllers\Api\UserRestController;


//SensorRestApi
Route::post("activate_sensor", [SensorRestController::class, "index"])->name("activate_sensor");
Route::post("sensor_close", [SensorRestController::class, "update"])->name("sensor_close");

//UserRestApi
Route::post("list_finger", [UserRestController::class, "index"]);
Route::post("save_finger", [UserRestController::class, "store"]);
Route::post("update_finger", [UserRestController::class, "update"]);
Route::post("sincronizar", [UserRestController::class, "sincronizar"]);
