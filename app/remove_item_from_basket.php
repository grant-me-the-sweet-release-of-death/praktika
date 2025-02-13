<?php
require_once '../core/init.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $itemId = (int)$_POST['item_id'];

        $basket = new Basket();
        $basket->init(); 

        $basket->remove($itemId);

        echo 'Delete product from customers checkout';
    } else {
        throw new Exception('Wrong requesting method.');
    }
} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}
