<?php
session_start();
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

if (isset($_POST['register_button']))
{
  // registration form values

  // First name
  $firstName = strip_tags($_POST[ 'register_fname']); // remove html tags
  $firstName = str_replace(' ', '', $firstName); // remove spaces
  $firstName = ucfirst(strtolower($firstName)); // first letter uppercase
  $_SESSION['register_fname'] = $firstName; // stores vinto session variable

  // Last name
  $lastName = strip_tags($_POST[ 'register_lname']); // remove html tags
  $lastName = str_replace(' ', '', $lastName); // remove spaces
  $lastName = ucfirst(strtolower($lastName)); // first letter uppercase
  $_SESSION['register_lname'] = $lastName; // stores into session variable


  // Email
  $email = strip_tags($_POST[ 'register_email']); // remove html tags
  $email = str_replace(' ', '', $email); // remove spaces
  $email = ucfirst(strtolower($email)); // first letter uppercase
  $_SESSION['register_email'] = $email; // stores into session variable

  // Confirm email
  $confirmEmail = strip_tags($_POST[ 'register_email2']); // remove html tags
  $confirmEmail = str_replace(' ', '', $confirmEmail); // remove spaces
  $confirmEmail = ucfirst(strtolower($confirmEmail)); // first letter uppercase
  $_SESSION['register_email2'] = $confirmEmail; // stores into session variable

  // Password
  $password = strip_tags($_POST[ 'register_password']); // remove html tags

  // Confirm password
  $confirmPassword = strip_tags($_POST[ 'register_password2']); // remove html tags

  $signupDate = "Y-m-d";

  if($email == $confirmEmail)
  {
    // validate email format
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      // check if email is already in DB
      $email_check = mysqli_query($connection, "SELECT email FROM users WHERE email='$email'");

      $count_rows_returned = mysqli_num_rows($email_check);

      if($count_rows_returned > 0)
      {
        echo "Email already in use";
      }
    }
    else
    {
      echo "Invalid email format";

    }
  }
  else
  {
    echo "Emails don't match!";
  }

  if(strlen($firstName) > 25 || strlen($firstName) < 2)
  {
    echo "Your first name must be between 2 and 25 characters!";
  }

  if(strlen($lastName) > 25 || strlen($lastName) < 2)
  {
    echo "Your last name must be between 2 and 25 characters!";
  }

  if($password != $confirmPassword)
  {
    echo "Your passwords do not match!";
  }
  else
  {
    if(preg_match('/[^A-Za-z0-9]/', $password))
    {
      echo "Your password can only contain English characters!";
    }
  }

  if(strlen($password) > 30 || strlen($password) < 5)
  {
    echo "Your password must be between 5 and 30 characters!";
  }


}

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
