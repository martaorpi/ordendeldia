<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Order;
use App\Models\Student;
use App\Models\ExamStudent;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Http;

class StudentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ordersPerStudent($id){
        return view('estudiantes/orders', ['orders' => Order::where('student_id', $id)->get()]); 
    }

    public function order(Order $order){
        return view('estudiantes/order', compact('order'));
    }

    public function examenes(){
        return view('estudiantes/exams');
    }

    public function reinscripciones(){
        return view('estudiantes/re-registrations');
    }
    
    public function prueba(){
        try {
            $id = 695;
            $student = Student::find($id);

            return $student->career;


            Order::create([
                'student_id' => $student->id,
                'tariff_account_id' => 1,
                'amount' => 5000,
            ]);
        } catch (\Throwable $th) {
            return $th;
        }




        /*$exam_table = \App\Models\ExamTable::where('subject_id',1)->orderBy('date','DESC')->first();
        /*$input3['exam_table_id'] = $exam_table->id;
        $input3['condition_exam'] = 'Regular';
        ExamStudent::create($input3);*/

        /*$product = new ExamStudent();
        $product->exam_table_id = $exam_table->id;
        $product->condition_exam = 'Regular';
        $product->sworn_declaration_item_id	 = 13;
        $product->save();*/
    }

    public function pay(Order $order, Request $request){
        $payment_id = $request->get('payment_id');
        $response = json_decode(Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-6091462099911216-022015-618419610b93c8431b635e6a46e8bb80-1314495149"));
        
        if ($response->status == "approved"){
            $order->state->transitionTo(\App\States\Order\Paid::class);

            return redirect()->route("order", $order->id);
        }
        return $response->status;
    }

    public static function routes()
    {
        Route::group([
            'middleware' => ['auth','verified']
        ], function () {
            Route::get('/estudiantes/{id}/ordenes', [self::class, 'ordersPerStudent'])->name('student.orders');
            Route::get('/estudiantes/ordenes/{order}', [self::class, 'order'])->name('order');
            Route::get('/estudiantes/ordenes/{order}/pago', [self::class, 'pay'])->name('pay');
            Route::get('/estudiantes/exams', [self::class, 'examenes']);
            Route::get('/estudiantes/re-registrations', [self::class, 'reinscripciones']);
        });
    }
}
