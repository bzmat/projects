<?php 

session_start();

require_once 'class.user.php';

$session = new User();

if (!$session->is_loggedin()) {
	
	header("Location: index.php");
}

 ?>