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
            "success" => route('order', $order->id),
            "failure" => route('order', $order->id),
            "pending" => route('order', $order->id)
        );
        $preference->auto_return = "approved";
        $preference->external_reference = $order->id;

        $preference->items = array($item);
        $preference->save();
    @endphp
    <x-slot name="header"></x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="col-12 text-center">
                        <b class="text-grey h4">ORDEN DE PAGO</b>
                        <span class="ml-3 badge bg-{{$order->state->color()}}">{{ $order->state->name() }}</span>
                    </div>
                    @if($order->student)
                        <table class="table mt-4">
                            <tr>
                                <td width="25"></td>
                                <td width="20">
                                    Apellido y Nombre
                                    <div class="h5">{{ $order->student->last_name }}, {{ $order->student->first_name }}</div>
                                </td>
                                <td width="20">
                                    DNI
                                    <div class="h5">{{ $order->student->dni }}</div>
                                </td>
                                <td width="25"></td>
                            </tr>

                            <tr>
                                <td width="25"></td>
                                <td width="20">
                                    Carrera
                                    <div class="h5">{{ $order->student->career->title }}</div>
                                </td>
                                <td width="20"></td>
                                <td width="25"></td>
                            </tr>

                            <tr>
                                <td width="25"></td>
                                <td width="20">
                                    Fecha Generada
                                    <div class="h5">{{ date('d/m/Y', strtotime($order->created_at)) }}</div>
                                </td>
                                <td width="20">
                                    Fecha Vencimiento
                                    <div class="h5">{{ date('d/m/Y', strtotime($order->expired_at)) }}</div>
                                </td>
                                <td width="25"></td>
                            </tr>

                            <tr>
                                <td width="25"></td>
                                <td width="20">
                                    Descripción
                                    <div class="h5">{{ $order->description }}</div>
                                </td>
                                <td width="20">
                                    Monto
                                    <div class="h5">${{ $order->amount }}</div>
                                </td>
                                <td width="25"></td>
                            </tr>
                        </table>
                    @endif
                    
                </div>

                <div class="float-left">
                    <a href="" class="btn btn-success">Imprimir</a>
                </div>

                <div class="float-right">
                    @if ($order->state == "App\\States\\Order\\Pending")
                        <div class="cho-container"></div>
                    @endif
                </div>
            </div>
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