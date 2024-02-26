<?php

namespace Tests\LittleCommerc\Unit\Application\UseCases\Item;

use LittleCommerce\Application\UseCases\Item\CreateItem\CreateItemUseCase;
use LittleCommerce\Application\UseCases\Item\CreateItem\DTO\CreateItemInputDTO;
use LittleCommerce\Application\UseCases\Item\CreateItem\DTO\CreateItemOutputDTO;
use LittleCommerce\Domain\Item\Entity\Item;
use LittleCommerce\Infrastructure\Repository\Item\ItemEloquentRepository;

use PHPUnit\Framework\TestCase;

class CreateItemUseCaseTest extends TestCase
{
    public function testShouldCreateNewItemViaUseCase()
    {
        $repository = $this->getRepositoryMock();

        $input = new CreateItemInputDTO(
            '9a12ccda-8c90-4e31-b8c9-d5caddbbd0f2',
            'Achocolatado',
            10,
            5,
        );

        $useCase = new CreateItemUseCase($input, $repository);

        $result = $useCase->execute();

        $this->assertInstanceOf(CreateItemOutputDTO::class, $result);

        $data  = $result->getData();


        $this->assertEquals('9a12ccda-8c90-4e31-b8c9-d5caddbbd0f2', $data['id']);
        $this->assertEquals('Achocolatado', $data['name']);
        $this->assertEquals(10, $data['price']);
        $this->assertEquals(5, $data['count']);
    }

    public function getRepositoryMock()
    {        
        $entity = $this->createPartialMock(Item::class, ['setId', 'getId', 'setName', 'getName',  'setPrice', 'getPrice', 'setCount', 'getCount']);
        $entity->method('getId')
            ->willReturn('9a12ccda-8c90-4e31-b8c9-d5caddbbd0f2');

        $entity->method('getName')
            ->willReturn('Achocolatado');
        
        $entity->method('getPrice')
            ->willReturn(10.0);

        $entity->method('getCount')
            ->willReturn(5);

        $entity->expects($this->once())
            ->method('setId')
            ->with('9a12ccda-8c90-4e31-b8c9-d5caddbbd0f2');
        $entity->expects($this->once())
            ->method('setName')
            ->with('Achocolatado');
        $entity->expects($this->once())
            ->method('setPrice')
            ->with(10);
        $entity->expects($this->once())
            ->method('setCount')
            ->with(5);

        $entity->setId('9a12ccda-8c90-4e31-b8c9-d5caddbbd0f2');
        $entity->setName('Achocolatado');
        $entity->setPrice(10);
        $entity->setCount(5);

        $mock = $this->getMockBuilder(ItemEloquentRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['create'])
            ->getMock();
                        
        $mock->expects($this->once())
            ->method('create')
            ->willReturn($entity);
            
        return $mock;
    }
}