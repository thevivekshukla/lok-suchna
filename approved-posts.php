<?php

require('includes/admin-session.php');
if (!isset($username) || !isset($aid)) {
	header('location: index.php');
}
$page_title = 'Admin - Approved Posts';

if (isset($_GET['page']))
	$page = $_GET['page'];
else
	$page = 0;


if($page=="" || $page=="1")
	$page = 0;
else
	$page = ($page * 10) - 10;


require('includes/admin-header.inc.php');



//Showing approved posts below.


$db = new Database();
$dbc = $db->makeConnection();

$query = "SELECT * FROM posts ORDER BY upload_date DESC LIMIT $page, 10";
$result = mysqli_query($dbc, $query);

if ($result) {

	echo '<div class="wrapper">';
	echo '<table class="table table-striped table-responsive" align="center" cellspacing="3" cellpaddig="3" width="75%">';
	echo '<tr class="info"><td align="left"><b>ID</b></td>';
	echo '<td align="left"><b>Title</b></td>';
	echo '<td align="left"><b>Description</b></td>';
	echo '<td align="left"><b>City</b></td>';
	echo '<td align="left"><b>View image</b></td>';


	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

		echo '<tr>';
		echo '<td>'.$row['pid'].'</td>';
		echo '<td>'.$row['title'].'</td>';
		echo '<td>'.$row['description'].'</td>';
		echo '<td>'.$row['city'].'</td>';
		echo '<td><a class="btn btn-default fancybox" href="'.UPLOADPATH.$row['image_name'].'" role="button">View</a></td>';
		
	}
	echo '</table>';
	echo '</div>';
}

$posts_count = ceil($approved_posts/10);

if($posts_count != 1) {
	echo '<center>';
	echo '<nav><ul class="pagination">';
	for($i = 1;$i <= $posts_count; $i++)
	{
		if ($i === $page)
			echo '<li class="active"><a href="approved-posts.php?page='.$i.'">'.$i.' </a></li>';
		else
			echo '<li><a href="approved-posts.php?page='.$i.'">'.$i.' </a></li>';
		
	}
			echo '</ul>';
			echo '</nav>';
			echo '</center>';
}

require('includes/footer.php');