<?php
session_start();
require '../src/libs/helper.php';
$model = new Book;
?>
<?php view('header', ['title' => 'Cart']) ?>
<a href="booksList.php">GO to Books List</a>
<h2>Cart</h2>
<?php 
if (!empty($_SESSION['cart']))
{
?>
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
} else {
	echo "No books in cart.";
}
foreach ($_SESSION['cart'] as $key => $value) {
	$book = $model->read($key);
?>
	<tr>
		<td>
			<?php echo $book->title ?>
		</td>
		<td>
			<?php echo $book->author ?>
		</td>
		<td>
			<?php echo $book->price ?>
		</td>
		<td>
			<a href="removeFromCart.php?id=<?php echo $book->id ?> ">Remove From Cart</a>
		</td>
	</tr>
<?php
}
if (!empty($_SESSION['cart']))
{
?>
</table>
<a href="buy.php"><h3>Buy</h3></a>
<?php 
}
view('footer') 
?>