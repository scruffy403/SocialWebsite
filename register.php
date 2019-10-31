<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Family Connect</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>

    </script>

  </head>
  <body>
    <!-- Image credit -->
    <a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px" href="https://unsplash.com/@iancylkowskiphotography?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Ian Cylkowski"><span style="display:inline-block;padding:2px 3px"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-2px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M10 9V0h12v9H10zm12 5h10v18H0V14h10v9h12v-9z"></path></svg></span><span style="display:inline-block;padding:2px 3px">Ian Cylkowski</span></a>
    <?php
    if(isset($_POST['register_button'])) {
      echo '
      <script>
      $(document).ready(function(){
        $("#first").hide();
        $("#second").show();
      });
      </script>
      ';
    }
     ?>

    <div class="wrapper">

      <div class="login_box ">
        <div class="login_header">
          <h1>Family Connect!</h1>
          Login or signup below
        </div>

          <div id="first">
            <!-- login form -->
            <form action="register.php" method="POST">
              <input type"email" name="login_email" placeholder="Email Address" value="<?php
              if(isset($_SESSION['login_email']))
              {
                echo $_SESSION['login_email'];
              }
              ?>" required>
              <br>
              <input type="password" name="login_password" placeholder="Password">
              <br>
              <input type="submit" name="login_button" value="Login">
              <br>
              <?php if(in_array("<span style='color: red';>Email or password was incorrect</span><br>", $errorMessagesArray)) echo "<span style='color: red';>Email or password was incorrect</span><br>"; ?>

            </form>
            <br>
            <a href="#" id="signup" class="signup">Need an account? Register here!</a>
          </div>

          <div id="second">
            <!-- registration form -->
            <form class="" action="register.php" method="post">
              <input type="text" name="register_fname" placeholder="First Name" value="<?php
              if(isset($_SESSION['register_fname']))
              {
                echo $_SESSION['register_fname'];
              }
              ?>" required>
              <br>
              <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $errorMessagesArray)) echo "Your first name must be between 2 and 25 characters<br>"; ?>

              <input type="text" name="register_lname" placeholder="Last Name"
              value="<?php
              if(isset($_SESSION['register_lname']))
              {
                echo $_SESSION['register_lname'];
              }
              ?>" required>
              <br>
              <?php if(in_array("Your last name must be between 2 and 25 characters<br>", $errorMessagesArray)) echo "Your last name must be between 2 and 25 characters<br>"; ?>

              <input type="email" name="register_email" placeholder="Email"
              value="<?php
              if(isset($_SESSION['register_email']))
              {
                echo $_SESSION['register_email'];
              }
              ?>" required>
              <br>

              <input type="email" name="register_email2" placeholder="Confirm Email"
              value="<?php
              if(isset($_SESSION['register_email2']))
              {
                echo $_SESSION['register_email2'];
              }
              ?>" required>
              <br>
              <?php if(in_array("Email already in use<br>", $errorMessagesArray)) echo "Email already in use<br>";
                    else if(in_array("Invalid email format<br>", $errorMessagesArray)) echo "Invalid email format<br>";
                    else if(in_array("Emails don't match<br>", $errorMessagesArray)) echo "Emails don't match<br>"; ?>

              <input type="password" name="register_password" placeholder="Password" required>
              <br>

              <input type="password" name="register_password2" placeholder="Confirm Password" required>
              <br>
              <?php if(in_array("Your password can only contain English characters<br>", $errorMessagesArray)) echo "Your password can only contain English characters<br>";
                    else if(in_array("Your password must be between 5 and 30 characters<br>", $errorMessagesArray)) echo "Your password must be between 5 and 30 characters<br>";
                    else if(in_array("Your passwords do not match<br>", $errorMessagesArray)) echo "Your passwords do not match<br>"; ?>


              <input type="submit" name="register_button" value="Register">
              <br>
              <?php if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $errorMessagesArray))
              {
                echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>";
              }
              ?>
              <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>

            </form>
      </div>
      </div>
    </div>

  </body>
</html>
