<?php
    namespace Surendra\CartCheckoutFeature;

    use Surendra\CartCheckoutFeature\Contracts\CheckoutInterface;
    use Surendra\CartCheckoutFeature\Exceptions\NoItemAddedException;
    use Surendra\CartCheckoutFeature\ProductMaster;
    class Checkout implements CheckoutInterface
    {
        private $items = [];
        private $total = 0;


        public function __construct()
        {
            $this->productMaster = new ProductMaster();
        }

        /**
         * Cart total.
         * @return int|float
         *
         */
        public function getTotal() : int|float
        {
            if(empty($this->items)){
                throw new NoItemAddedException();
            }
            $this->total = array_reduce($this->items, function($carry, $item) {
                return $carry + $this->calculateItemPrice($item);
            }, 0);
            return $this->total;
        }
        
        /**
         * et list of items in the cart
         * @return array
         *
         */
        public function getItems() : array
        {
            if(empty($this->items)){
                throw new NoItemAddedException();
            }
            return $this->items;
        }
        
        /**
         * Add an item to the checkout.
         * @param array $item The item to add.
         *
         */
        public function addItem(array $item):array
        {
            if(!empty($item) && count($item) > 0){
                $this->items[] = $item;
            }
            return $this->items;
        }
        
        /**
         * Remove an item from the cart.
         * @param string $item The item to remove.
         *
         */
        public function removeItem($sku) :void
        {
            $this->items = array_filter($this->items, function($item) use ($sku) {
                return $item['sku'] !== $sku;
            });
        }

        /**
         * Calculate the total price of the items in the cart.
         * @return int|float
         *
         */
        public function calculateItemPrice($item) :int|float
        {
            // print_r($item);
            $price = $this->productMaster->getPrice($item['sku']);
            $quantity = $item['quantity'];
            $special_prices = $this->productMaster->getSpecialPrices($item['sku']);
            if(is_array($special_prices) && count($special_prices) > 0){
                $priority = array_column($special_prices, 'priority');
                $temp_price = 0;
                array_multisort($priority, SORT_ASC, $special_prices);
                // echo "multisort\n";
                // print_r($special_prices);
                foreach($special_prices as $special_price){
                    // If the quantity is greater than the special price quantity, then we need to calculate the price
                    if(!empty($special_price['purchase_with']) && in_array($special_price['purchase_with'],array_column($this->items, 'sku'))){
                        $purchase_with_item_array= array_filter($this->items, function($item) use ($special_price){
                            return $item['sku'] == $special_price['purchase_with'];
                        });

                        $purchase_with_item = $purchase_with_item_array[0];

                        $purchase_with_item_count = $purchase_with_item['quantity'];

                        if($purchase_with_item_count > 0){
                            if($quantity == $purchase_with_item['quantity']){
                                $temp_price += $quantity * $special_price['price'];
                                $quantity -= $quantity;
                                $purchase_with_item_count -= $quantity;
                            }else if($quantity < $purchase_with_item['quantity']){
                                $temp_price += $quantity * $special_price['price'];
                                $quantity = 0;
                            }else if($quantity > $purchase_with_item['quantity']){
                                $temp_price += $purchase_with_item['quantity'] * $special_price['price'];
                                $quantity -= $purchase_with_item['quantity'];
                                $purchase_with_item_count -= $purchase_with_item['quantity'];
                            }
                        }
                    }else{
                        while($quantity >= $special_price['quantity']){
                            $temp_price += $special_price['price'];
                            $quantity -= $special_price['quantity'];
                        }
                    }
                

                    if($quantity <= 0){
                        break;
                    }
                }

                if($quantity > 0){
                    $temp_price += $quantity * $price;
                }
                
                return $temp_price;


            }else{
                return $price * $quantity;
            }
            

        }
    }