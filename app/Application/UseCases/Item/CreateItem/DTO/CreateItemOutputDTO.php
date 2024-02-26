<?php

namespace LittleCommerce\Application\UseCases\Item\CreateItem\DTO;

use LittleCommerce\Application\UseCases\Shared\InteractorDTO;

class CreateItemOutputDTO extends InteractorDTO 
{
    public function __construct(
        public string $id,
        public string $name,
        public float $price,
        public int $count,
        )
    {}
    
}