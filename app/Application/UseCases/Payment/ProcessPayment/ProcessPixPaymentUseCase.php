<?php

namespace LittleCommerce\Application\UseCases\Payment\ProcessPayment;

use LittleCommerce\Domain\Cart\Entity\Cart;

class ProcessPixPaymentUseCase extends ProcessPaymentUseCase {
    public function execute(Cart $cart): array {
        $totalAmount = $this->calculateTotalAmount($cart);
        $discountedAmount = $totalAmount - ($totalAmount * 0.10); // Aplica desconto de 10%
        return [
            'total' => $totalAmount,  
            'totalComDesconto'  => $discountedAmount
        ]; 
    }
}