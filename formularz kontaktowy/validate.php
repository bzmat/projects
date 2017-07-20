<?php 
session_start();

	if (isset($_POST['name']) && $_POST['name'] != ''){
		
		$name = htmlentities($_POST['name'], ENT_QUOTES, "utf-8");

	}else{

		$_SESSION['no_name'] = "<p class='alert alert-danger'> Proszę uzupełnić imię. </p>";
		header("Location: index.php");
	}

	//sprawdzenie poprawności email

	if (isset($_POST['email']) && $_POST['email'] != ''){

			$email = $_POST['email'];

			$email_safe = filter_var($email, FILTER_SANITIZE_EMAIL);

				if ((filter_var($email_safe, FILTER_VALIDATE_EMAIL))) {
		
					$val_email = TRUE;
		
					}else{

						$val_email = FALSE;
						$_SESSION['bad_email'] = '<p class="alert alert-danger">To nie jest poprawny adres email</p>';
						header("Location: index.php");

					}
	}else{

		$_SESSION['no_email'] = "<p class='alert alert-danger'> Proszę uzupełnić adres email. </p>";
		header("Location: index.php");

	}
	
	if (isset($_POST['contents']) && $_POST['contents'] != ''){
		
		$contents = htmlentities($_POST['contents'], ENT_QUOTES, "utf-8");

	}else{

		$_SESSION['no_contents'] = "<p class='alert alert-danger'> Proszę uzupełnić treść wiadomości. </p>";
		header("Location: index.php");
	}

	

	if (isset($name) && ($val_email == TRUE) && isset($contents)) {

			 require_once('class.phpmailer.php');    //dodanie klasy phpmailer
		     require_once('class.smtp.php');    //dodanie klasy smtp
			    $mail = new PHPMailer();    //utworzenie nowej klasy phpmailer
			    $mail->From = $email_safe;    //adres e-mail użyty do wysyłania wiadomości
			    $mail->FromName = $name;    //imię i nazwisko lub nazwa użyta do wysyłania wiadomości
			    //$mail->AddReplyTo('nadawca@domena.pl', 'mailing'); //adres e-mail nadawcy oraz jego nazwa
			                                                 //w polu "Odpowiedz do"  
			    $mail->Host = "smtp.gmail.com";    //adres serwera SMTP wysyłającego e-mail
			    $mail->Mailer = "smtp"; 		      //do wysłania zostanie użyty serwer SMTP
			    $mail->SMTPSecure = 'ssl';
			    $mail->SMTPAuth = true;    //włączenie autoryzacji do serwera SMTP
			    $mail->Username = "name";    //nazwa użytkownika do skrzynki e-mail
			    $mail->Password = "pass";    //hasło użytkownika do skrzynki e-mail
			    $mail->Port =465; //port serwera SMTP zależny od konfiguracji dostawcy usługi poczty
			    $mail->Subject = "temat";    //Temat wiadomości, można stosować zmienne i znaczniki HTML
			    $mail->Body = $contents ;    //Treść wiadomości, można stosować zmienne i znaczniki HTML     
			    $mail->AddAddress ("example@mail.com","name");    //adres skrzynki e-mail oraz nazwa
                                                    //adresata, do którego trafi wiadomość
     if($mail->Send())    //sprawdzenie wysłania, jeśli wiadomość została pomyślnie wysłana
        {                      
         $_SESSION['mail']="<p class='alert alert-success '>Wiadomość została wysłana.";
			header("Location: index.php"); //wyświetl ten komunikat
        }            
    else    //w przeciwnym wypadku
        {           
        $_SESSION['mail']="<p class='alert alert-danger '>Wiadomość nie została wysłana. Prosze spróbować za chwilę";
			header("Location: index.php");;    //wyświetl następujący
        }

		
		}else{

			$_SESSION['mail'] = "<p class='alert alert-danger '>Wiadomość nie została wysłana. Prosze spróbować za chwilę";
			header("Location: index.php");

		}
		
	

		

	

 ?>