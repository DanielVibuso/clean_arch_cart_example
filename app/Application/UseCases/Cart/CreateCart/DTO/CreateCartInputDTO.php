<?php

namespace LittleCommerce\Application\UseCases\Cart\CreateCart\DTO;

class CreateCartInputDTO {
    public function __construct(
        private array $items // Array de itens a serem adicionados inicialmente ao carrinho
    ) {}

    public function getItems(): array {
        return $this->items;
    }
}