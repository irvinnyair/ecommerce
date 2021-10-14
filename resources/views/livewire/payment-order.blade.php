<div>
        {{-- @php
        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        //poner costo de envio
        $shipments = new MercadoPago\Shipments();
        $shipments->cost = $order->shipping_cost;
        $shipments->mode = "not_specified";

        $preference->shipments = $shipments;

        // Crea un ítem en la preferencia
        // Crea un ítem en la preferencia
        foreach ($items as $product) {
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->price;

            $products[] = $item;
            
        }
        //...
        $preference->back_urls = array(
            "success" => route('orders.pay', $order),
            "failure" => "http://www.tu-sitio/failure",
            "pending" => "http://www.tu-sitio/pending"
        );
        $preference->auto_return = "approved";

        $preference->items = $products;
        $preference->save();
    @endphp --}}

    <div class="grid grid-cols-5 gap-6 container py-8">

        <div class="col-span-3">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase">
                    <span class="font-semibold">Número de orden:</span> Orden-{{$order->id}}
                </p>
            </div>
    
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <p class="text-lg font-semibold uppercase">
                            Envío
                        </p>
    
                        @if ($order->envio_type == 1)
                            <p class="text-sm">Los productos deben ser recogidos en tienda</p>
                            <p class="text-sm">Calle falsa</p>
                        @else
                        <p class="text-sm">Los productos deben ser enviados a</p>
                        <p class="text-sm"> {{$order->address}} </p>
                        <p>{{ $order->department->name }} - {{ $order->city->name }} - {{ $order->district->name }}</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-lg font-semibold uppercase">
                            Datos de contacto
    
                            <p class="text-sm">Persona que recibe: {{ $order->contact }}</p>
                            <p class="text-sm">Télefono de contacto: {{ $order->phone }}</p>
                        </p>
                    </div>
                </div>
            </div>
    
            <div class="bg-white shadow-lg rounded-lg p-6 text-gray-700 mb-6">
    
                <p class="text-xl font-semibold mb-4">Resumen</p>
    
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Precio</th>
                            <th>Cant.</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="divde-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="flex">
                                        <img class="h-15 w-20 object-cover mr-4 " 
                                        src="{{ $item->options->image }}" alt="">
                                        <article>
                                            <h1 class="font-bold">{{ $item->name }}</h1>
                                            <div class="flex text-sm">
                                                @isset ($item->options->color)
                                                    Color: {{__($item->options->color)}}
                                                @endisset
    
                                                @isset ($item->options->size)
                                                    - {{__($item->options->size)}}
                                                @endisset
                                            </div>
                                        </article>
                                    </div>
                                </td>
                                <td class="text-center">
                                    $ {{ $item->price }} MXN.
                                </td>
                                <td class="text-center">
                                    {{ $item->qty }}
                                </td>
                                <td class="text-center">
                                    $ {{ $item->price * $item->qty }} MXN.
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    
            </div>
        </div>

        <div class="col-span-2">
            <div class="bg-white rounded-lg shadow-lg px-6 pt-6">
                <div class="flex justify-between items-center mb-6">
                    <img class="h-8" src="{{ asset('img/tarjetas.jpg') }}" alt="">
                    <div class="text-gray-700">
                        <p class="text-sm font-semibold">
                            Subtotal: $ {{ $order->total - $order->shipping_cost }} MXN.
                        </p>
                        <p class="text-sm font-semibold">
                            Envío: $ {{ $order->shipping_cost }} MXN.
                        </p>
                        <p class="text-lg font-semibold">
                            Total: $ {{ $order->total }} MXN.
                        </p>
                        <div class="cho-container">
        
                        </div>
                    </div>
                </div>

                <div id="paypal-button-container"></div>
            </div>
        </div>

    </div>


    @push('script')
        {{-- <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
        Agrega credenciales de SDK
          const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                locale: 'es-AR'
          });
        
          Inicializa el checkout
          mp.checkout({
              preference: {
                  id: '{{$preference->id}}'
              },
              render: {
                    container: '.cho-container',Indica dónde se mostrará el botón de pago
                    label: 'Pagar', Cambia el texto del botón de pago (opcional)
              }
        });
        </script> --}}

        <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}"> // Replace YOUR_CLIENT_ID with your sandbox client ID
        </script>

        <!-- Add the checkout buttons, set up the order and approve the order -->
        <script>
            paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                purchase_units: [{
                    amount: {
                    value: "{{ $order->total }}"
                    }
                }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    Livewire.emit('payOrder')
                    /* alert('Transaction completed by ' + details.payer.name.given_name); */
                });
            }
            }).render('#paypal-button-container'); // Display payment options on your web page
      </script>
    @endpush
</div>
