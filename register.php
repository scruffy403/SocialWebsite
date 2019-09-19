<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Social</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
  </head>
  <body>

    <div class="wrapper">
      <div class="login_box ">
        <!-- login form -->
        <form action="register.php" method="POST">
          <input type"email" name="login_email" placeholder="Email Address" value="<?php
          if(isset($_SESSION['login_email']))
          {
            echo $_SESSION['login_email'];
          }
          ?>" required>
          <br>
          <input type"password" name="login_password" placeholder="Password">
          <br>
          <input type="submit" name="login_button" value="Login">
          <br>
          <?php if(in_array("<span style='color: red';>Email or password was incorrect</span><br>", $errorMessagesArray)) echo "<span style='color: red';>Email or password was incorrect</span><br>"; ?>

        </form>
        <br>

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

        </form>
      </div>
    </div>

  </body>
</html>
