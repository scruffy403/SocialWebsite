<?php

// declaring variables to prevent errors

$firstName = "";
$lastName = "";
$email = "";
$confirmEmail = "";
$password = "";
$confirmPassword = "";
$signupDate = "";
$errorMessagesArray = array();

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

  $signupDate = date('Y-m-d');

  if($email == $confirmEmail)
  {
    // validate email format
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      // check if email is already in DB
      $email_check = mysqli_query($connection, "SELECT email FROM users
        WHERE email='$email'");

      $count_rows_returned = mysqli_num_rows($email_check);

      if($count_rows_returned > 0)
      {
        array_push($errorMessagesArray, "Email already in use<br>");
      }
    }
    else
    {
      array_push($errorMessagesArray, "Invalid email format<br>");

    }
  }
  else
  {
    array_push($errorMessagesArray, "Emails don't match<br>");
  }

  if(strlen($firstName) > 25 || strlen($firstName) < 2)
  {
    array_push($errorMessagesArray, "Your first name must be between 2 and 25
    characters<br>");
  }

  if(strlen($lastName) > 25 || strlen($lastName) < 2)
  {
    array_push($errorMessagesArray, "Your last name must be between 2 and 25
    characters<br>");
  }

  if($password != $confirmPassword)
  {
    array_push($errorMessagesArray, "Your passwords do not match<br>");
  }
  else
  {
    if(preg_match('/[^A-Za-z0-9]/', $password))
    {
      array_push($errorMessagesArray, "Your password can only contain English
      characters<br>");
    }
  }

  if(strlen($password) > 30 || strlen($password) < 5)
  {
    array_push($errorMessagesArray, "Your password must be between 5 and 30
    characters<br>");
  }

  if(empty($errorMessagesArray))
  {
    $password = md5($password); // Encrypt password before sending to DB

    // Generate username by concatenating first and last name
    $username = strtolower($firstName . "_" . $lastName);
    $checkDB_for_username = mysqli_query($connection, "SELECT username FROM
      users WHERE username='$username'");

    $i =0;
    while(mysqli_num_rows($checkDB_for_username) != 0)
    {
      $i++;
      $username = $username . "_" . $i;
      $checkDB_for_username = mysqli_query($connection, "SELECT username FROM
        users WHERE username='$username'");
    }

    // Assign default profile picture
    $random = rand(1, 2); // random number between 1 and 2
    if($random ==1)
    {
      $profile_pic = "assets/images/profile_pics/default/head_wet_asphalt.png";
    }
    else if($random ==2)
    {
      $profile_pic = "assets/images/profile_pics/default/head_wisteria.png";
    }

    $query_create_account = mysqli_query($connection, "INSERT INTO users (id,
      first_name, last_name, username, email, password, signup_date,
      profile_pic, num_posts, num_likes, user_closed, friend_array)
      VALUES(NULL, '$firstName', '$lastName', '$username', '$email', '$password',
         '$signupDate', '$profile_pic', '0', '0', 'no', ',')");

    array_push($errorMessagesArray, "<span style='color: #14C800;'>You're all
    set! Go ahead and login!</span><br>");

    // clear session variable
    $_SESSION['register_fname'] = "";
    $_SESSION['register_lname'] = "";
    $_SESSION['register_email'] = "";
    $_SESSION['register_email2'] = "";

  }

}

 ?>
