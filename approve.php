<?php
require('includes/admin-session.php');
if (!isset($username) || !isset($aid)) {
	header('location: index.php');
}


$db = new Database();
$dbc = $db->makeConnection();

$pid = mysqli_real_escape_string($dbc, trim($_GET['pid']));

$query = "INSERT posts SELECT * FROM temp_posts WHERE pid='$pid' LIMIT 1";
$result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));

if ($result) {
	$query = "DELETE FROM temp_posts WHERE pid='$pid' LIMIT 1";
	$result = mysqli_query($dbc, $query);

	if ($result) {
		header('location: unapproved-posts.php?success=true');
	} else {
		header('location: unapproved-posts.php?error=true');
	}
} else {
	header('location: unapproved-posts.php?success=false');
}

