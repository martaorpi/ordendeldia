<x-app-layout>
    @php
        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();
        
        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = $order->description;
        $item->quantity = 1;
        $item->unit_price = $order->amount;

        $preference->back_urls = array(
            "success" => route('order', $order->id),//TODO: esto es solo para probar el webhook despues deletear
            "failure" => "http://www.tu-sitio/failure",
            "pending" => "http://www.tu-sitio/pending"
        );
        $preference->auto_return = "approved";
        $preference->external_reference = $order->id;

        $preference->items = array($item);
        $preference->save();
    @endphp
    <x-slot name="header"></x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h4">
            Carrera: {{ auth()->user()->student[0]->career->title }}
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="h3 text-center">ORDEN DE PAGO</p>
                    <span class="badge bg-{{$order->state->color()}}">{{ $order->state->name() }}</span>
                </div>
            </div>
        </div>
        <div class="float-right">
            @if ($order->state == "App\\States\\Order\\Pending")
                <div class="cho-container"></div>
            @endif
        </div>
    </div>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
            locale: 'es-AR'
        });

        mp.checkout({
            preference: {
                id: '{{ $preference->id }}'
            },
            render: {
                container: '.cho-container',
                label: 'Pagar',
            }
        });
    </script>
</x-app-layout>