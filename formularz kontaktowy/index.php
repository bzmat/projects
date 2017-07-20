<?php 
  session_start();
 ?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>formularz kontaktowy</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
       <div class="col-md-4">
          <h1>Formularz kontaktowy</h1>
            <form action="validate.php" method="POST">
              <div class="form-group">
                <label for="name">Imię</label>
                <input type="text" name="name" id="name" class="form-control" maxlength="20" placeholder="max 20 znaków">
              </div>
              <?php 
                  if (isset($_SESSION['no_name'])){
                  
                  echo $_SESSION['no_name'];
                }
               ?>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" maxlength="60" placeholder="max 60 znaków">
              </div>
              <?php 
                if (isset($_SESSION['bad_email'])){
                  
                  echo $_SESSION['bad_email'];
                }

                 if (isset($_SESSION['no_email'])){
                  
                  echo $_SESSION['no_email'];
                }

               ?>
              <label for="textarea">Treść wiadomości</label>
              <textarea name="contents" id="contents" class="form-control" maxlength="200" placeholder="max 200 znaków"></textarea><br>
              <?php 
                  if (isset($_SESSION['no_contents'])){
                  
                  echo $_SESSION['no_contents'];
                }

                              ?>
              <button type="submit" class="btn btn-primary">Wyślij</button><br>
              
              <p><?php 
                 if (isset($_SESSION['mail'])){
                  
                  echo $_SESSION['mail'];
                }
               ?></p>
            </form>
       </div>
          
    </div><!--end of container -->
   

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
<?php 
session_destroy();
 ?>