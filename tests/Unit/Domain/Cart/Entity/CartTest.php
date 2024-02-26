<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use LittleCommerce\Domain\Cart\Entity\Cart;
use LittleCommerce\Domain\Item\Entity\Item;

class CartTest extends TestCase {
    public function testCanCreateCart() {
        $items = json_decode('[{"id":"1", "name":"achocolatado", "price":"10.5", "count":2}]', true);
        $cart = new Cart($items);
        $this->assertInstanceOf(Cart::class, $cart);
        $this->assertEquals($items, $cart->getItems());
    }

    public function testCanAddItemToCart() {

        $items = json_decode('[{"id":"1", "name":"achocolatado", "price":"10.5", "count":2}]', true);
        $cart = new Cart($items);
        $item = new Item(1, 'Test Item', 10.00, 2);
        $cart->addItem($item);
        $items = $cart->getItems();
        $this->assertCount(2, $items);
    }
}