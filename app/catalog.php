<?php
require_once 'core/init.php'; 

?>

<h1>Product catalog</h1>
<p class='admin'><a href='admin'>Admin</a></p>
<p>Products in <a href='basket'>basket</a>: </p>
<table>
<tr>
    <th>Name</th>
    <th>Author</th>
    <th>Publication date</th>
    <th>Cost, rub.</th>
    <th>Add to checkout</th>
</tr>

<?php
try {
    $booksIterator = Eshop::getItemsFromCatalog();

    foreach ($booksIterator as $book) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($book->getTitle()) . "</td>";
        echo "<td>" . htmlspecialchars($book->getAuthor()) . "</td>";
        echo "<td>" . htmlspecialchars($book->getPubyear()) . "</td>";
        echo "<td>" . htmlspecialchars(number_format($book->getPrice(), 2, '.', ' ')) . " rub.</td>";
        echo "<td><button onclick=\"addToBasket('" . htmlspecialchars($book->getTitle()) . "')\">Add to checkout</button></td>"; 
        echo "</tr>";
    }
} catch (Exception $e) {
    echo "<tr><td colspan='5'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>

</table>
