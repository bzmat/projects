<?php 

session_start();

if (!isset($_SESSION['user'])) {

  header("Location: index.php");
  
}

include ('includes/conn.inc.php');

if (isset($_POST['register'])) {
	
	$uid = $_POST['uid'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password_h = password_hash($password, PASSWORD_BCRYPT);

	

	//check login in base

	$stmt = $conn->prepare("SELECT * FROM users WHERE uid=:uid");
	$stmt->bindParam(':uid', $uid);
	$stmt -> execute();

	$result = $stmt->rowCount();

		if ($result > 0) {
			
			echo "Podany login jest zajęty. Spróbuj inny";

		}else{

			$stmt = $conn->prepare("INSERT INTO users VALUES (NULL, :uid, :email, :password)");
			$stmt->bindParam(':uid', $uid);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password_h);
			$stmt->execute();

			
		}

}else{

	echo "Prosze uzupłenić formularz";
}

 ?>
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
     <link href="css/main.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <h1>Dziękujemy za rejestarcję. Z chwilę zostanie przekierowny do swojego konta.
      </h1>
		<?php 
			header("Refresh: 5; myaccount.php");
		 ?>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>
