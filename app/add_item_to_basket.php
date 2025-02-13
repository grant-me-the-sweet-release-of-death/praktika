<?php
require_once '../core/init.php'; 

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $itemId = (int)$_POST['item_id'];
        $quantity = (int)$_POST['quantity']; 

        $basket = new Basket();
        $basket->init();

        $basket->add($itemId, $quantity);

        echo 'Added product to checkout';
    } else {
        throw new Exception('Wrong requesting method.');
    }
} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}
