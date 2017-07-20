<?php 

session_start();

if (isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] = TRUE)) {

	header("Location: gra.php");
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

    <script src='https://www.google.com/recaptcha/api.js'></script>

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

		<div class="row">

			<div class="col-md-3 col-md-offset-2 ">
				<h3>Logowanie</h3><br>
    			<form action="login.php" method="post" class="form-group">
	
					<label for="login">Login:</label>
					<input type="text" class="form-control" name="login"><br>
	
					<label for="login">Hasło:</label>
					<input type="password" class="form-control" name="pass"><br>
	
					<input type="submit" value="Zaloguj" class="btn btn-success">
	
	
				</form>	
	
				<?php 
	
					if (isset($_SESSION['blad'])) 
						echo $_SESSION['blad'];
					
				 ?>
    		</div>
    		<div class="col-md-3 col-md-offset-2">
				<h3>Darmowa rejestracja</h3><br>
    			<form action="registration.php" method="post" class="form-group">

    				<?php 
    					//wyświtlanie komunikatu o błednach w podanym nicku
    					if (isset($_SESSION['e_nick']))
    						echo $_SESSION['e_nick'];
    					
    				 ?>
	
					<label for="nickname">Nickname:</label>
					<input type="text" class="form-control" name="nickname"><br>

					<?php 
						//wyświetlanie komunikatu o błędzie email
						if (isset($_SESSION['e_email']))
    						echo $_SESSION['e_email'];

    				?>
	
					<label for="email">Email:</label>
					<input type="text" class="form-control" name="email"><br>

					<?php 
						//wyświetlanie komunikatu o błędzie hasła
						if (isset($_SESSION['e_pass']))
    						echo $_SESSION['e_pass'];
					 ?>

					<label for="pass">Hasło:</label>
					<input type="password" class="form-control" name="pass1"><br>
					
					<label for="pass">Powtórz hasło:</label>
					<input type="password" class="form-control" name="pass2"><br>
					
					

					<label class="checkbox-inline">
						<input type="checkbox" name="reg" id="">Akceptuję regulamin
					</label><br><br>

					<?php 
						//wyświetlanie komunikatu o akceptacji regulaminu
						if (isset($_SESSION['e_reg']))
    						echo $_SESSION['e_reg'];
					 ?>

					
					<div class="g-recaptcha" data-sitekey="6LeSWRQUAAAAABxhPAnIRty36fE-fm6cEk2KfUHg"></div><br>
				
					<?php 
						//wyświetlanie komunikatu o akceptacji regulaminu
						if (isset($_SESSION['e_bot']))
    						echo $_SESSION['e_bot'];
					 ?>
					

						
					<input type="submit" value="Zarejstruj się" class="btn btn-primary">
	
	
				</form>	
    		</div>

		</div>
    		

		
    		
    	
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
<?php 

session_unset();
 ?>