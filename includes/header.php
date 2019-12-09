<?php
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
require 'config/config.php';

if(isset($_SESSION['username']))
{
  $userLoggedIn = $_SESSION['username'];
  $user_details_query = mysqli_query($connection, "SELECT * FROM users
    WHERE username='$userLoggedIn'");
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
    <script src="assets/js/bootbox.min.js"></script>
    <script src="assets/js/familyConnect.js"></script>
    <script src="assets/js/jquery.Jcrop.js"></script>
  	<script src="assets/js/jcrop_bits.js"></script>

    <!-- CSS -->
    <script src="https://kit.fontawesome.com/71db4d34ca.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />

    </script>
  </head>
  <body>
    <div class="top_bar">
      <!-- background image credit -->
      <a style="background-color:black;color:white;
      text-decoration:none;padding:4px 6px;font-family:-apple-system,
      BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;
      Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;
      Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;
      line-height:1.2;display:inline-block;border-radius:3px"
      href="https://unsplash.com/@vnedit?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge"
      target="_blank" rel="noopener noreferrer"
      title="Download free do whatever you want high-resolution photos from
      M Angie Salazar"><span style="display:inline-block;padding:2px 3px">
        <svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;
        position:relative;vertical-align:middle;top:-2px;fill:white"
        viewBox="0 0 32 32"><title>unsplash-logo</title><path
        d="M10 9V0h12v9H10zm12 5h10v18H0V14h10v9h12v-9z"></path></svg></span>
        <span style="display:inline-block;padding:2px 3px">M Angie Salazar</span>
      </a>
      <div class="logo">
        <a href="index.php">Family Connect!</a>

      </div>

      <nav>
        <a href="<?php echo $userLoggedIn;?>">
          <?php echo $user['first_name']; ?>
        </a>
        <a href="index.php">
          <i class="fas fa-home"></i>
        </a>
        <a href="javascript:void(0);" onclick="getDropDownData('<?php echo $userLoggedIn;?>', 'message')">
          <i class="fas fa-envelope"></i>
        </a>
        <a href="#">
          <i class="fas fa-bell"></i>
        </a>
        <a href="requests.php">
          <i class="fas fa-users"></i>
        </a>
        <a href="#">
          <i class="fas fa-cog"></i>
        </a>
        <a href="includes/handlers/logout.php">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </nav>

      <div class="dropdown_data_window" style="height: 0px; border: none;">
        <input type="hidden"  id="dropdown_data_type" value="">
      </div>

    </div>

    <div class="wrapper">
