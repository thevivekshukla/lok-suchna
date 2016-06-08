<?php
ob_start();
session_start();
require('connection.php');

if (isset($_SESSION['uid']) && $_SESSION['uid'] !='') {

  if (isset($_SESSION['firstName']) && $_SESSION['firstName'] !='') {

    $uid = $_SESSION['uid'];
    $firstName = $_SESSION['firstName'];
  }

}

?>
