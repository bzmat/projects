<?php

require_once 'config.php';

require_once 'session.php'; 

class Signup{

private $conn;

public function __construct(){

	$database = new Database();
	$db = $database->dbConnection();
	$this->conn=$db;
}

//sprawdzenie czy formularz nie jest pusty
public function is_empty($uname, $upass, $uemail){

	if ($uname == '' || $upass == '' || $uemail == '') {

		$_SESSION['e_message']  = "Proszę uzupełnić wszystkie pola";

		

	}else{

		return true;
	}


}

//sprawdzenie długości loginu, hasła i maila

public function lenght($uname, $upass, $uemail){

	
	if ((strlen($uname) > 20) || (strlen($uname) < 3) ) {

		$_SESSION['e_lenght_name'] = "Nazwa uzytkownika musi posiadać minimum 3 znaki, maksimum        20znaków ";
		
	}
	if ((strlen($upass) > 20) || (strlen($upass) < 3)) {
		
		$_SESSION['e_lenght_pass'] = "Hasło musi posiadać minimum 3 znaki, maksimum 20znaków ";
	
	}
	if ((strlen($uemail) > 30) || (strlen($uemail) < 5)) {

		$_SESSION['e_lenght_mail'] = "Email musi posiadać minimum 5 znaki, maksimum 30znaków ";
		
	}
}

//validacja adresu email
public function is_email($uemail){

	if (filter_var($uemail, FILTER_VALIDATE_EMAIL)) {

		return true;
		
	}else{

		$_SESSION['e_email'] = "Adres email jest nieprawidłowy. Spróbuj jeszcze raz";
	}

}

//sprawdzenie loginu  w bazie
public function is_unic($uname, $uemail){

try {
	
	$stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :uname ");

	$stmt->bindValue(":uname", $uname, PDO::PARAM_STR );

	
	$stmt->execute();

	if (($stmt->rowCount()) > 0) {

		$_SESSION['e_unic_login']  = "Podany login jest już zajęty.";
		
	}else{

		return true;
	}

	

} catch (Exception $e) {

	echo $e->getMessage();
	
}

}

//rejestracja nowego uzytkownika
public function register($uname, $upass_hash, $uemail){

		try {

			$stmt = $this->conn->prepare("INSERT INTO users(username, password, email) VALUES (:uname, :upass, :uemail) ");
			$stmt->bindValue(":uname", $uname, PDO::PARAM_STR );
			$stmt->bindValue(":upass", $upass_hash, PDO::PARAM_STR);
			$stmt->bindValue(":uemail", $uemail, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt;
			
		} catch (PDOException $e) {

			echo $e->getMessage();
			
		}
	}

}

 ?>