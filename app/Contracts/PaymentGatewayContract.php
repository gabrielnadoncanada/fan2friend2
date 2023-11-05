<?php

namespace App\Contracts;

interface PaymentGatewayContract
{
    public function charge($amount, array $data): array;
    public function refund($transactionId, $amount = null): array;
    // Any other common methods you need
}
