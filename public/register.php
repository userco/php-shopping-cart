<?php
require '../src/classes/validators/UserValidator.php';
require '../src/classes/database/User.php';

$errors = [];
if (isset($_POST['submit'])) {
		$validator = new UserValidator($_POST);
		$errors = $validator->validateForm();
		if (empty($errors)) {
		$model = new User;
		$data = $_POST;
		unset($data['submit']);
		unset($data['password_confirm']);
		$user = $model->insert($data);
		ob_start(); 
		header('Location: index.php');
		ob_end_flush();
	}
}
?>

<?php view('header', ['title' => 'Register']) ?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<label> Name </label>
	<input type="text"  name="name" value="<?php echo  isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''?>">
	<div class="error"> <?php echo $errors["name"] ?? "" ?> </div>
	<label> E-Mail </label>
	<input type="email"  name="email" value="<?php echo  isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''?>">
	<div class="error"> <?php echo $errors["email"] ?? "" ?> </div>
	<label> Password </label>
	<input type="password"  name="password">
	<div class="error"> <?php echo $errors["password"] ?? "" ?> </div>
	<label> Password confirm</label>
	<input type="password"  name="password_confirm">
	<input type="submit" value="submit" name="submit">
</form>

<?php view('footer') ?>