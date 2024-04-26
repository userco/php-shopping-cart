<?php
session_start();
require '../src/classes/database/OrderDetail.php';
require '../src/classes/database/Order.php';
require '../src/libs/helper.php';

if (isset($_POST['submit'])) {
	$model = new OrderDetail;
	$data = $_POST;
	unset($data['submit']);
	$orderDetail = $model->insert($data);
	insertOrders($orderDetail);
	unset($_SESSION['cart']);
	ob_start(); 
	header('Location: index.php');
	ob_end_flush();
} 
?>

<?php view('header', ['title' => 'Buy']) ?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<?php $totalPrice = getTotalPrice();?>
	<label> Total Price: <?php echo $totalPrice?> </label>
	<input type="hidden"  name="total_price" value="<?php echo $totalPrice?>">
	<label> Address </label>
	<input type="text"  name="address" required>
	<input type="hidden" name="status" value="New"> 

	<input type="submit" value="submit" name="submit">
</form>
<?php view('footer') ?>