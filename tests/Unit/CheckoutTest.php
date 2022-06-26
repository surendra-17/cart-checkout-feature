<?php

namespace Surendra\CartCheckoutFeature\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Surendra\CartCheckoutFeature\Checkout;

class CheckoutTest extends TestCase{

    public function testCheckout()
    {
        $checkout = new Checkout();
        $checkout->addItem(['sku' => 'A', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'B', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'C', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'D', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'E', 'quantity' => 1]);
        $this->assertEquals(110, $checkout->getTotal());

        $checkout1 = new Checkout();
        $checkout1->addItem(['sku' => 'A', 'quantity' => 1]);
        $checkout1->addItem(['sku' => 'B', 'quantity' => 1]);
        $checkout1->addItem(['sku' => 'C', 'quantity' => 2]);
        $checkout1->addItem(['sku' => 'D', 'quantity' => 3]);
        $checkout1->addItem(['sku' => 'E', 'quantity' => 1]);
        $this->assertEquals(158, $checkout1->getTotal());

        $checkout2 = new Checkout();
        // Add an item to the cart.
        $checkout2->addItem(['sku' => 'A', 'quantity' => 3]);
        $checkout2->addItem(['sku' => 'B', 'quantity' => 2]);
        $checkout2->addItem(['sku' => 'C', 'quantity' => 6]);
        $checkout2->addItem(['sku' => 'D', 'quantity' => 4]);
        $checkout2->addItem(['sku' => 'E', 'quantity' => 1]);
        $this->assertEquals(310, $checkout2->getTotal());
    }
}
