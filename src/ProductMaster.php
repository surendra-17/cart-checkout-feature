<?php

    namespace Surendra\CartCheckoutFeature;

    use Surendra\CartCheckoutFeature\Contracts\ProductInterface;
    /**
     * Product class.
     */
    class ProductMaster implements ProductInterface
    {

        //Product Master List with SKU, Name, and Price
        private $products = [
            'A' => [
                'name' => 'A',
                'price' => 50,
            ],
            'B' => [
                'name' => 'B',
                'price' => 30,
            ],
            'C' => [
                'name' => 'C',
                'price' => 20,
            ],
            'D' => [
                'name' => 'D',
                'price' => 15,
            ],
            'E' => [
                'name' => 'E',
                'price' => 5,
            ],
        ];

        //Product Special prices for this week
        private $special_prices = [
            'A' => [
                [
                    'quantity' => 3,
                    'price' => 130,
                    'priority' => 1,
                    'description' => '3 for 130',
                ]
            ],
            'B' => [
                [
                    'quantity' => 2,
                    'price' => 45,
                    'priority' => 1,
                    'description' => '2 for 45',
                ]
            ],
            'C' => [
                [
                    'quantity' => 2,
                    'price' => 38,
                    'priority' => 2,
                    'description' => '2 for 38',
                ],
                [
                    'quantity' => 3,
                    'price' => 50,
                    'priority' => 1,
                    'description' => '3 for 50',
                ]
            ],
            'D' => [
                [
                    'priority' => 1,
                    'description' => '1 for 25',
                    'purchase_with' => 'A',
                    'price' => 5,
                ]
            ],
            
        ];

        /**
         * Constructor
         */
        public function __construct()
        {
            
        }
        
        /**
         * Get the price of the product
         * @return int|float
         */
        public function getPrice($sku) :int|float
        {
            if(array_key_exists($sku, $this->products)) {
                return $this->products[$sku]['price'];
            }

            throw new \Exception("Product not found");
        }
        
        /**
         * Get the name of the product
         * @return string
         */
        public function getName($sku) : string
        {
            if(array_key_exists($sku, $this->products)) {
                return $this->products[$sku]['name'];
            }

            throw new \Exception("Product not found");
        }

        /**
         * Get the special prices for the product
         * @return array
         */
        public function getSpecialPrices($sku) : array
        {
            if(array_key_exists($sku, $this->special_prices)) {
                return $this->special_prices[$sku];
            }

            return [];
        }
    }
