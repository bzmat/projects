<?php 


require_once 'session.php';

require_once 'class.user.php';

$user_logout = new User();


if ($_GET['logout'] == true){

	$user_logout->doLogout();
	header("Location: index.php");

}
	

	

	


	
	





 ?>