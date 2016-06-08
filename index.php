<?php
require('includes/session.php');
$page_title = 'Home - Lok Suchna';
require('includes/header.php');

$db = new Database();
$dbc = $db->makeConnection();

if (isset($_GET['page']) && is_numeric($_GET['page']))
	$page = mysqli_real_escape_string($dbc, trim($_GET['page']));
else
	$page = 0;


if($page=="" || $page=="1")
	$page = 0;
else
	$page = ($page * 9) - 9;
?>



<div class="page-header"><h1>Lok Suchna<small> be updated</small></h1> </div>

<?php



$query = "SELECT * FROM posts ORDER BY upload_date DESC LIMIT $page, 9";
$result = mysqli_query($dbc, $query) or die (mysqli_error($dbc));

echo '<div class="row">';

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	$title = $row['title'];
	$city = $row['city'];
	$upload_date = $row['upload_date'];
	$image = $row['image_name'];
	$description = $row['description'];


	echo '<div class="col-sm-4 portfolio-item">';
    echo '<br><a class="fancybox" rel="group" href="'.UPLOADPATH.$image.'" title="Title: '.$title.'<br>Description: '.$description.'<br>Date: '.$upload_date.'"><img src="'.UPLOADPATH.$image.'" height="250" width="350" alt="'.$title.'"></a>';
    echo '</div>';

}

$query = "SELECT COUNT(pid) FROM temp_posts";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$posts_count = $row['COUNT(pid)'];
$posts_count = ceil($posts_count/9);


if($posts_count != 1) {
	echo '<center>';
	echo '<nav><ul class="pagination">';
	for($i = 1;$i <= $posts_count; $i++)
	{
		if ($i == $page)
			echo '<li class="active"><a href="index.php?page='.$i.'">'.$i.' </a></li>';
		else
			echo '<li><a href="index.php?page='.$i.'">'.$i.' </a></li>';
	}
			echo '</ul>';
			echo '</nav>';
			echo '</center>';
}

?>












<?php

require('includes/footer.php');