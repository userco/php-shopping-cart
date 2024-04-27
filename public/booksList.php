<?php
session_start();
require_once '../src/libs/helper.php';
if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else if (is_numeric($_GET['page'])){  
    $page = $_GET['page'];  
}  
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
<?php

if($page >= 2){   
    echo "<a href='bookList.php?page=".($page-1)."'>  Prev </a>";   
}       
$pagLink = '';          
for ($i = 1; $i <= $model->getTotalNumberPages(); $i++) {   
  if ($i == $page) {   
      $pagLink .= "<a class = 'active' href='bookList.php?page=".$i."'> ".$i." </a>";   
  }               
  else  {   
      $pagLink .= "<a href='bookList.php?page=".$i."'> ".$i." </a>";     
  }   
};     
echo $pagLink;   

if($page < $model->getTotalNumberPages()){   
    echo "<a href='bookList.php?page=".($page+1)."'>  Next </a>";   
}   
?>
</div>
<?php view('footer');?>