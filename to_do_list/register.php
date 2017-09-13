<?php 

session_start();

/*if (isset($_SESSION['user'])) {

  header("Location: myaccount.php");
  
}*/

include ('includes/conn.inc.php');

if (isset($_POST['register'])) {
  
  $uid = $_POST['uid'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password_h = password_hash($password, PASSWORD_BCRYPT);

  

  //check login in base

  $stmt = $conn->prepare("SELECT * FROM users WHERE uid=:uid");
  $stmt->bindParam(':uid', $uid);
  $stmt -> execute();

  $result = $stmt->rowCount();

    if ($result > 0) {

      header("Location: index.php");

      $_SESSION['error_reg'] = "Podany login jest zajęty. Spróbuj inny";
      
      

    }else{

      $stmt = $conn->prepare("INSERT INTO users VALUES (NULL, :uid, :email, :password)");
      $stmt->bindParam(':uid', $uid);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $password_h);
      $stmt->execute();


      $stmt = $conn->prepare("SELECT * FROM users WHERE uid=:uid ");
      $stmt->bindParam(':uid', $uid);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      $_SESSION['user'] = $result['id'];

      $_SESSION['user_name'] = $result['uid'];

      header("Location: myaccount.php");
      
    }

}else{

  header("Location: index.php");

  $_SESSION['error_reg'] = "Proszę uzupełnić wszystkie pola";
}

 ?>
 