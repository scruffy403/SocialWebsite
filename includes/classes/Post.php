<?php
class Post {
  private $user_object;
  private $connection;

  public function __construct($connection, $user) {
    $this->connection = $connection;
    $this->user_object = new User($connection, $user);
  }

  public function submitPost($body, $user_to) {
    $body = strip_tags($body); // strips html tags
    $body = mysqli_real_escape_string($this->connection, $body);

    $body = str_replace('\r\n', '\n', $body);
    $body = nl2br($body);

    $check_if_empty = preg_replace('/\s+/', '', $body); // Deletes all spaces in $body

    if($check_if_empty != "")
    {

      // Current date and time
      $date_added = date("Y-m-d H:i:s");
      $added_by = $this->user_object->getUsername();

      // If user is on their own profile, user_to is 'none'
      if($user_to == $added_by)
      {
        $user_to = "none";
      }

      // insert post into database
      $query = mysqli_query($this->connection, "INSERT INTO posts VALUES(null,
         '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
      $returned_id = mysqli_insert_id($this->connection);

        //  Insert notification

        // Update post count for user
        $numberOfPosts = $this->user_object->getNumberOfPosts();
        $numberOfPosts++;
        $update_post_count = mysqli_query($this->connection, "UPDATE users
          SET num_posts='$numberOfPosts' WHERE username='$added_by'");



    }
  }

}



 ?>
