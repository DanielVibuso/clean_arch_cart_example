<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use LittleCommerce\Application\UseCases\Cart\CreateCart\CreateCartUseCase;
use LittleCommerce\Application\UseCases\Cart\CreateCart\DTO\CreateCartInputDTO;
use LittleCommerce\Domain\Cart\Entity\Cart;
use LittleCommerce\Domain\Cart\Repository\CartRepositoryInterface;
use Mockery;

class CreateCartUseCaseTest extends TestCase {
    public function testCanCreateCart() {

        $items = json_decode('{"id":"1", "name":"achocolatado", "price":"10.5", "count":2}', true);
        $inputDTO = new CreateCartInputDTO($items);

        $repository = Mockery::mock(CartRepositoryInterface::class);
        $repository->shouldReceive('create')->once();
        
        $useCase = new CreateCartUseCase($inputDTO, $repository);
        $cart = $useCase->execute();
        
        $this->assertInstanceOf(Cart::class, $cart);

        $this->assertEquals($items, $cart->getItems());
    }
}