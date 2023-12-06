<?php

namespace App\Services;

class TaxService
{
    public function calculateTax(string $provinceCode, float $amount): array
    {
        $taxRates = $this->getTaxRates($provinceCode);
        $taxes = [];

        foreach ($taxRates as $taxName => $rate) {
            $taxes[$taxName] = number_format($amount * $rate, 2, '.', '');
        }

        return $taxes;
    }

    protected function getTaxRates(string $provinceCode): array
    {
        return config("taxes.tax_rates.{$provinceCode}", []);
    }
}
