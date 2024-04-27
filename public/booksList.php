<?php
session_start();
require_once '../src/libs/helper.php';
require_once '../src/inc/getPage.php';

$model = new Book;
$books = $model->readAll($page);
?>

<?php view('header', ['title' => 'Book List']) ?>

<h2> Books list </h2>

<a href="cart.php" class="button">Go to Cart</a>
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
			<a href="addToCart.php?id=<?php echo $book['id'] ?> " class="button">Add to Cart</a>
		</td>
	</tr>
<?php
}
?>
</table>

<div class="pagination">
<?php view('pagination', ['file' => 'booksList.php', 'model' => $model, 'page' => $page]);?>
</div>
<?php view('footer');?>