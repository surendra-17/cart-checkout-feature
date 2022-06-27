<?php

namespace Surendra\CartCheckoutFeature\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Surendra\CartCheckoutFeature\Exceptions\ItemNotFoundException;
use Surendra\CartCheckoutFeature\ProductMaster;

/**
 * ProductMasterTest class.
 */
class ProductMasterTest extends TestCase
{

    /**
     * @test
     * 
     */
    public function throw_item_not_found_exception():void
    {
        $product_master = new ProductMaster();
        $this->expectException(ItemNotFoundException::class);
        $product_master->getName('F');
    }
}
