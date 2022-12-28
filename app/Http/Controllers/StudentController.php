<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Order;
use App\Models\ExamStudent;
use Illuminate\Support\Facades\Route;
use DB;


class StudentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function orders($id){
        return view('estudiantes/orders', ['orders' => Order::where('student_id', $id)->get()]); 
    }

    public function examenes(){
        return view('estudiantes/exams');
    }

    public function reinscripciones(){
        return view('estudiantes/re-registrations');
    }
    
    public function prueba(){
        $exam_table = \App\Models\ExamTable::where('subject_id',1)->orderBy('date','DESC')->first();
        /*$input3['exam_table_id'] = $exam_table->id;
        $input3['condition_exam'] = 'Regular';
        ExamStudent::create($input3);*/

        $product = new ExamStudent();
        $product->exam_table_id = $exam_table->id;
        $product->condition_exam = 'Regular';
        $product->sworn_declaration_item_id	 = 13;
        $product->save();
    }

    public static function routes()
    {
        Route::get('/estudiantes/ordenes/{id}', [self::class, 'orders']);
        Route::get('/estudiantes/exams', [self::class, 'examenes']);
        Route::get('/estudiantes/re-registrations', [self::class, 'reinscripciones']);
        Route::get('/estudiantes/prueba', [self::class, 'prueba']);
    }
}
