<?php
$connection = mysqli_connect("localhost", "root", "", "social");

if(mysqli_connect_errno())
{
  echo "Failed to connect: " . mysqli_connect_errno();
}

// declaring variables to prevent errors

$firstName = "";
$lastName = "";
$email = "";
$confirmEmail = "";
$password = "";
$confirmPassword = "";
$signupDate = "";
$errorMessagesArray = "";

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Social</title>
  </head>
  <body>
    <form class="" action="register.php" method="post">
      <input type="text" name="register_fname" placeholder="First Name" required>
      <br>
      <input type="text" name="register_lname" placeholder="Last Name" required>
      <br>
      <input type="email" name="register_email" placeholder="Email" required>
      <br>
      <input type="email" name="register_email2" placeholder="Confirm Email" required>
      <br>
      <input type="password" name="register_password" placeholder="Password" required>
      <br>
      <input type="password" name="register_password2" placeholder="Confirm Password" required>
      <br>
      <input type="submit" name="register_button" value="Register">

    </form>

  </body>
</html>
