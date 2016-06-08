<?php

require('includes/admin-session.php');
if (isset($username) && isset($aid)) {
	header('Location: admin-index.php');
}


$page_title = 'Admin Login';
require('includes/header.php');
?>

<!--login script here onwards -->
<?php

if (isset($_POST['login'])) {

	$errors = array();
	$db = new Database();
	$dbc = $db->makeConnection();

	if (isset($_POST['username']) && !empty($_POST['username'])) {
		$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
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


		$query = "SELECT aid, password FROM admin WHERE username='$username'";
		$result = mysqli_query($dbc, $query);

		if (mysqli_num_rows($result)===1) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			if(password_verify($password, $row['password'])) {
				session_regenerate_id();
				$_SESSION['aid'] = $row['aid'];
				$_SESSION['username'] = $username;
				mysqli_close($dbc);
				header("location: admin-index.php");
				exit();

			} else {
				$errors[] = 'Incorrect Password.';
			}

		} else {
			$errors[] = 'You have entered wrong username.';
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
<legend>Admin Login</legend>
<form action="admin-login.php" method="POST" role="form">
	<div class="form-group">

	<label for="username">Username:</label></strong>
	<input type="text" class="form-control" id="username" name="username" value="<?php if(isset($username))
	echo $username; ?>" autofocus>
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