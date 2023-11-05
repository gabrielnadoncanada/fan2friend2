<h2>test payment</h2>
<form action="/book" method="post" id="payment-form">
    <div class="form-row">
        <label for="card-element">Credit or debit card</label>
        <div id="card-element" class="stripe-input">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="amount" value="100"> <!-- Amount in dollars for this example. Adjust accordingly. -->

    <button type="submit">Submit Payment</button>
</form>

<h2>test refund</h2>

<form action="/refund" method="POST">
    @csrf

    <div class="form-group">
        <label for="transactionId">Transaction ID:</label>
        <input type="text" class="form-control" id="transactionId" name="transactionId" required>
    </div>

    <div class="form-group">
        <label for="amount">Amount (leave blank for full refund):</label>
        <input type="number" step="0.01" class="form-control" id="amount" name="amount">
    </div>

    <button type="submit" class="btn btn-primary">Process Refund</button>
</form>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('pk_test_51O1ZIfBveDBUOoxc6WpfiEZWULtuVmR0Cve1KUiSaxnNf4IYU0TLVKL1LXW8EPJ3EuI5zwRr0IwJLnXNVQSebklH00OwDe4UXh'); // Replace 'YOUR-PUBLISHABLE-KEY' with your Stripe public key
    var elements = stripe.elements();

    // Create an instance of the card Element
    var card = elements.create('card');

    // Add an instance of the card Element into the `card-element` div
    card.mount('#card-element');

    card.addEventListener('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'token');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>
