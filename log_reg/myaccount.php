<?php 

$siteTitle = "My account";

require_once 'session.php';

require_once 'class.user.php';

require_once 'views/header.php';

$auth_user = new User();

$user_id = $_SESSION['user_session'];


$stmt = $auth_user->query("SELECT * FROM users WHERE id = :user_id");

$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

$stmt->execute();

$userRow = $stmt->fetch(PDO::FETCH_ASSOC);


?>

  <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">PHP OOP</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li <?php if ($siteTitle == "My account") echo 'class="active"'; ?> ><a href="">My Account</a></li>
                  <li><a href="logout.php?logout=true">Logout</a></li>
                  </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">

            <h1 class="cover-heading">Witaj <?php echo $userRow['username'];  ?> </h1>
            
          </div>

                  

          <div class="mastfoot">
            <div class="inner">
              <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
            </div>
          </div>

        </div><!--container-->

      </div><!--site-wrapper-inner-->

    </div><!--site-wrapper-->

<?php 
	include 'views/footer.php';
 ?>