<?php
require 'config/config.php';

if(isset($_SESSION['username']))
{
  $userLoggedIn = $_SESSION['username'];
  $user_details_query = mysqli_query($connection, "SELECT * FROM users WHERE username='$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
}
else {
  header("Location: register.php");
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Familly Connect!</title>

    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <!-- CSS -->
    <script src="https://kit.fontawesome.com/71db4d34ca.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    </script>
  </head>
  <body>
    <div class="top_bar">
      <div class="logo">
        <a href="index.php">Family Connect!</a>

      </div>

      <nav>
        <a href="#">
          <?php echo $user['first_name']; ?>
        </a>
        <a href="index.php">
          <i class="fas fa-home"></i>
        </a>
        <a href="#">
          <i class="fas fa-envelope"></i>
        </a>
        <a href="#">
          <i class="fas fa-bell"></i>
        </a>
        <a href="#">
          <i class="fas fa-users"></i>
        </a>
        <a href="#">
          <i class="fas fa-cog"></i>
        </a>

      </nav>

    </div>
