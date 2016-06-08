<?php

require('includes/admin-session.php');
if (!isset($username) || !isset($aid)) {
	header('location: index.php');
}
$page_title = 'Admin - Unapproved Posts';

if (isset($_GET['page']))
	$page = $_GET['page'];
else
	$page = 0;


if($page=="" || $page=="1")
	$page = 0;
else
	$page = ($page * 10) - 10;


require('includes/admin-header.inc.php');

//showing message

if (isset($_GET['success'])) {
	if ($_GET['success'] == 'true') {
		echo '<div class="alert alert-success">';
		echo '<p>Post has been successfully approved.</p>';
		echo '</div>';
	} else if ($_GET['success'] == 'false') {
		echo '<div class="alert alert-warning">';
		echo '<p>Operation failed.</p>';
		echo '</div>';
	}
}


if (isset($_GET['error'])) {
	if ($_GET['error'] == 'true') {
		echo '<div class="alert alert-danger">';
		echo '<p>Error has occured while updating database.</p>';
		echo '</div>';
	}
	
}


if (isset($_GET['delete'])) {
	if ($_GET['delete'] == true) {
		echo '<div class="alert alert-success">';
		echo '<p>Post has been successfully deleted.</p>';
		echo '</div>';
	} else if ($_GET['delete'] == false) {
		echo '<div class="alert alert-warning">';
		echo '<p>Operation failed.</p>';
		echo '</div>';
	}
}

//Showing Unapproved posts below.


$db = new Database();
$dbc = $db->makeConnection();

$query = "SELECT * FROM temp_posts ORDER BY upload_date DESC LIMIT $page, 10";
$result = mysqli_query($dbc, $query);

if ($result) {

	echo '<div class="wrapper">';
	echo '<table class="table table-striped table-responsive" align="center" cellspacing="3" cellpaddig="3" width="75%">';
	echo '<tr class="info"><td align="left"><b>ID</b></td>';
	echo '<td align="left"><b>Title</b></td>';
	echo '<td align="left"><b>Description</b></td>';
	echo '<td align="left"><b>City</b></td>';
	echo '<td align="left"><b>View image</b></td>';
	echo '<td align="left"><b>Approve</b></td>';
	echo '<td align="left"><b>Delete</b></td></tr>';


	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

		echo '<tr>';
		echo '<td>'.$row['pid'].'</td>';
		echo '<td>'.$row['title'].'</td>';
		echo '<td>'.$row['description'].'</td>';
		echo '<td>'.$row['city'].'</td>';
		//echo '<td><a class="btn btn-default" href="view.php?lat='.$row['lat'].'&amp;lng='.$row['lng'].'" //role="button">View</a></td>';
		echo '<td><a class="btn btn-default fancybox" href="'.UPLOADPATH.$row['image_name'].'" role="button">View</a></td>';
		echo '<td><a class="btn btn-primary" href="approve.php?pid='.$row['pid'].'" role="button">Approve</a></td>';
		//echo '<td><a class="btn btn-danger" href="delete.php?lid='.$row['lid'].'" role="button">Delete</a></td></tr>';
	   echo '<td><a class="btn btn-danger" onclick="cnfrm('.$row['pid'].')" role="button">Delete</a></td></tr>';
	}
	echo '</table>';
	echo '</div>';
}

$uposts_count = ceil($unapproved_posts/10);

if($uposts_count != 1) {
	echo '<center>';
	echo '<nav><ul class="pagination">';
	for($i = 1;$i <= $uposts_count; $i++)
	{
		if ($i == $page)
			echo '<li class="active"><a href="unapproved-posts.php?page='.$i.'">'.$i.' </a></li>';
		else
			echo '<li><a href="unapproved-posts.php?page='.$i.'">'.$i.' </a></li>';
	}
			echo '</ul>';
			echo '</nav>';
			echo '</center>';
}

echo '<script>';
echo 'function cnfrm(x)';
 echo '{';
echo   "var r=confirm('Really want to delete this entry from database::???');";
echo "if(r==true){";
echo "var url='delete.php?pid='+x;" ;
//echo   " alert('redirecting to '+url);";
echo "window.location=url;";
echo '}';
echo '}';
echo '</script>';
require('includes/footer.php');