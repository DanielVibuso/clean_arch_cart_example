<?php

namespace LittleCommerce\Infrastructure\Repository\CreditCard;

use LittleCommerce\Domain\Cart\Repository\CartRepositoryInterface;
use LittleCommerce\Domain\Payment\Entity\CreditCard;

class CreditCardEloquentRepository implements CartRepositoryInterface {

    //Simula comportamento que teria um repositório "real"
    public function __construct(private array $model){}

    public function create($data): CreditCard
    {
        return $this->model[] = $data;
        return $data;
    }

    public function toArray(): array
    {
        return $this->model;
    }
}