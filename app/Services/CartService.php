<?php

namespace App\Services;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class CartService
{
    const MINIMUM_QUANTITY = 1;

    const DEFAULT_INSTANCE = 'shopping-cart';

    protected $session;

    protected $instance;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function add($id, $name, $price, $quantity, $options = []): void
    {
        $cartItem = $this->createCartItem($name, $price, $quantity, $options);

        $content = $this->getContent();

        if ($content->has($id)) {
            $existingItem = $content->get($id);
            $existingItem['quantity'] += $quantity;
            $existingItem['subtotal'] = round($existingItem['price'] * $existingItem['quantity'], 2);
        } else {
            $cartItem = $this->createCartItem($name, $price, $quantity, $options);
            $content->put($id, $cartItem);
        }

        $this->session->put(self::DEFAULT_INSTANCE, $content);
    }

    public function update(string $id, string $action): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem = $content->get($id);

            switch ($action) {
                case 'plus':
                    $cartItem->put('quantity', $content->get($id)->get('quantity') + 1);

                    break;
                case 'minus':
                    $updatedQuantity = $content->get($id)->get('quantity') - 1;

                    if ($updatedQuantity < self::MINIMUM_QUANTITY) {
                        $updatedQuantity = self::MINIMUM_QUANTITY;
                    }

                    $cartItem->put('quantity', $updatedQuantity);

                    break;
            }

            $content->put($id, $cartItem);

            $this->session->put(self::DEFAULT_INSTANCE, $content);
        }
    }

    public function remove(string $id): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $this->session->put(self::DEFAULT_INSTANCE, $content->except($id));
        }
    }

    public function clear(): void
    {
        $this->session->forget(self::DEFAULT_INSTANCE);
    }

    public function content(): Collection
    {
        return is_null($this->session->get(self::DEFAULT_INSTANCE)) ? collect([]) : $this->session->get(self::DEFAULT_INSTANCE);
    }

    public function subtotal(): float
    {
        $content = $this->getContent();

        $subtotal = $content->reduce(function ($total, $item) {
            return $total += $item->get('price') * $item->get('quantity');
        });

        return round($subtotal, 2);
    }

    public function taxes($provinceCode = 'QC'): array
    {
        $taxService = new TaxService();

        return $taxService->calculateTax($provinceCode, $this->subtotal());
    }

    public function total(): float
    {
        return round($this->subtotal() + array_sum($this->taxes()), 2);
    }

    protected function getContent(): Collection
    {
        return $this->session->has(self::DEFAULT_INSTANCE) ? $this->session->get(self::DEFAULT_INSTANCE) : collect();
    }

    protected function createCartItem(string $name, string $price, string $quantity, array $options): Collection
    {
        $price = floatval($price);
        $quantity = intval($quantity);

        if ($quantity < self::MINIMUM_QUANTITY) {
            $quantity = self::MINIMUM_QUANTITY;
        }

        return collect([
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'subtotal' => number_format($price * $quantity, 2, '.', ''),
            'options' => $options,
        ]);
    }

    public function isEmpty(): bool
    {
        return $this->content()->isEmpty();
    }
}
