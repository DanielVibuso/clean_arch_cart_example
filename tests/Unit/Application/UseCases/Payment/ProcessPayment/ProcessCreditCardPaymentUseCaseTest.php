<?php

namespace Tests\LittleCommerce\Unit\Application\UseCases\Payment\ProcessPayment;
//namespace Tests\LittleCommerc\Unit\Application\UseCases\Item;

use PHPUnit\Framework\TestCase;
use LittleCommerce\Domain\Cart\Entity\Cart;
use LittleCommerce\Domain\Item\Entity\Item;
use LittleCommerce\Application\UseCases\Payment\ProcessPayment\DTO\CreditCardPaymentDTO;
use LittleCommerce\Application\UseCases\Payment\ProcessPayment\ProcessCreditCardPaymentUseCase;

class ProcessCreditCardPaymentUseCaseTest extends TestCase
{
    private $cart;
    private $item1;
    private $item2;

    protected function setUp(): void
    {
        parent::setUp();
      
        $this->cart = $this->createMock(Cart::class);

        $this->item1 = $this->createMock(Item::class);
        $this->item1->method('getPrice')->willReturn(10.0);
        $this->item1->method('getCount')->willReturn(2);

        $this->item2 = $this->createMock(Item::class);
        $this->item2->method('getPrice')->willReturn(15.0);
        $this->item2->method('getCount')->willReturn(1);

        $this->cart->method('getItems')->willReturn([$this->item1, $this->item2]);
    }

    public function testProcessCreditCardPayment()
    {
        $paymentDTO = new CreditCardPaymentDTO(
            'Fulano Ipsum', 
            '0000-0000-0000-0000', 
            '12/25', 
            '123', 
            2
        );

        $useCase = new ProcessCreditCardPaymentUseCase();
        $result = $useCase->execute($this->cart, $paymentDTO);

        $totalAmount = ((10.0 * 2 + 15.0 * 1));
        $expectedResult = [
            'total' => $totalAmount,
            'totalComJuros' => $totalAmount * (1 + 0.01) ** 2
        ];

        $this->assertEquals($expectedResult, $result);
    }


    public function testProcessCreditCardPaymentInOneInstallment()
{

    $paymentDTO = new CreditCardPaymentDTO(
        'Fulano Ipsum', 
        '0000-0000-0000-0000', 
        '12/25', 
        '123', 
        1 
    );

    $useCase = new ProcessCreditCardPaymentUseCase();
    $result = $useCase->execute($this->cart, $paymentDTO);


    $totalAmount = (10.0 * 2 + 15.0 * 1);
    $expectedResult = [
        'total' => $totalAmount,
        'desconto' => $totalAmount * 0.10,
        'totalComDesconto' => $totalAmount - ($totalAmount * 0.10),
        'DadosCartao' => $paymentDTO->getData()
    ];

    $this->assertEquals($expectedResult, $result);
}
}