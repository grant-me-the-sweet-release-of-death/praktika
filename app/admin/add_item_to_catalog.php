<?php
require_once '../core/init.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = Cleaner::str($_POST['title']);
        $author = Cleaner::str($_POST['author']);
        $pubyear = Cleaner::uint($_POST['pubyear']);
        $price = Cleaner::float($_POST['price']); 

        $book = new Book($title, $author, $pubyear, $price);

        Eshop::addItemToCatalog($book);

        header('Location: /admin/add_item_to_catalog');
        exit();
    }
} catch (Exception $e) {
    echo "<h1>Error</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

<h1>Add a product to catalog</h1>
<p><a href='/admin'>Back to Admin console</a></p>    
<form action="save_item_to_catalog" method="post">
    <div>
        <label>Name:</label> 
        <input type="text" name="title" size="50" required>
    </div>
    <div>
        <label>Author:</label>
        <input type="text" name="author" size="50" required>
    </div>
    <div>
        <label>Publication date:</label> 
        <input type="text" name="pubyear" size="50" maxlength="4" required>
    </div>
    <div>
        <label>Price (rub.):</label> 
        <input type="text" name="price" size="50" maxlength="6" required>
    </div>
    <div>
        <input type="submit" value="add">
    </div>
</form>
