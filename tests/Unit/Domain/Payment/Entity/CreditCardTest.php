<?php

namespace Tests\LittleCommerce\Unit\Domain\Payment\Entity;

use PHPUnit\Framework\TestCase;
use LittleCommerce\Domain\Payment\Entity\CreditCard;

class CreditCardTest extends TestCase
{
    public function testValidateValidCreditCard()
    {
        // Arrange
        $creditCard = new CreditCard(
            'Fulano Ipsum',
            '1234567890123456',
            '12/25',
            '123'
        );

        // Act
        $isValid = $creditCard->validate();

        // Assert
        $this->assertTrue($isValid);
    }

    public function testValidateInvalidCreditCardNameEmpty()
    {
        // Arrange
        $creditCard = new CreditCard(
            '',
            '1234567890123456',
            '12/25',
            '123'
        );

        // Act
        $this->expectException(\InvalidArgumentException::class);
        $creditCard->validate();
    }

    public function testValidateInvalidCreditCardNumberEmpty()
    {
        // Arrange
        $creditCard = new CreditCard(
            'Fulano Ipsum',
            '',
            '12/25',
            '123'
        );

        // Act
        $this->expectException(\InvalidArgumentException::class);
        $creditCard->validate();
    }

    public function testValidateInvalidCreditCardExpirationDatePast()
    {
        // Arrange
        $creditCard = new CreditCard(
            'Fulano Ipsum',
            '1234567890123456',
            '12/20', // Data passada
            '123'
        );

        // Act
        $this->expectException(\InvalidArgumentException::class);
        $creditCard->validate();
    }

    public function testValidateInvalidCreditCardCVVEmpty()
    {
        // Arrange
        $creditCard = new CreditCard(
            'Fulano Ipsum',
            '1234567890123456',
            '12/25',
            ''
        );

        // Act
        $this->expectException(\InvalidArgumentException::class);
        $creditCard->validate();
    }

    public function testValidateInvalidCreditCardCVVContainsLetters()
    {
        // Arrange
        $creditCard = new CreditCard(
            'Fulano Ipsum',
            '1234567890123456',
            '12/25',
            'abc' // Contém letras
        );

        // Act
        $this->expectException(\InvalidArgumentException::class);
        $creditCard->validate();
    }

    public function testValidateInvalidCreditCardCVVLength()
    {
        // Arrange
        $creditCard = new CreditCard(
            'Fulano Ipsum',
            '1234567890123456',
            '12/25',
            '12' // Menos de 3 caracteres
        );

        // Act
        $this->expectException(\InvalidArgumentException::class);
        $creditCard->validate();
    }
}
