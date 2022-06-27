<?php
    namespace Surendra\CartCheckoutFeature\Exceptions;

    use Exception;

    class NoItemAddedException extends Exception
    {
        public function __construct()
        {
            parent::__construct('No item added to the cart');
        }

        public function __toString()
        {
            return $this->getMessage();
        }
    }
