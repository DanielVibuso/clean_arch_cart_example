<?php

namespace LittleCommerce\Infrastructure\Repository\Cart;

use LittleCommerce\Domain\Cart\Entity\Cart as EntityCart;
use LittleCommerce\Domain\Cart\Repository\CartRepositoryInterface;

class CartEloquentRepository implements CartRepositoryInterface {

    //Simula comportamento que teria um repositório "real"
    public function __construct(private array $model){}

    public function create($data): EntityCart
    {
        return $this->model[] = $data;
        return $data;
    }

    public function toArray(): array
    {
        return $this->model;
    }
}