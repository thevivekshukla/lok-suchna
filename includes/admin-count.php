<?php

$db = new Database();
$dbc = $db -> makeConnection();

//counting unapproved loo
$query = "SELECT COUNT(pid) FROM temp_posts";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = $row['COUNT(pid)'];

$unapproved_posts = $count;

//counting approved loo
$query = "SELECT COUNT(pid) FROM posts";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = $row['COUNT(pid)'];

$approved_posts = $count;


//counting users
$query = "SELECT COUNT(uid) FROM users";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_assoc($result);

$count = $row['COUNT(uid)'];

$users_count = $count;

mysqli_close($dbc);
