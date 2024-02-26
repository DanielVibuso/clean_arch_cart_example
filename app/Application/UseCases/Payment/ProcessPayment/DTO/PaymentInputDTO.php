<?php

namespace LittleCommerce\Application\UseCases\Payment\ProcessPayment\DTO;

class PaymentInputDTO {
    private string $paymentMethod;
    private ?CreditCardPaymentDTO $creditCardPaymentDTO;

    public function __construct(string $paymentMethod, ?CreditCardPaymentDTO $creditCardPaymentDTO = null) {
        $this->paymentMethod = $paymentMethod;
        $this->creditCardPaymentDTO = $creditCardPaymentDTO;
    }

    public function getPaymentMethod(): string {
        return $this->paymentMethod;
    }

    public function getCreditCardPaymentDTO(): ?CreditCardPaymentDTO {
        return $this->creditCardPaymentDTO;
    }
}