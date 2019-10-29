<?php
include("includes/header.php");

if (isset($_GET['profile_username'])) {
  $username = $_GET['profile_username'];
  $user_details_query = mysqli_query($connection, "SELECT * FROM users WHERE username='$username'");
  $user_array = mysqli_fetch_array($user_details_query);

  $number_of_friends = (substr_count($user_array['friend_array'], ",")) -1;

  if (isset($_POST['remove_friend'])) {
    $user = new User($connection, $userLoggedIn);
    $user->removeFriend($username);
  }
  if (isset($_POST['add_friend'])) {
    $user = new User($connection, $userLoggedIn);
    $user->sendRequest($username);
  }
  if (isset($_POST['respond_request'])) {
    header("Location: requests.php");
  }

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

      <input type="submit" class="deep_blue" data-toggle="modal" data-target="#post_form" value="Post Something">

    </div>

    <div class="main_column column">
      <?php echo $username; ?>

    </div>



<!-- Modal -->
<div class="modal fade" id="post_form" tabindex="-1" role="dialog" aria-labelledby="postModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Post Something!</h4>
      </div>
      <div class="modal-body">
        <p>This will appear on the users profile page and also their newsfeed for your friends to see!</p>
        <form class="profile_post" action="" method="post">
          <div class="form_group">
            <textarea class="form_control"name="post_body" ></textarea>
            <input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
            <input type="hidden" name="user_to" value="<?php echo $username; ?>">
          </div>
        </form>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="post_button" id="submit_profile_post">Post</button>
      </div>
    </div>
  </div>
</div>

  </div>
  </body>
</html>
