<?php

namespace LittleCommerce\Domain\Cart\Entity;

use LittleCommerce\Domain\Item\Entity\Item;

class Cart {
    private array $items = [];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function addItem(Item $item): void {
        $this->items[] = $item;
    }

    public function getItems(): array {
        return $this->items;
    }
}