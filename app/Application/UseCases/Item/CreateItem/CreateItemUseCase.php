<?php

namespace LittleCommerce\Application\UseCases\Item\CreateItem;

use LittleCommerce\Application\UseCases\Item\CreateItem\DTO\CreateItemInputDTO;
use LittleCommerce\Application\UseCases\Item\CreateItem\DTO\CreateItemOutputDTO;
use LittleCommerce\Domain\Item\Entity\Item;
use LittleCommerce\Domain\Item\Repository\ItemRepositoryInterface;

class CreateItemUseCase {

    public function __construct(private CreateItemInputDTO $input, private ItemRepositoryInterface $repository)
    {
    }

    public function execute() : CreateItemOutputDTO
    {
        $data = $this->input->getData();
        
        $entity = new Item(
            $data['id'], 
            $data['name'], 
            $data['price'], 
            $data['count']
        );

        $entity->validate();
        
        $result = $this->repository->create($entity);
        
        return new CreateItemOutputDTO(
            id: $result->getId(),
            name: $result->getName(),
            price: $entity->getPrice(),
            count: $entity->getCount(),
        );
    }
}