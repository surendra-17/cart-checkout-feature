<?php

    namespace Surendra\CartCheckoutFeature\Contracts;

    interface ProductInterface
    {
        public function getPrice($sku):int|float;
        public function getName($sku):string;
    }