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

if (isset($_POST['register_button']))
{
  // registration form values

  // First name
  $firstName = strip_tags($_POST[ 'register_fname']); // remove html tags
  $firstName = str_replace(' ', '', $firstName); // remove spaces
  $firstName = ucfirst(strtolower($firstName)); // first letter uppercase

  // Last name
  $lastName = strip_tags($_POST[ 'register_lname']); // remove html tags
  $lastName = str_replace(' ', '', $lastName); // remove spaces
  $lastName = ucfirst(strtolower($lastName)); // first letter uppercase

  // Email
  $email = strip_tags($_POST[ 'register_email']); // remove html tags
  $email = str_replace(' ', '', $email); // remove spaces
  $email = ucfirst(strtolower($email)); // first letter uppercase

  // Confirm email
  $confirmEmail = strip_tags($_POST[ 'register_email2']); // remove html tags
  $confirmEmail = str_replace(' ', '', $confirmEmail); // remove spaces
  $confirmEmail = ucfirst(strtolower($confirmEmail)); // first letter uppercase

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
