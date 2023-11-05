<?php

namespace App\Services\PaymentGateways;

use App\Contracts\PaymentGatewayContract;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Refund;

class StripePaymentGatewayService implements PaymentGatewayContract
{
    public function __construct()
    {
        Stripe::setApiKey(config('payments.stripe.secret'));
    }

    public function charge($amount, array $data): array
    {
        $charge = Charge::create([
            'amount' => $amount * 100, // Stripe expects cents
            'currency' => $data['currency'] ?? 'usd',
            'source' => $data['token'],
            'description' => $data['description'] ?? '',
        ]);

        // Return relevant data as per your needs
        return ['id' => $charge->id, 'amount' => $charge->amount / 100];
    }

    public function refund($transactionId, $amount = null): array
    {
        $refundData = [
            'charge' => $transactionId
        ];

        if ($amount) {
            $refundData['amount'] = $amount * 100; // Convert to cents for Stripe
        }

        $refund = Refund::create($refundData);

        // Verify if the refund was successful
        if ($refund->status !== 'succeeded') {
            throw new \Exception('Refund failed');
        }

        // Return relevant data as per your needs
        return ['id' => $refund->id, 'amount' => $refund->amount / 100];
    }
}
