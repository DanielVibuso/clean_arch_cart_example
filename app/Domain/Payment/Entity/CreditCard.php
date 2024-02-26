<?php

namespace LittleCommerce\Domain\Payment\Entity;

class CreditCard
{
    private string $cardholderName;
    private string $cardNumber;
    private string $expirationDate;
    private string $cvv;

    public function __construct(string $cardholderName, string $cardNumber, string $expirationDate, string $cvv)
    {
        $this->cardholderName = $cardholderName;
        $this->cardNumber = $cardNumber;
        $this->expirationDate = $expirationDate;
        $this->cvv = $cvv;
    }

    public function validate(): bool
    {
        if (empty($this->cardholderName)) {
            throw new \InvalidArgumentException("Invalid cardholder name");
        }

        if (empty($this->cardNumber)) {
            throw new \InvalidArgumentException("Invalid card number");
        }

        $expirationDateTime = \DateTime::createFromFormat('m/y', $this->expirationDate);
        $currentDateTime = new \DateTime();
        if ($expirationDateTime <= $currentDateTime) {
            throw new \InvalidArgumentException("Invalid expiration date");
        }

        if (empty($this->cvv) || strlen($this->cvv) !== 3 || !ctype_digit($this->cvv)) {
            throw new \InvalidArgumentException("Invalid CVV");
        }

        return true;

    }
}