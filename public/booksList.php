<?php
session_start();
require_once '../src/libs/helper.php';

$model = new Book;
$books = $model->readAll();
?>

<?php view('header', ['title' => 'Book List']) ?>

<a href="cart.php">Cart</a>

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

<?php view('footer')?>