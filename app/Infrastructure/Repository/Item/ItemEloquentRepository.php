<?php

namespace LittleCommerce\Infrastructure\Repository\Item;

use LittleCommerce\Domain\Item\Entity\Item as EntityItem;
use LittleCommerce\Domain\Item\Repository\ItemRepositoryInterface;

class ItemEloquentRepository implements ItemRepositoryInterface {

    //Simula comportamento que teria um repositório "real"
    public function __construct(private array $model){}

    public function create($data): EntityItem
    {
        $this->model[] = $data;
        return $data;
    }

    public function toArray(): array
    {
        return $this->model;
    }
}