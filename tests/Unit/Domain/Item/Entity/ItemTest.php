<?php

namespace Tests\LittleCommerce\Unit\Domain\Item\Entity;

use LittleCommerce\Domain\Item\Entity\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testIfItemValidationThrowsExceptionToAnInvalidId()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid Entity: ID');

        $item = new Item(null, 'Achocolatado', 10.5, 1);

        $item->validate();
    }

    public function testIfItemValidationThrowsExceptionToAnInvalidName()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid Entity: Name');

        $item = new Item('UUID', null, 10.5, 1);

        $item->validate();
    }

    public function testIfItemValidationThrowsExceptionToAnInvalidPrice()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid Entity: Price');

        $book = new Item('UUID', 'Achocolatado', -10, 1);

        $book->validate();
    }

    public function testIfItemValidationThrowsExceptionToAnInvalidCount()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid Entity: Count');

        $book = new Item('UUID', 'Achocolatado', 10.5, 0);

        $book->validate();
    }
}