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
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <!-- data storing into the database -->
    <?php
      if(isset($_POST["registration"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $conformPassword = $_POST["conform_password"];
        $passwordSecurity = password_hash($password,PASSWORD_DEFAULT);
        // data validation
        $error = array();
        if(empty($username) || empty($email) || empty($password) || empty($conformPassword)) {
          array_push($error,"All fields are required!");
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          array_push($error,"invalid email!");
        }
        if(strlen($password) < 8) {
          array_push($error,"Password must be at least 8 characters!");
        }
        if($password !== $conformPassword) {
          array_push($error,"Password do not match please give correct password!");
        }
        // database connection
        require_once("database.php");
        $check_query = "SELECT * FROM user_auth WHERE email = '$email'";
        $result = mysqli_query($conn, $check_query);
        
        // email validation
        $email_count = mysqli_num_rows($result);
        if($email_count > 0) {
          array_push($error,"Email id already exist!");
        }

        $insert_query = "INSERT INTO user_auth (username, email, password) VALUES( ?, ?, ? )";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $insert_query);
        if($prepareStmt) {
          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordSecurity);
          mysqli_stmt_execute($stmt);
          echo "<h1 class='success'>You are registred successfully!</h1>";
        } else {
          die("Somthing went wrong!");
        }
      }
    ?>
    <!-- registration form -->
    <form action="registration.php" method="post" class="form-container">
      <h1 class="form-heading">Registration Form</h1>
      <div class="input-box">
        <input type="text" name="username" id="username" placeholder="Enter username" require>
        <input type="email" name="email" id="email" placeholder="Enter email address">
        <input type="password" name="password" id="password" placeholder="Enter password">
        <input type="password" name="conform_password" id="conform_password" placeholder="Enter conform password">
      </div>
      <div class="but-card">
        <button type="submit" name="registration" class="button">Register</button>
        <span>Already have an account <a href="./login.php">Login</a> </span>
      </div>
    </form>
  </body>
</html>