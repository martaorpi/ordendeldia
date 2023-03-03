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
        
        try {
            $order = Order::find($response->external_reference);
            $order->payment_id = $payment_id;
            $order->payment_type = 'mercadopago';
            $order->paid_at = date("Y-m-d H:i:s");//TODO:deberia estar en la transicion

            $order->save();

            if ($response->status == 'approved'){
                !$order->state->canTransitionTo(Paid::class) ?: $order->state->transitionTo(Paid::class);
            }

        } catch (\Throwable $th) {
            throw $th;
        }

        response()->json(['success' => 'success'], 200);
    }
}
