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
        $response = json_decode(Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=" . config('services.mercadopago.token')));
        
        $order = Order::find($response->external_reference);
        $order->payment_id = $payment_id;
        $order->save();

        if ($response->status == "approved"){
            !$order->state->canTransitionTo(Paid::class) ?: $order->state->transitionTo(Paid::class);
        }

        response()->json(['success' => 'success'], 200);
    }
}
