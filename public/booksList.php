<?php
session_start();
require_once '../src/libs/helper.php';
if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  
$model = new Book;
$books = $model->readAll($page);
?>

<?php view('header', ['title' => 'Book List']) ?>

<a href="cart.php">GO to Cart</a>
<h2> Books list </h2>
<table>
	<tr>
		<td>
			Title
		</td>
		<td>
			Author
		</td>
		<td>
			Price
		</td>
		<td>
		</td>
	</tr>
	
<?php

foreach ($books as $book) {
?>
	<tr>
		<td>
			<?php echo $book['title'] ?>
		</td>
		<td>
			<?php echo $book['author'] ?>
		</td>
		<td>
			<?php echo $book['price'] ?>
		</td>
		<td>
			<a href="addToCart.php?id=<?php echo $book['id'] ?> ">Add to Cart</a>
		</td>
	</tr>
<?php
}
?>
</table>

<?php
for($page = 1; $page <= $model->getTotalNumberPages(); $page++) {  
    echo '<a href = "bookList.php?page=' . $page . '">' . $page . ' </a>';  
}

view('footer');
?>