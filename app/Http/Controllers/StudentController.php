<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Order;
use App\Models\Student;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\States\Order\Paid;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\States\Order\Pending;
use \PDF;

class StudentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ordersPerStudent(Student $student){
        //(!Auth::user() || Auth::user()->id != $student->user_id) ? abort(403) : null;

        return view('estudiantes/orders', ['orders' => Order::where('student_id', $student->id)->get()]); 
    }

    public function order(Order $order){
        //(!Auth::user() || Auth::user()->id != $order->student_id) ? abort(403) : null;

        return view('estudiantes/order', compact('order'));
    }

    public function examenes(){
        return view('estudiantes/exams');
    }

    public function reinscripciones(){
        return view('estudiantes/re-registrations');
    }
    
    public function pay(Order $order, Request $request){
        $payment_id = $request->get('payment_id');
        $response = json_decode(Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-6091462099911216-022015-618419610b93c8431b635e6a46e8bb80-1314495149"));
        
        if ($response->status == "approved"){
            !$order->state->canTransitionTo(Paid::class) ?: $order->state->transitionTo(Paid::class);
            return redirect()->route("order", $order->id);
        }
        return $response->status;
    }

    public function generatePayment(Order $order){

        if($order->state == Pending::class){
            $payment = Payment::create();
            $order->payment_id = $payment->id;
            $order->payment_type = 'BSE';
            $order->save();
        }

        $pdf = PDF::loadView('estudiantes.pdf_coupon', [
            "order" => $order,
            "payment" => $payment,
        ]);
        return $pdf->stream('Cupon BSE.pdf');

    }

    public static function routes()
    {
        Route::group([
            'middleware' => ['auth','verified']
        ], function () {
            Route::get('/estudiantes/{student}/ordenes', [self::class, 'ordersPerStudent'])->name('student.orders');
            Route::get('/estudiantes/ordenes/{order}', [self::class, 'order'])->name('order');
            Route::get('/estudiantes/ordenes/{order}/pago', [self::class, 'pay'])->name('pay');//TODO: esto es solo para probar el webhook despues deletear
            Route::get('/estudiantes/exams', [self::class, 'examenes']);
            Route::get('/estudiantes/re-registrations', [self::class, 'reinscripciones']);
            Route::get('/estudiantes/generate_payment/{order}', [self::class, 'generatePayment'])->name('generate_payment');//TODO: cambiar por post
        });
    }
}
