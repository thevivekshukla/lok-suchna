<?php
require('includes/session.php');

$page_title = 'Upload News';
require('includes/header.php');
?>

<?php


if (isset($_POST['upload'])) {

	$errors = array();
	$db = new Database();
	$dbc = $db->makeConnection();

	if (isset($_POST['title']) && !empty($_POST['title'])) {
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
	} else {
		$errors[] = 'You forgot to enter title.';
	}


	if (isset($_POST['description']) && !empty($_POST['description'])) {
		$description = mysqli_real_escape_string($dbc, trim($_POST['description']));
	} else {
		$errors[] = 'You forgot to add description.';
	}

	if (isset($_POST['city']) && !empty($_POST['city'])) {
		$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
	} else {
		$errors[] = 'You forgot to select city.';
	}

	$image_name = mysqli_real_escape_string($dbc, trim(time().$_FILES['image']['name']));
	$image_type = $_FILES['image']['type'];
	$image_size = $_FILES['image']['size'];


	if ($image_type == 'image/jpeg' || $image_type == 'image/png' || $image_type == 'image/gif') {
		
	} else {
		$errors[] = 'Please select only JPEG , PNG or GIF file type.';
	}
	
	
	if ($image_size<0) {
		$errors[] = 'Selected image does not has valid size.';
	}

	if ($image_size > MAX_SIZE) {
		$errors[] = 'Please select image upto 1 MB in size.';
	}

		$target = UPLOADPATH.$image_name;

		if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$errors[] = 'Sorry, some error has occured.';
		}

	

//--------------------------------------------------------


	if (empty($errors)) {


		$query = "INSERT INTO temp_posts (pid, uid, image_name, title, description, city, upload_date) VALUES";
		$query .= " (0, '$uid', '$image_name', '$title', '$description', '$city', NOW())";

		$result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));

		if ($result) {
			
			$title = '';
			$description = '';
			$city = '';
			$image = '';

			echo '<div class="alert alert-success">';
			echo '<p>Your image has been successfully uploaded for approval.</p>';
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

	
}//end of if- upload

?>
<!--End of php script-->


<div style="float:left; width:30%; margin-left:5%"
<div class="row">
<fieldset>
<legend>Upload News</legend>
<form action="" method="POST" enctype="multipart/form-data">


<div class="form-group">
<label for="title">Title: </label>
<input type="text" class="form-control" name="title" value="<?php if(isset($title)) echo $title; ?>" placeholder="Title">
</div>

<br/>
<div class="form-group">

<label for="city">City: </label>
<select id="city" name="city" class="form-control">
	<option value="raipur">Raipur</option>
	<option value="bilaspur">Bilaspur</option>
	<option value="bhilai">Bhilai</option>
	<option value="rajnandgaon">Rajnandgaon</option>
</select>
</div>

<div class="form-group">
<label for="description">Description: </label>
<textarea rows="10" cols="8" placeholder="maximum 500 letters" class="form-control" name="description"><?php if(isset($description)) echo $description; ?></textarea>
</div>

<div class="form-group">
<label for="image">Select image: </label>
<input type="file" name="image" id="image">
</div>

<div class="form-group">
<input type="submit" name="upload" value="Upload" class="btn btn-primary" style="float:right;">
</div>

</form>
</fieldset>
</div>
</div>

<?php
require('includes/footer.php');
?>