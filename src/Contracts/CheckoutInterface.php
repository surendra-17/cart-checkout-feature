<?php

    namespace Surendra\CartCheckoutFeature\Contracts;

    interface CheckoutInterface
    {
        public function getTotal();
        public function getItems();
        public function addItem(array $item);
        public function removeItem(string $sku);
    }