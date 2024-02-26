<?php

namespace LittleCommerce\Application\UseCases\Payment\ProcessPayment\DTO;

use LittleCommerce\Application\UseCases\Shared\InteractorDTO;

class CreditCardPaymentDTO extends InteractorDTO
{
    public string $cardholderName;
    public string $cardNumber;
    public string $expirationDate;
    public string $cvv;
    public ?int $installments; // Número de parcelas

    public function __construct(string $cardholderName, string $cardNumber, string $expirationDate, string $cvv, ?int $installments = null)
    {
        $this->cardholderName = $cardholderName;
        $this->cardNumber = $cardNumber;
        $this->expirationDate = $expirationDate;
        $this->cvv = $cvv;
        $this->installments = $installments;
    }

    public function getCardholderName(): string
    {
        return $this->cardholderName;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    public function getCvv(): string
    {
        return $this->cvv;
    }

    public function getInstallments(): ?int
    {
        return $this->installments;
    }
}