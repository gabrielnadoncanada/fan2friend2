<?php

namespace App\Http\Livewire;

use App\Enums\CanadianProvince;
use App\Enums\Country;
use App\Enums\OrderStatus;
use App\Events\OrderPaidEvent;
use App\Facades\Cart;
use App\Models\Order;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Stripe\Stripe;

class OrderCheckout extends Component
{
    public $token; // for unique token

    public $firstName;

    public $lastName;

    public $company;

    public $phone;

    public $address1;

    public $address2;

    public $postalCode;

    public $state;

    public $city;

    public $country;

    public $email;

    public $password;

    public $subtotal;

    public $taxes;

    public $total;

    public $content;

    public $user;


    protected $rules = [
        'firstName' => 'required|alpha|min:2',
        'lastName' => 'required|alpha|min:2',
        'company' => 'nullable',
        'phone' => 'required',
        'address1' => 'required',
        'city' => 'string|required',
        'address2' => 'nullable',
        'postalCode' => 'required|regex:/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/',
        'state' => 'required',
        'country' => 'required',
        'email' => 'required|email',
    ];

    public function mount()
    {

        $this->token = bin2hex(random_bytes(16));
        session()->put('checkout_token', $this->token);

        $this->state = CanadianProvince::QC->name;
        $this->country = Country::CA->name;
        $this->subtotal = Cart::subtotal();
        $this->taxes = Cart::taxes();
        $this->total = Cart::total();
        $this->content = Cart::content();
        if (auth()->guest()) {
            $this->user = new User();
        } else {
            $this->user = auth()->user();
            $this->fill([
                'firstName' => $this->user->first_name,
                'lastName' => $this->user->last_name,
                'email' => $this->user->email,
                'phone' => $this->user->customer->phone ?? '',
                'company' => $this->user->customer->company ?? '',
                'address1' => $this->user->customer->street ?? '',
                'address2' => $this->user->customer->street2 ?? '',
                'city' => $this->user->customer->city ?? '',
                'postalCode' => $this->user->customer->postal_code ?? '',
            ]);

        }
    }

    public function submit()
    {
        if (session()->get('checkout_token') != $this->token) {
            // Token mismatch, possible duplicate submission
            return;
        }

        // Invalidate the token
        session()->forget('checkout_token');

        $validationRules = $this->rules;

        if (auth()->guest()) {
            $validationRules['password'] = [
                'required',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/\d/',
                'regex:/[@$!%*#?&]/',
            ];

            $this->user->update([
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'email' => $this->email,
                'password' => $this->password,
            ]);

            $this->user->assignRole('customer');
            auth()->login($this->user);
        }

        $this->validate($validationRules);

        $this->dispatch('checkoutValidationPassed');
    }

    public function updatedState($state)
    {
        $this->validateOnly('state');
        $this->taxes = Cart::taxes($state);
        $this->total = $this->subtotal + array_sum($this->taxes);
    }

    #[On('processPayment')]
    public function processPayment($data)
    {
        if (Order::where('checkout_token', $this->token)->exists()) {
            // Order with this token already exists
            return;
        }

        Stripe::setApiKey(env('STRIPE_KEY'));
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $this->total * 100,
            'currency' => 'cad',
            'payment_method' => $data['payment_method_id'],
            'confirmation_method' => 'manual',
            'confirm' => true,
            'return_url' => route('checkout'),
        ]);

        if ($paymentIntent->status === 'succeeded') {
            $order = $this->createOrder();
            $this->clearCart();
            $this->notifyUser($order);
            $this->redirect(route('order.success', ['order' => $order]));
        }
    }

    public function createOrder()
    {
        $order = Order::create([
            'user_id' => $this->user->id,
            'number' => 'OR' . rand(100000, 999999),
            'total_price' => $this->total,
            'status' => OrderStatus::PAID,
            'order_date' => now(),
            'payment_method_id' => 'stripe',
            'checkout_token' => $this->token, // Storing the token in the order
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'company' => $this->company,
            'phone' => $this->phone,
            'street' => $this->address1,
            'street2' => $this->address2,
            'postal_code' => $this->postalCode,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'subtotal' => $this->subtotal,
            'taxes' => array_sum($this->taxes),
        ]);

        $order->orderItems()->createMany($this->content->map(function ($item) {
            return [
                'celebrity_id' => $item['options']['celebrity_id'],
                'scheduled_date' => $item['options']['scheduled_date'],
                'start_time' => $item['options']['start_time'],
                'status' => OrderStatus::PAID,
                'unit_price' => $item['price'],
                'quantity' => $item['quantity'],
                'total_price' => $item['subtotal'],
                'duration' => $item['options']['duration'],
            ];
        })->toArray());

        $order->payments()->create([
            'reference' => 'PAY' . rand(100000, 999999),
            'amount' => $this->total,
            'provider' => 'stripe',
            'method' => 'credit_card',
        ]);


        return $order;
    }

    public function notifyUser($order)
    {
        OrderPaidEvent::dispatch($order);
    }

    public function clearCart()
    {
        Cart::clear();
    }

    public function render()
    {
        return view('livewire.order-checkout');
    }
}
