<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\States\Order\Paid;
use Illuminate\Support\Facades\Http;

class WebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $payment_id = $request['data']['id'];
        $response = json_decode(Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-6091462099911216-022015-618419610b93c8431b635e6a46e8bb80-1314495149"));
        
        try {
            //code...
        

        
            $id = $response->external_reference;
            $order = Order::find($id);
            $order->payment_id = $response->external_reference;
            $order->save();

        } catch (\Throwable $th) {

            throw $th;
            
            dd($th);
        }

        if ($response->status == "approved"){
            !$order->state->canTransitionTo(Paid::class) ?: $order->state->transitionTo(Paid::class);

            //return redirect()->route("order", $order->id);
        }
       // return $response->status;

       response()->json(['success' => 'success'], 200);
    }
}
