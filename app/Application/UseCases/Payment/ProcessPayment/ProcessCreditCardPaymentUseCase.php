<?php

namespace LittleCommerce\Application\UseCases\Payment\ProcessPayment;

use LittleCommerce\Application\UseCases\Payment\ProcessPayment\DTO\CreditCardPaymentDTO;
use LittleCommerce\Domain\Cart\Entity\Cart;
use LittleCommerce\Domain\Payment\Entity\CreditCard;

class ProcessCreditCardPaymentUseCase extends ProcessPaymentUseCase {
    public function execute(Cart $cart, CreditCardPaymentDTO $creditCardPaymentDTO): array {

        $creditCard = new CreditCard(
            $creditCardPaymentDTO->getCardholderName(),
            $creditCardPaymentDTO->getCardNumber(),
            $creditCardPaymentDTO->getExpirationDate(),
            $creditCardPaymentDTO->getCvv()
        );

        $creditCard->validate();

        $totalAmount = $this->calculateTotalAmount($cart);

        if ($creditCardPaymentDTO->getInstallments() == 1) {
            return [
                'total' => $totalAmount,  
                'desconto'  => $totalAmount * 0.10, 
                'totalComDesconto' => $totalAmount - ($totalAmount * 0.10),
                'DadosCartao' => $creditCardPaymentDTO->getData()
            ]; 

        }

        $totalAmountWithInterest = $this->applyInterest($totalAmount, $creditCardPaymentDTO->getInstallments());
        return [
            'total' => $totalAmount,  
            'totalComJuros'  => $totalAmountWithInterest, 
        ]; 
    }

    private function applyInterest(float $principal, int $installments): float {
        $monthlyInterestRate = 0.01; // 1% ao mês
        $totalAmount = $principal * (1 + $monthlyInterestRate) ** $installments;
        return $totalAmount;
    }
}