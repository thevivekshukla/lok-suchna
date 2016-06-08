<?php
ob_start();
session_start();
require('connection.php');

if (isset($_SESSION['aid']) && $_SESSION['aid'] !='') {

  if (isset($_SESSION['username']) && $_SESSION['username'] !='') {

    $aid = $_SESSION['aid'];
    $username = $_SESSION['username'];
  }

}

?>
