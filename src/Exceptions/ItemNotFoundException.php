<?php

    namespace Surendra\CartCheckoutFeature\Exceptions;

    use Exception;

    /**
     * ItemNotFoundException class.
     */
    class ItemNotFoundException extends Exception{
        /**
         * Constructor.
         *
         * @param string $message
         */
        public function __construct($message = 'Item not found'){
            parent::__construct($message);
        }

        /**
         * Get the exception message.
         *
         * @return string
         */
        public function __toString(): string
        {
            return $this->message;
        }
    }