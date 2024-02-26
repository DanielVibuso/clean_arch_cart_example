<?php

namespace LittleCommerce\Application\UseCases\Payment\ProcessPayment;

use LittleCommerce\Domain\Cart\Entity\Cart;

class ProcessPaymentUseCase {
    protected function calculateTotalAmount(Cart $cart): float {
        $totalAmount = 0.0;
        foreach ($cart->getItems() as $item) {
            $totalAmount += $item->getPrice() * $item->getCount();
        }
        return $totalAmount;
    }
}