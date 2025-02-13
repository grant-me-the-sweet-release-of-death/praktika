<?php
require_once '../core/init.php'; 

$ordersIterator = Eshop::getOrders();

?>

<h1>Pending orders:</h1>
<a href='/admin'>Back to admin console</a>
<hr>

<?php foreach ($ordersIterator as $order): ?>
    <h2>Order number: <?php echo htmlspecialchars($order->getId()); ?></h2>
    <p><b>Client</b>: <?php echo htmlspecialchars($order->getCustomer()); ?></p>
    <p><b>Email</b>: <?php echo htmlspecialchars($order->getEmail()); ?></p>
    <p><b>Phone number</b>: <?php echo htmlspecialchars($order->getPhone()); ?></p>
    <p><b>Address</b>: <?php echo htmlspecialchars($order->getAddress()); ?></p>
    <p><b>Date of order</b>: <?php echo htmlspecialchars($order->getCreated()); ?></p>

    <h3>Ordered products:</h3>
    <table>
        <tr>
            <th>N п/п</th>
            <th>Name</th>
            <th>Author</th>
            <th>Publication date</th>
            <th>Price, rub.</th>
            <th>=Quantity</th>
        </tr>

        <?php 
        $items = $order->getItems();
        $totalPrice = 0;
        foreach ($items as $itemId => $quantity): 
            $book = Eshop::getBookById($itemId); 

            if ($book): 
                $totalPrice += $book->getPrice() * $quantity; 
        ?>
            <tr>
                <td><?php echo htmlspecialchars($itemId); ?></td>
                <td><?php echo htmlspecialchars($book->getTitle()); ?></td>
                <td><?php echo htmlspecialchars($book->getAuthor()); ?></td>
                <td><?php echo htmlspecialchars($book->getPubyear()); ?></td>
                <td><?php echo htmlspecialchars(number_format($book->getPrice(), 2, '.', ' ')); ?> rub.</td>
                <td><?php echo htmlspecialchars($quantity); ?></td>
            </tr>
        <?php endif; endforeach; ?>
    </table>

    <p>Cost of placed orders: <?php echo htmlspecialchars(number_format($totalPrice, 2, '.', ' ')); ?> rub.</p>

<?php endforeach; ?>
