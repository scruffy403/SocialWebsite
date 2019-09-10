<?php
$connection = mysqli_connect("localhost", "root", "", "social");

if(mysqli_connect_errno())
{
  echo "Failed to connect: " . mysqli_connect_errno();
}

$query = mysqli_query($connection, "INSERT INTO test VALUES(null, 'John')");

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SocialFeed</title>
  </head>
  <body>
    Hello JD
  </body>
</html>
