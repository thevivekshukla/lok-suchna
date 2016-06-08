<?php
require('includes/admin-session.php');
if (!isset($username) || !isset($aid)) {
	header('location: index.php');
}


$db = new Database();
$dbc = $db->makeConnection();

$pid = mysqli_real_escape_string($dbc, trim($_GET['pid']));

$query = "DELETE FROM temp_posts WHERE pid='$pid' LIMIT 1";
$result = mysqli_query($dbc, $query);

if ($result) {
	mysqli_close($dbc);
	header('location: unapproved-posts.php?delete=true');
	} else {
		header('location: unapproved-posts.php?delete=false');
}
