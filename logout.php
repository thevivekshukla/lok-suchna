<?php
require('includes/session.php');
$_SESSION = array();
session_destroy();  
setcookie ('PHPSESSID', '', time( )-3600, '/', '', 0, 0); 
ob_end_flush();
header("Location:index.php");

?>