<?php 

session_start();

if (!isset($_SESSION['user'])) {

  header("Location: index.php");
  
}

include ('includes/conn.inc.php');

if (isset($_POST['login'])) {
	
	$uid = $_POST['uid'];
	$password = $_POST['password'];

	echo $uid;

	$stmt = $conn->prepare("SELECT * FROM users WHERE uid=:uid ");
	$stmt->bindParam(':uid', $uid);
	$stmt->execute();

	

	$result = $stmt->rowCount();

	if ($result > 0) {
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

			if (password_verify($password, $result['password'] ) ) {

				
				header("Location: myaccount.php");

				$_SESSION['user'] = $result['id'];

				$_SESSION['user_name'] = $result['uid'];

		}else{

				echo "Dane logowania są błędne ";
	}
	}


	
	

}else{

	echo "Proszę uzupłenić wszystkie pola";
}

 ?>