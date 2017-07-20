<?php 

session_start();

if (isset($_POST['email'])){
	
	//udana walidacja, wszystko ok
	$val_ok = TRUE;

	//sprawdzenie poprawności nickname
	$nick = $_POST['nickname'];

	//sprawdzenie długości nicka
	if ((strlen($nick)<3) || (strlen($nick)>20)) {
		
		$val_ok = FALSE;
		$_SESSION['e_nick'] = "<p class='alert alert-danger'>Nickname musi posiadać od 3 do 20 znaków</p>";
		header("Location: index.php");
	}

	//sprawdzenie czy znaki są alfanumeryczne
	if (ctype_alnum($nick) == FALSE) {
		
		$val_ok = FALSE;
		$_SESSION['e_nick'] = "<p class='alert alert-danger'>Nickname musi się składać tylko z liter i cyfr(bez polskich znaków)</p>";
		header("Location: index.php");
	}

	//sprawdzenie poprawności adresu email
	$email = $_POST['email'];
	$email_safe = filter_var($email, FILTER_SANITIZE_EMAIL);//sanityzacja


	//sprawdzenie poprawności email
	if ((filter_var($email_safe, FILTER_VALIDATE_EMAIL)==FALSE) || ($email_safe != $email)){
		
		$val_ok = FALSE;
		$_SESSION['e_email'] = "<p class='alert alert-danger'>Podaj poprawny adres email</p>";
		header("Location: index.php");
	}

	//sprawdzenie poprawności hasła
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];

	if ((strlen($pass1)<8) || (strlen($pass1)>20)) {

		$val_ok = FALSE;
		$_SESSION['e_pass']="<p class='alert alert-danger'>Hasło musi zawierać od 8 do 20 znaków</p>";
		header("Location: index.php");
		
	}

	//porównanie dwóch haseł
	if ($pass1 != $pass2) {
		
		$val_ok = FALSE;
		$_SESSION['e_pass']="<p class='alert alert-danger'>Podane hasła nie są identyczne</p>";
		header("Location: index.php");

	}
	//haszowania haseł
	$pass_hash = password_hash($pass1, PASSWORD_DEFAULT);

	//sprawdzenie czy regulamin został zatwierdzony
	if (!isset($_POST['reg'])) {
		
		$val_ok = FALSE;
		$_SESSION['e_reg']="<p class='alert alert-danger'>Potwierdź akcepetacje regulaminu</p>";
		header("Location: index.php");

	}

	//sprawdzenie czy to bot

	$secr = '6LeSWRQUAAAAAEulL8f6f1cXWXmJpda3iddAxJAr';

	$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secr.'&response='.$_POST['g-recaptcha-response']);

	$answer = json_decode($check);

	if ($answer->success==FALSE) {
		
		$val_ok = FALSE;
		$_SESSION['e_bot']="<p class='alert alert-danger'>Potwierdź że nie jesteś robotem</p>";
		header("Location: index.php");
	}
	
	//połączenie z bazą
	require_once('connect.php');
	mysqli_report(MYSQLI_REPORT_STRICT);

	try {

		$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);

		if ($mysqli->connect_errno !=0) {
			
			throw new Exception(mysqli_connect_errno());//błąd połaczenia
			
		}else{

			//czy email już istnieje
			$res_email = $mysqli->query("SELECT id FROM uzytkownicy WHERE email='$email'");
			if (!$res_email)throw new Exception($mysqli->error);

			$how_many_email = $res_email->num_rows;
			if ($how_many_email > 0) {
				
				$val_ok = FALSE;
				$_SESSION['e_email']="<p class='alert alert-danger'>Taki mail już istnieje w bazie</p>";
				header("Location: index.php");
			}

			//czy nick już istnieje
			$res_nick = $mysqli->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
			if (!$res_nick)throw new Exception($mysqli->error);

			$how_many_nick = $res_nick->num_rows;
			if ($how_many_nick >0) {
				
				$val_ok = FALSE;
				$_SESSION['e_nick']="<p class='alert alert-danger'>Taki nick już istnieje w bazie. Wybierz inny</p>";
				header("Location: index.php");
			}
				if ($val_ok == TRUE) {
				//zapis uzytkownika do bazy
					if ($mysqli->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$pass_hash', '$email',100, 100, 100, now() + INTERVAL 14 DAY)")) {
						
						$_SESSION['register_ok'] = TRUE;
						header("Location: welcome.php");


					}else{

						throw new Exception($mysqli->error);
						
					}
				}
			
			$mysqli->close();
		}
	

		
	} catch (Exception $e) {

		echo "<p style='color:red'>Błąd serwera</p>";
		//echo "Informcja developerska: ".$e;
	}

	

	
	
}else{

	
}

 ?>
