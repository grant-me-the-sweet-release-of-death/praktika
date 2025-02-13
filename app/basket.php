<?php
require_once 'core/init.php'; 

$items = Eshop::getItemsFromBasket();
$totalPrice = 0; 
?>

<p>Go back to <a href='/catalog'>catalog</a></p>
<h1>Checkout</h1>
<table>
<tr>
	<th>N п/п</th>
	<th>Name</th>
	<th>Author</th>
	<th>Publishment date</th>
	<th>Cost, rub.</th>
	<th>Quantity</th>
	<th>Delete</th>
</tr>

<?php
if (!empty($items)) {
    foreach ($items as $itemId => $quantity) {
        $book = Eshop::getBookById($itemId);

        if ($book) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($itemId) . "</td>";
            echo "<td>" . htmlspecialchars($book->getTitle()) . "</td>";
            echo "<td>" . htmlspecialchars($book->getAuthor()) . "</td>";
            echo "<td>" . htmlspecialchars($book->getPubyear()) . "</td>";
            echo "<td>" . htmlspecialchars(number_format($book->getPrice(), 2, '.', ' ')) . " rub.</td>";
            echo "<td>" . htmlspecialchars($quantity) . "</td>";
            echo "<td><button onclick=\"removeFromBasket('" . htmlspecialchars($itemId) . "')\">Delete</button></td>"; 
            echo "</tr>";

            $totalPrice += $book->getPrice() * $quantity;
        }
    }
} else {
    echo "<tr><td colspan='7'>Nothing in checkout.</td></tr>";
}
?>

</table>

<p>Cost of placed orders: <?php echo htmlspecialchars(number_format($totalPrice, 2, '.', ' ')); ?> rub.</p>

<div style="text-align:center">
	<input type="button" value="Place order" onclick="location.href='/create_order'" />
</div>

<script>
function removeFromBasket(itemId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/remove_item_from_basket", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            location.reload(); 
        }
    };
    xhr.send("item_id=" + encodeURIComponent(itemId));
}
</script>
