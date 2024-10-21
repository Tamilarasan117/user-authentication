<?php
  session_start();
  if(!isset($_SESSION["user"])) {
    header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>index Page</title>
  </head>
  <body>
    <div class="index-bg-cont">
      <nav class="nav-card">
        <img src="./Logo.jpg" alt="logo" class="logo">
        <button class="logout-but">
          <a href="./logout.php">Logout</a>
        </button>
      </nav>
      <div class="banner-card" id="netflix-card">
        <h1 class="head">Unlimited films, TV<br>programes and<br> more</h1>
        <p class="para">Watch anywhere, cancel at any time</p>
        <p class="para">Ready to watch? Enter you email to create or restore your membership.</p>
        <form class="search-card">
          <input type="text" class="in" placeholder="Search somthing" required="">
          <input type="submit" class="in in-but">
        </form>
      </div>
    </div>
  </body>
</html>