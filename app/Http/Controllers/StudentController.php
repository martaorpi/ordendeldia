<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use DB;


class StudentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function orders($id){
        return view('estudiantes/orders', ['orders' => Order::where('student_id', $id)->get()]); 
    }

    public static function routes()
    {
        Route::get('/estudiantes/ordenes/{id}', [Controller::class, 'orders']);
    }
}