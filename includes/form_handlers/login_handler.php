<?php
if(isset($_POST['login_button']))
{
  $email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL);

  $_SESSION['login_email'] = $email; // stores email in session variable
  $password = md5($_POST['login_password']);

  $login_database_query = mysqli_query($connection, "SELECT * FROM users
    WHERE email='$email' AND password='$password'");
  $check_login_query = mysqli_num_rows($login_database_query);

  if($check_login_query == 1)
  {
    $row = mysqli_fetch_array($login_database_query);
    $username = $row['username'];

    $user_closed_query = mysqli_query($connection, "SELECT * FROM users
      WHERE email='$email' AND user_closed='yes'");
    if(mysqli_num_rows($user_closed_query) ==1)
    {
      $reopen_account = mysqli_query($connection, "UPDATE users SET
        user_closed='no' WHERE email='$email'");
    }

    $_SESSION['username'] = $username;
    header("Location: index.php");
    exit();
  }
  else
  {
    array_push($errorMessagesArray, "<span style='color: red';>Email or
    password was incorrect</span><br>");
  }

}

 ?>
