<?php

use App\Contracts\PaymentGatewayContract;
use App\Services\PaymentGateways\StripePaymentGatewayService;


public function register()
{
    $this->app->singleton(PaymentGatewayContract::class, function ($app) {
        switch (config('payments.default')) {
            case 'stripe':
                return new StripePaymentGatewayService();
            case 'paypal':
                // return new PayPalPaymentGateway();
                // ... other cases ...
            default:
                throw new \Exception("The selected payment gateway is not supported.");
        }
    });
}
