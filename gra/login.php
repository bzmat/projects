 <?php 

session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['pass']))) {
	
	header("Location: index.php");
}

require_once('connect.php');
mysqli_report(MYSQLI_REPORT_STRICT);

try {
	
	$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);

	if ($mysqli->connect_errno != 0) {
	
		throw new Exception(mysqli_connect_errno());//błąd połaczenia
}else{

	$login = $_POST['login'];
	$pass = $_POST['pass'];

	$login = htmlentities($login, ENT_QUOTES, "utf-8");
	

		
		if ($res = $mysqli->query(sprintf("SELECT * FROM uzytkownicy WHERE user = '%s' ", mysqli_real_escape_string($mysqli, $login)))) {

		//sparwdzenie ilu jest rekordów odpowiadajaych zapytaniu
		
			$how_many_users = $res->num_rows;
			if ($how_many_users > 0) {
				//odbiór danych z bazy

				$row = $res->fetch_assoc();

				if (password_verify($pass, $row['pass'])) {
					$_SESSION['logged_in'] = TRUE;


					
					$_SESSION['id'] = $row['id'];
					$_SESSION['user'] = $row['user'];
					$_SESSION['drewno'] = $row['drewno'];
					$_SESSION['zboze'] = $row['zboze'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['dnipremium'] = $row['dnipremium'];

					unset($_SESSION['blad']);

					$res->close();

					header("Location: gra.php");
				}else{
				//komunikat o błednym logowaniu

				$_SESSION['blad'] = "<p class = 'alert alert-danger'>Nieprwidłowy login lub hasło! </p>";
				header("Location: index.php");}
			
			
			}else{
				//komunikat o błednym logowaniu

				$_SESSION['blad'] = "<p class = 'alert alert-danger'>Nieprwidłowy login lub hasło! </p>";
				header("Location: index.php");

			}

		}else{

		}

$mysqli->close();

	}


} catch (Exception $e) {
	
	echo "<p style='color:red'>Błąd serwera</p>";
}












 ?>