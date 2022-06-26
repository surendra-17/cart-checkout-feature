<?php
    // Autoload files using the Composer autoloader.
    require_once __DIR__ . '/vendor/autoload.php';

    echo '<pre>';
    echo "Welcome To Shopping Cart\n";
    use Surendra\CartCheckoutFeature\Checkout;
    // Create a new instance of the Checkout class.
    $checkout1 = new Checkout();

    // Add an item to the cart.
    $checkout1->addItem(['sku' => 'A', 'quantity' => 1]);
    $checkout1->addItem(['sku' => 'B', 'quantity' => 1]);
    $checkout1->addItem(['sku' => 'C', 'quantity' => 2]);
    $checkout1->addItem(['sku' => 'D', 'quantity' => 3]);
    $checkout1->addItem(['sku' => 'E', 'quantity' => 1]);

    echo "Cart List 1:\n";
    echo "SKU\t\tQuantity\tPrice\n";
    echo "----------------------------------------------------------------\n";
    // Get the cart list.
    $cart_list = $checkout1->getItems();
    foreach ($cart_list as $item) {
        echo $item['sku'] . "\t\t" . $item['quantity'] . "\t\t" . $checkout1->calculateItemPrice($item) . "\n";
    }
    echo "----------------------------------------------------------------\n";
    echo "\t\t\tTotal: ". $checkout1->getTotal() . "\n";

    //new cart
    echo "----------------------------------------------------------------\n"; 

    $checkout2 = new Checkout();

    // Add an item to the cart.
    $checkout2->addItem(['sku' => 'A', 'quantity' => 3]);
    $checkout2->addItem(['sku' => 'B', 'quantity' => 2]);
    $checkout2->addItem(['sku' => 'C', 'quantity' => 6]);
    $checkout2->addItem(['sku' => 'D', 'quantity' => 4]);
    $checkout2->addItem(['sku' => 'E', 'quantity' => 1]);

    echo "Cart List 2:\n";
    echo "SKU\t\tQuantity\tPrice\n";
    echo "----------------------------------------------------------------\n";
    // Get the cart list.
    $cart_list = $checkout2->getItems();
    foreach ($cart_list as $item) {
        echo $item['sku'] . "\t\t" . $item['quantity'] . "\t\t" . $checkout2->calculateItemPrice($item) . "\n";
    }
    echo "----------------------------------------------------------------\n";
    echo "\t\t\tTotal: ". $checkout2->getTotal() . "\n";

