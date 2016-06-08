<?php
require('includes/session.php');
$page_title = 'Signup - Lok Suchna';
require('includes/header.php');
if (isset($firstName) && isset($uid)) {
	header("location:index.php");
}
?>

<!--Taking data and inserting into database -->

<?php

if (isset($_POST['signup'])) {

	$errors = array();
	$db = new Database();
	$dbc = $db->makeConnection();

	if (isset($_POST['firstName']) && !empty($_POST['firstName'])) {
		$firstName = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
	} else {
		$errors[] = 'You forgot to enter first name.';
	}


	if (isset($_POST['lastName']) && !empty($_POST['lastName'])) {
		$lastName = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
	} else {
		$errors[] = 'You forgot to enter last name.';
	}

	if (isset($_POST['gender']) && !empty($_POST['gender'])) {
		$gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
	} else {
		$errors[] = 'You forgot to select gender.';
	}



	if (isset($_POST['email']) && !empty($_POST['email'])) {
		$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	} else {
		$errors[] = 'You forgot to enter email address.';
	}


	if (isset($_POST['password']) && !empty($_POST['password'])) {
		if($_POST['password'] === $_POST['c_password']) {
			$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		} else {
			$errors[] = 'Password does not match.';
		}
	} else {
		$errors[] = 'You forgot to enter password.';
	}


	$query = "SELECT uid FROM users WHERE email='$email'";
	$result = mysqli_query($dbc, $query);
	if (mysqli_num_rows($result)>0) {
		$errors[] = 'Sorry, email is already registered. Please choose different one.';
	}

//--------------------------------------------------------


	if (empty($errors)) {

		$hashed_password = password_hash($password, PASSWORD_BCRYPT, array(
			'cost' => 10
			));

		$query = "INSERT INTO users (uid, firstName, lastName, gender, email, password, registration_date) VALUES";
		$query .= " (0, '$firstName', '$lastName', '$gender', '$email', '$hashed_password', NOW())";

		$result = mysqli_query($dbc, $query);

		if ($result) {
			
			$firstName = '';
			$lastName = '';
			$email = '';
			$gender = '';
			$dob = '';

			echo '<div class="alert alert-success">';
			echo '<p>You are successfully registered.';
			echo 'You can login <a href="login.php" class="alert-lin">here</a></p>';
			echo '</div>';
			
		} else {
			echo '<div class="alert alert-warning">';
			echo '<p>Sorry some error has occured.';
			echo 'You should try again.</p></div>';
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

	
}//end of if- signup

?>
<!--End of php script-->


<div style="margin: 5% 60% 10% 5%">
<div class="row">

<div class="well">
<fieldset>
<legend>Signup</legend>
<form role="form" action="signup.php" method="POST">
	<div class="form-group">
	<label for="firstName">First Name: </label>
	<input type="text" class="form-control" id="firstName"  required name="firstName" pattern="^[a-zA-Z]+$" placeholder="First Name"
	value="<?php if(isset($firstName)) echo $firstName; ?>" autofocus>
	</div>
	
	<div class="form-group">
	<label for="lastName">Last Name: </label>
	<input type="text" class="form-control" id="lastName"  required name="lastName" pattern="^[a-zA-Z]+$" placeholder="Last Name"
	value="<?php if(isset($lastName)) echo $lastName; ?>">
	</div>

	<div class="form-group">
	<label for="gender">Gender</label>
	<input type="radio" id="gender" name="gender" value="Male" <?php if(isset($gender) && $gender == 'Male') echo 'checked'; ?>/> Male
	<input type="radio" id="gender" name="gender" value="Female" <?php if(isset($gender) && $gender == 'Female') echo 'checked'; ?>/> Female
	</div>


	<div class="form-group">
	<label for="email">E-mail address: </label>
	<input type="email" class="form-control" id="email" name="email"  required  placeholder="E-mail address"
	value="<?php if(isset($email)) echo $email; ?>">
	</div>

	<div class="form-group">
	<label for="password">Password: </label>
	<input type="password" class="form-control" id="password"  title="Must contain at least 6 characters,including uppercase/lowercase and numbers" required  pattern="(?=.*\d)(?=.*[a-zA-Z]).{6,}" name="password" placeholder="Password of at least 6 characters and numbers">
	</div>

	<div class="form-group">
	<label for="c_password">Confirm Password: </label>
	<input type="password" class="form-control" id="c_password"  title="Must contain at least 6 characters,including uppercase/lowercase and numbers" required pattern="(?=.*\d)(?=.*[a-zA-Z]).{6,}" name="c_password" placeholder="Re-enter Password">
	</div>

	
	<input type="submit" class="btn btn-primary btn-lg" name="signup" value="Signup"/>

</form>
</fieldset>
</div>
</div>
</div>



<?php
include('includes/footer.php');
?>