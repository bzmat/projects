<?php 
  
  session_start();

  
  
  include("includes/conn.inc.php");
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

    <title>To do list </title>

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

        <div class="row">
            <div class="col-md-6 col-lg-offset-4">
                <h2>
                Witaj w liście zadań.
            </h2>
            </div>
            
        </div>

    <div class="col-md-6">
        <form class="form-signin" method="POST" action="login.php">
        <h2 class="form-signin-heading">Logowanie</h2>
        <label for="inputuid" class="sr-only">Login</label>
        <input type="text" id="inputuid" name="uid" class="form-control" placeholder="Login " required autofocus maxlength="30"
        minlength="3">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required maxlength="30" minlength="8">
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Log in</button><br>
        <?php 

            if (isset($_SESSION['error_log'])) {

                echo'<div class="alert alert-danger">'.$_SESSION["error_log"].'</div>';               
                
            }

         ?>
      </form>
    </div>

      
    <div class="col-md-6">
        <form class="form-signin" method="POST" action="register.php">
        <h2 class="form-signin-heading">Rejestracja</h2>
        <label for="inputuid" class="sr-only">Login</label>
        <input type="text" id="inputuid" name="uid" class="form-control" placeholder="Login " required autofocus maxlength="30"
        minlength="3">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required maxlength="50">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required maxlength="30" minlength="8">
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Sign in</button><br>
        <?php 

            if (isset($_SESSION['error_reg'])) {

                echo'<div class="alert alert-danger">'.$_SESSION["error_reg"].'</div>';               
                
            }

         ?>
      </form>
    </div>
   

      

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>
<?php 
session_unset();
 ?>