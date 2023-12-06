<main class="bg-white px-4 pb-24 pt-16 sm:px-6 sm:pt-24 lg:px-8 lg:py-32">
    <div class="mx-auto max-w-3xl">
        <div class="max-w-xl">
            <h1 class="text-base font-medium text-indigo-600">{{ __('app.checkout_success.thank_you') }}</h1>
            <p class="mt-2 text-4xl font-bold tracking-tight">{{ __('app.checkout_success.its_on_the_way') }}</p>
            <p class="mt-2 text-base text-gray-500">{{ __('app.checkout_success.your_order_has_shipped', ['number' => $order->number]) }}</p>
        </div>

        <section aria-labelledby="order-heading" class="mt-10 border-t border-gray-200">
            <h2 id="order-heading" class="sr-only">{{ __('app.checkout_success.your_order') }}</h2>

            <h3 class="sr-only">{{ __('app.checkout_success.items') }}</h3>
            @foreach($order->orderItems as $item)
                <div class="flex space-x-6 border-b border-gray-200 py-10">
                    <img src="{{ $item->celebrity->image }}" alt="{{ $item->celebrity->full_name }}"
                         class="h-20 w-20 flex-none rounded-lg bg-gray-100 object-cover object-center sm:h-40 sm:w-40">
                    <div class="flex flex-auto flex-col">
                        <div>
                            <h4 class="font-medium text-gray-900">
                                <a href="#">{{ $item->celebrity->full_name }}</a>
                            </h4>
                            <p class="mt-2 text-sm text-gray-600">{{$item->celebrity->description}}</p>
                        </div>
                        <div class="mt-6 flex flex-1 items-end">
                            <dl class="flex space-x-4 divide-x divide-gray-200 text-sm sm:space-x-6">
                                <div class="flex">
                                    <dt class="font-medium text-gray-900">{{ $item->scheduled_date }}
                                        - {{ $item->start_time }}</dt>
                                </div>
                                <div class="flex pl-4 sm:pl-6">
                                    <dt class="font-medium text-gray-900">{{ __('app.checkout_success.unit_price') }}</dt>
                                    <dd class="ml-2 text-gray-700"> {{ $item->unit_price }}$</dd>
                                </div>
                                <div class="flex pl-4 sm:pl-6">
                                    <dt class="font-medium text-gray-900">{{ __('app.checkout_success.quantity') }}</dt>
                                    <dd class="ml-2 text-gray-700"> {{ $item->quantity }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="sm:ml-40 sm:pl-6">
                <h3 class="sr-only">{{ __('app.checkout_success.your_information') }}</h3>
                <h4 class="sr-only">{{ __('app.checkout_success.addresses') }}</h4>
                <dl class="grid grid-cols-2 gap-x-6 py-10 text-sm">

                    <div>
                        <dt class="font-medium text-gray-900">{{ __('app.checkout_success.billing_address') }}</dt>
                        <dd class="mt-2 text-gray-700">
                            <address class="not-italic">
                                <span class="block">{{$order->first_name  . ' ' . $order->last_name}}</span>
                                <span class="block">{{$order->street1}}</span>
                                <span class="block">{{$order->street2}}</span>
                                <span class="block">{{$order->city}},
                                    {{$order->state}}{{$order->postal_code}}
                                </span>
                            </address>
                        </dd>
                    </div>
                    @php
                        $payment = $order->payments->first();
                    @endphp
                    <div>
                        <dt class="font-medium text-gray-900">{{ __('app.checkout_success.payment_method') }}</dt>
                        <dd class="mt-2 text-gray-700">
                            <p>{{$payment->reference}}</p>
                            <p>{{$payment->provider}}</p>
                            <p>{{$payment->method}}</p>
                        </dd>
                    </div>
                </dl>
                <h3 class="sr-only">{{ __('app.checkout_success.summary') }}</h3>

                <dl class="space-y-6 border-t border-gray-200 pt-10 text-sm">
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-900">{{ __('app.checkout_success.subtotal') }}</dt>
                        <dd class="text-gray-700">{{$order->subtotal}}</dd>
                    </div>

                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-900">{{ __('app.checkout_success.taxes') }}</dt>
                        <dd class="text-gray-700">{{$order->taxes}}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-900">{{ __('app.checkout_success.total') }}</dt>
                        <dd class="text-gray-900">{{$order->total_price}}</dd>
                    </div>
                </dl>
            </div>
        </section>
    </div>
</main>


