{{-- resources/views/livewire/order-payment.blade.php --}}


<div wire:ignore id="card-element"></div>
<div>
    <div>
        <div class="mt-6 flex items-start">
            <input id="same-as-shipping" name="terms" type="checkbox"
                   class="mt-1 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            <div class="ml-3">
                <label for="same-as-shipping" class="text-sm font-medium text-gray-900">
                    {{__('app.checkout.termsTitle')}}
                </label>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="pt-[25px]">

    </div>
</div>



@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.addEventListener("load", function () {
            var stripe = Stripe('pk_test_51OGpt3GWtGIyVboJDjEnpAOuHCRF8vof0CavrQf7rTBpKjoyK6bNBkcMBwvyXewRB4O0XZyJ2uAJmkEfG4XoVFq900BY2FG4lp');
            var elements = stripe.elements();
            var card = elements.create('card', {
                hidePostalCode: true
            });
            card.mount('#card-element');

            Livewire.on('checkoutValidationPassed', () => {
                stripe.createPaymentMethod('card', card).then(function (result) {
                    if (result.error) {
                        console.log(result.error.message)
                    } else {
                        stripePaymentMethodHandler(result.paymentMethod.id);

                    }
                });
            });
        });
        function stripePaymentMethodHandler(paymentMethodId) {
            // You can use AJAX or another method to send the ID to your server
            var data = {
                payment_method_id: paymentMethodId
            };

            Livewire.dispatch('processPayment', [data]);

        }

    </script>
@endpush
