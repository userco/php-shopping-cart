<?php
require '../src/classes/validators/LoginValidator.php';
require '../src/classes/database/User.php';
require '../src/libs/helper.php';

$loginError = '';
if (isset($_POST['submit'])) {
	$validator = new LoginValidator($_POST);
	$errors = $validator->validateForm();
	if (empty($errors)) {
			$model = new User;
			$data = $_POST;
			unset($data['submit']);
			if (loginCheck($data, $model)) {
				if (!session_id()) {
					session_start();
					$_SESSION['cart'] = [];
					$_SESSION['user'] = $model->getBy($_POST, 'email');
				}
			ob_start(); 
			header('Location: booksList.php');
			ob_end_flush();
		} else {
			$loginError = 'Invalid credentials';
		}
	}
}
?>

<?php view('header', ['title' => 'Log in']) ?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<?php echo $loginError; ?>
	<label> E-Mail </label>
	<input type="email"  name="email" value="<?php echo  isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''?>">
	<div class="error"> <?php echo $errors["email"] ?? "" ?> </div>
	<label> Password </label>
	<input type="password"  name="password">
	<div class="error"> <?php echo $errors["password"] ?? "" ?> </div>

	<input type="submit" value="submit" name="submit">
	<a href="register.php">Sign up</a>
</form>
<?php view('footer') ?>