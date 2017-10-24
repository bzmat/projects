<?php 

require_once 'config.php';

class User{

	private $conn;

	public function __construct(){

		$database = new Database();
		$db = $database-> dbConnection();
		$this->conn=$db;
	}

	public function query($sql){

		try {
			
			$stmt = $this->conn->prepare($sql);
			
			return $stmt;

		} catch (Exception $e) {

			echo $e->getMessage();
			
		}

		
	}

	
	public function doLogin($uname, $upass){

		try {
			
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :uname ");
			$stmt->bindValue(':uname', $uname, PDO::PARAM_STR);
			$stmt->execute();

			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

			
			if (($stmt->rowCount() == 1) && (password_verify($upass, $userRow['password'])) ) {
				
				$_SESSION['user_session'] = $userRow['id'];

				return true;

			}else{

				return false;
			}

		} catch (Exception $e) {

			echo $e->getMessage();
			
		}

	}

	public function is_loggedin(){
		if (isset($_SESSION['user_session'])) {
			
			return true;
		}
	}

	public function doLogout(){

		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}


}

?>


