<?php

namespace Tests\LittleCommerce\Unit\Application\UseCases\Payment\ProcessPayment;

use LittleCommerce\Application\UseCases\Payment\ProcessPayment\ProcessPixPaymentUseCase;
use PHPUnit\Framework\TestCase;
use LittleCommerce\Domain\Cart\Entity\Cart;
use LittleCommerce\Domain\Item\Entity\Item;

class ProcessPixPaymentUseCaseTest extends TestCase
{
    public function testProcessPixPayment()
    {

        $cart = $this->createMock(Cart::class);


        $item1 = $this->createMock(Item::class);
        $item1->method('getPrice')->willReturn(10.0);
        $item1->method('getCount')->willReturn(2);

        $item2 = $this->createMock(Item::class);
        $item2->method('getPrice')->willReturn(15.0);
        $item2->method('getCount')->willReturn(1);

        $cart->method('getItems')->willReturn([$item1, $item2]);

        $useCase = new ProcessPixPaymentUseCase();
        $discountedAmount = $useCase->execute($cart);

        $useCase = new ProcessPixPaymentUseCase();
        $result = $useCase->execute($cart);

        
        $totalAmount = (10.0 * 2 + 15.0 * 1);
        $expectedResult = [
            'total' => $totalAmount,
            'totalComDesconto' => $totalAmount * 0.10
        ];

        $this->assertEquals($expectedResult, $result);
    }
}