<?php
require('includes/session.php');
$page_title = 'Login - Lok Suchna';
require('includes/header.php');
if (isset($firstName) && isset($uid)) {
	header("location:index.php");

}
?>

<!--login script here onwards -->
<?php

if (isset($_POST['login'])) {

	$errors = array();
	$db = new Database();
	$dbc = $db->makeConnection();

	if (isset($_POST['email']) && !empty($_POST['email'])) {
		$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	} else {
		$errors[] = 'E-mail address cannot be empty.';
	}


	if (isset($_POST['password']) && !empty($_POST['password'])) {
		$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
	} else {
		$errors[] = 'You forgot to enter password.';
	}

//-------------------------------------------------------

	if (empty($errors)) {


		$query = "SELECT uid, firstName, password FROM users WHERE email='$email'";
		$result = mysqli_query($dbc, $query);

		if (mysqli_num_rows($result)===1) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			if(password_verify($password, $row['password'])) {
				session_regenerate_id();
				$_SESSION['uid'] = $row['uid'];
				$_SESSION['firstName'] = $row['firstName'];
				mysqli_close($dbc);
				header("location: index.php");
				exit();

			} else {
				$errors[] = 'Incorrect Password.';
			}

		} else {
			$errors[] = 'You have entered wrong email address.';
		}
	}


	if (!empty($errors)) {
		echo '<div class="alert alert-danger">';
		echo '<ul>';
		foreach($errors as $msg) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ul>';
		echo '</div>';
	}


	mysqli_close($dbc);



}


?>
<!--End of php script-->

<div style="margin: 2% 37% 5% 33%">
<div class="row">
<div class="well">
<fieldset>
<legend>Login</legend>
<form action="login.php" method="POST" role="form">
	<div class="form-group">

	<label for="email">E-mail Address:</label></strong>
	<input type="text" class="form-control" id="email" name="email" value="<?php if(isset($email))
	echo $email; ?>">
	</div>
	
	<div class="form-group">
	<label for="password">Password: </label>
	<input type="password" class="form-control" id="password" name="password">
	</div>
	
	<input type="submit" class="btn btn-primary btn-lg" name="login" value="Login"/>

</form>
</fieldset>
</div>
</div>
</div>

<?php
include('includes/footer.php');
?>