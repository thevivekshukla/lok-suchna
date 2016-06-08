<?php
require('includes/admin-session.php');
if (!isset($username) || !isset($aid)) {
	header('location: index.php');
}
$page_title = 'Admin - Home';
require('includes/admin-header.inc.php');
?>

<div class="wrapper">

<div class="row">

<div class="col-lg-6 col-md-6 col-sm-12 col-xm-12">
<div class="panel panel-danger">
<div class="panel-heading">Unapproved posts</div>
<div class="panel-body">

<p>There are total <?php echo $unapproved_posts; ?> unapproved posts are available.</p>
<p style="float:right"><a class="btn btn-primary" href="unapproved-posts.php" role="button">View</a></p>

</div>
</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 col-xm-12">
<div class="panel panel-info">
<div class="panel-heading">Approved posts</div>
<div class="panel-body">

<p>There are total <?php echo $approved_posts; ?> approved posts are available.</p>
<p style="float:right"><a class="btn btn-primary" href="approved-posts.php" role="button">View</a></p>


</div>
</div>
</div>

</div>




<div class="row">

<div class="col-lg-6 col-md-6 col-sm-12 col-xm-12">
<div class="panel panel-success">
<div class="panel-heading">Registered Users</div>
<div class="panel-body">

<p>There are total <?php echo $users_count; ?> users are registered.</p>



</div>
</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 col-xm-12">
<div class="panel panel-primary">
<div class="panel-heading">Add new admin</div>
<div class="panel-body">

<p>Would you like to add new admin.</p>
<p style="float:right"><a class="btn btn-primary" href="admin-new.php" role="button">Add Admin</a></p>


</div>
</div>
</div>

</div>

</div>