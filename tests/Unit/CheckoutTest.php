<?php

namespace Surendra\CartCheckoutFeature\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Surendra\CartCheckoutFeature\Checkout;
use Surendra\CartCheckoutFeature\Exceptions\NoItemAddedException;

class CheckoutTest extends TestCase{

    /**
     * @test
     * @dataProvider getMultipleCarts
     *
     */
    public function get_cart_total() : void
    {
        foreach ($this->getMultipleCarts() as $cart) {
            $checkout = new Checkout();
            foreach ($cart['items'] as $item) {
                $checkout->addItem($item);
            }
            $this->assertEquals($cart['total'], $checkout->getTotal());
        }
    }

    public function getMultipleCarts(): array{
        return [
            [
                'items' => [
                    ['sku' => 'A', 'quantity' => 1],
                    ['sku' => 'B', 'quantity' => 1],
                    ['sku' => 'C', 'quantity' => 1],
                    ['sku' => 'D', 'quantity' => 1],
                    ['sku' => 'E', 'quantity' => 1],
                ],
                'total' => 110
            ],
            [
                'items' => [
                    ['sku' => 'A', 'quantity' => 1],
                    ['sku' => 'B', 'quantity' => 1],
                    ['sku' => 'C', 'quantity' => 2],
                    ['sku' => 'D', 'quantity' => 3],
                    ['sku' => 'E', 'quantity' => 1],
                ],
                'total' => 158
            ],
            [
                'items' => [
                    ['sku' => 'A', 'quantity' => 3],
                    ['sku' => 'B', 'quantity' => 2],
                    ['sku' => 'C', 'quantity' => 6],
                    ['sku' => 'D', 'quantity' => 4],
                    ['sku' => 'E', 'quantity' => 1],
                ],
                'total' => 310
            ]
        ];
    }

    /**
     * @test
     * 
     */
    public function get_items() : void{
        $checkout = new Checkout();
        $checkout->addItem(['sku' => 'A', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'B', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'C', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'D', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'E', 'quantity' => 1]);

        //expected output
        $extepcted_output = [
            [
                'sku' => 'A',
                'quantity' => 1,
            ],
            [
                'sku' => 'B',
                'quantity' => 1,
            ],
            [
                'sku' => 'C',
                'quantity' => 1,
            ],
            [
                'sku' => 'D',
                'quantity' => 1,
            ],
            [
                'sku' => 'E',
                'quantity' => 1,
            ]
        ];
        $this->assertEquals($extepcted_output, $checkout->getItems());
    }

    /**
     * @test
     * @return void
     *
     */
    public function is_throws_exception_when_no_item_added(): void{
        $checkout = new Checkout();
        $this->expectException(NoItemAddedException::class);
        $checkout->getTotal();
    }

    /**
     * @test
     * @return void
     *
     */
    public function add_item_to_cart(): void{
        $checkout = new Checkout();
        $checkout->addItem(['sku' => 'A', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'B', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'C', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'D', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'E', 'quantity' => 1]);
        $this->assertEquals(5, count($checkout->getItems()));
    }

    /**
     * @test
     * @return void
     *
     */
    public function remove_item_from_cart(): void{
        $checkout = new Checkout();
        $checkout->addItem(['sku' => 'A', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'B', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'C', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'D', 'quantity' => 1]);
        $checkout->addItem(['sku' => 'E', 'quantity' => 1]);
        $checkout->removeItem('A');
        $this->assertEquals(4, count($checkout->getItems()));
    }

}
