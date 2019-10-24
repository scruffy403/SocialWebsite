<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

if (isset($_GET['profile_username'])) {
  $username = $_GET['profile_username'];
  $user_details_query = mysqli_query($connection, "SELECT * FROM users WHERE username='$username'");
  $user_array = mysqli_fetch_array($user_details_query);

  $number_of_friends = (substr_count($user_array['friend_array'], ",")) -1;
}
 ?>

    <style media="screen">
      .wrapper {
        margin-left: 0px;
        padding-left: 0px;
      }
    </style>

    <div class="profile_left">
      <img src="<?php echo $user_array['profile_pic']; ?>" alt="profile picture">

      <div class="profile_info">
        <p><?php echo "Posts: " . $user_array['num_posts']; ?></p>
        <p><?php echo "Likes: " . $user_array['num_likes']; ?></p>
        <p><?php echo "Friends: " . $number_of_friends; ?></p>

      </div>
      <form class="" action="<?php echo $username; ?>" method="post">
        <?php
        $profile_user_object = new User($connection, $username);
        if ($profile_user_object->isClosed()) {
          header("Location: user_closed.php");
        }

        $logged_in_user_object = new User($connection, $userLoggedIn);

        if ($userLoggedIn != $username) {

          if ($logged_in_user_object->isFriend($username)) {
            echo '<input type="submit" name="remove_friend" class="danger" value="Remove Friend"><br>';
          }
          else if ($logged_in_user_object->didReceiveRequest($username)) {
            echo '<input type="submit" name="respond_request" class="warning" value="Respond to Request"><br>';
          }
          else if ($logged_in_user_object->didSendRequest($username)) {
            echo '<input type="submit" name="" class="default" value="Request Sent"><br>';
          }
          else {
            echo '<input type="submit" name="add_friend" class="success" value="Add Friend"><br>';
          }
        }

        ?>

      </form>
    </div>

    <div class="main_column column">
      <?php echo $username; ?>

    </div>

  </div>
  </body>
</html>
