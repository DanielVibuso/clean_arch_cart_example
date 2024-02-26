<?php

namespace LittleCommerce\Application\UseCases\Cart\CreateCart;

use LittleCommerce\Application\UseCases\Cart\CreateCart\DTO\CreateCartInputDTO;
use LittleCommerce\Domain\Cart\Entity\Cart;
use LittleCommerce\Domain\Cart\Repository\CartRepositoryInterface;

class CreateCartUseCase {

    public function __construct(private CreateCartInputDTO $input, private CartRepositoryInterface $repository)
    {
    }

    public function execute() : Cart
    {
        $items = $this->input->getItems();

        $cart = new Cart($items);

        // Salvar o carrinho no "repositório"
        $this->repository->create($cart);

        return $cart;
    }
}