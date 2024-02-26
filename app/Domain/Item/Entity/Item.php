<?php

namespace LittleCommerce\Domain\Item\Entity;

class Item
{
    public function __construct(
        private ?string $id,
        private ?string $name,
        private ?float $price,
        private ?int $count,
    )
    {
    }

   
    public function getId(): ?string
    {
        return $this->id;
    }

    
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    
    public function getName(): ?string
    {
        return $this->name;
    }

    
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    
    public function getPrice(): ?float
    {
        return $this->price;
    }

    
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    
    public function getCount(): ?int
    {
        return $this->count;
    }

    
    public function setCount(?int $count): void
    {
        $this->count = $count;
    }

    public function validate()
    {
        if(!$this->id) throw new \Exception("Invalid Entity: ID");

        if(!$this->name) throw new \Exception("Invalid Entity: Name");

        if($this->price < 0) throw new \Exception("Invalid Entity: Price");

        if($this->count < 1) throw new \Exception("Invalid Entity: Count");
    }
}