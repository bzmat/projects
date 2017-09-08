<?php 

session_start();

if (!isset($_SESSION['user'])) {

  header("Location: index.php");
  
}

include ('includes/conn.inc.php');

if (isset($_POST['save']) && $_POST['list'] !== '') {
  
  $list = $_POST['list'];

  $query = "INSERT INTO list (`user_id`, `text`) VALUES (?, ?)";

  $stmt = $conn-> prepare($query);

  $stmt->execute(array($_SESSION['user'], $list));

  
}


if (isset($_GET['del'])) {

  $id = $_GET['del'];

  $query = "DELETE FROM list WHERE id=?";

  $stmt = $conn->prepare($query);

  $stmt->execute([$id]);

  header("Location: myaccount.php");
  
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

                  <a href="logout.php" name="logout" class="btn btn-primary">Wyloguj się</a>       
         
            
            <form action="" method="POST" class="form-signin">
              <h1 class="form-signin-heading"><?php echo "Witaj ".$_SESSION['user_name']; ?></h1>
              <h2 class="form-signin-heading">Oto twój plan:</h2>
              <input type="text" class="form-control" name="list" autofocus=""><br>
              <input type="submit" value="Zapisz" class="btn btn-success btn-block" name="save">
            </form><br>

            

            <?php 

                if (isset($_SESSION['user'])) {

                  $query = "SELECT * FROM list WHERE user_id = ?";

                  $stmt = $conn->prepare($query);

                  $stmt->execute(array($_SESSION['user']));

                  while ($row = $stmt->fetch()) {

             
                 echo ' <div class="col-md-4 col-md-offset-4">
                  <table class="table">  
                  <tr>
                    <td>
                      
                      '.$row['text'].'
                      
                    </td>
                    <td><a href="myaccount.php?del='.$row["id"].'" class="btn btn-primary">Usuń</a></td>
                  </tr>
                  
                </table>
                </div>';
                  
                }
                }

              
                
                 ?>

            
            

       

     
        

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>
