<?php
  session_start();
  if(isset($_SESSION["user"])) {
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <!-- data store into the database -->
    <?php
    	if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
				// database connection
        require_once("database.php");
				$sql = "SELECT * FROM user_auth WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($user) {
          if(password_verify($password, $user['password'])) {
            session_start();
            $_SESSION["user"] = "yes";
            header("Location: index.php");
            die();
          } else {
            echo "<h1 class='alert'>Password does not match...!<h1>";
          }
        } else {
          echo "<h1 class='alert'>Email does not match...!</h1>";
        }
      }
    ?>
    <!-- login form-->
    <form action="login.php" method="post" class="form-container">
      <h1 class="form-heading">Login Form</h1>
      <div class="input-box">
        <input type="email" name="email" id="email" placeholder="Enter email address">
        <input type="password" name="password" id="password" placeholder="Enter password">
      </div>
      <div class="but-card">
        <button type="submit" name="login" class="button">Login</button>
        <span>Not yet registred <a href="./registration.php">Register</a> </span>
      </div>
    </form>
  </body>
</html>