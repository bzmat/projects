<?php 

session_start();

if (!isset($_SESSION['logged_in'])) {
  header("Location: index.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Strona startowa</title>

    <!-- Bootstrap -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

   <link rel="stylesheet" href="css/main.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
    	<blockquote>
    		<p>Dopóki na świecie będzie istniał człowiek, będą też wojny.</p>
    		<small>Albert Einstein</small>
    	</blockquote>

          <div class="col-md-6 col-md-offset-2">
            
            <?php 

            echo "<h4>";
            echo "<p>Witaj ".$_SESSION['user']."!</p>";
            echo "<p><b>Email: </b>".$_SESSION['email']."</p>";
            echo "<p><b>Drewno: </b>".$_SESSION['drewno']." | <b>Zboże: </b>".$_SESSION['zboze']."</p>";
            
             $datetime = new DateTime();

           
            $end_premium = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['dnipremium']);


            $diff = $datetime->diff($end_premium);

            if($datetime < $end_premium){
              echo "Pozostało premium ".$diff->format('%d dni, %h godz, %i min, %s sek');
            }else{

              echo "Premium nieaktywne od ".$diff->format('%d dni, %h godz, %i min, %s sek');
            }
           
            echo "</h4>";

            echo "<a class='btn btn-success' href='logout.php'>Wyloguj się</a><br>";

           

             ?>

          </div> 
    	
    	</div>

		
    		
    	
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>