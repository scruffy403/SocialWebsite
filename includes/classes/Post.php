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

  public function loadPostsFriends($data, $limit) {

    $page = $data['page'];
    $userLoggedIn = $this->user_object->getUsername();

    if ($page ==1)
    {
      $start =0;
    }
    else
    {
      $start = ($page -1) * $limit;
    }

    $string = "";
    $data_query = mysqli_query($this->connection, "SELECT * FROM posts
      WHERE deleted='no' ORDER by id DESC");

    if (mysqli_num_rows($data_query) > 0) {

      // Number of results checked (not necessarilly posted)
      $number_of_iterations = 0;
      $count = 1;



      while ($row = mysqli_fetch_array($data_query)) {
        $id = $row['id'];
        $body = $row['body'];
        $added_by = $row['added_by'];
        $date_time = $row['date_added'];

        // Prepare user_to string to be included even if not posted to a user
        if ($row['user_to'] == "none") {
          $user_to = "";
        }
        else {
          $user_to_object = new User($this->connection, $row['user_to']);
          $user_to_name = $user_to_object->getFirstAndLastName();
          $user_to = "to <a href='" . $row['user_to'] . "'>" . $user_to_name . "</a>";
        }

        // Check if user who posted, has their account closed
        $added_by_object = new User($this->connection, $added_by);
        if ($added_by_object->isClosed()) {
          continue;
        }

        $user_logged_object = new User($this->connection, $userLoggedIn);
        if($user_logged_object->isFriend($added_by)){

          if ($number_of_iterations++ < $start) {
            continue;
          }

          // Once ten posts have been loaded, break
          if ($count > $limit) {
            break;
          }
          else {
            $count ++;
          }

          $user_details_query = mysqli_query($this->connection, "SELECT first_name,
            last_name, profile_pic FROM users WHERE username='$added_by'");
          $user_row = mysqli_fetch_array($user_details_query);
          $first_name = $user_row['first_name'];
          $last_name = $user_row['last_name'];
          $profile_pic = $user_row['profile_pic'];

          // Timeframe
          $date_time_now = date("Y-m-d H:i:s");
          $start_date = new DateTime($date_time); // Time of post
          $end_date = new DateTime($date_time_now); // Current time
          $interval = $start_date->diff($end_date);
          if ($interval->y >= 1) {
            if ($interval->y ==1) {
              $time_message = $interval->y . " year ago.";
            }
            else {
              $time_message = $interval->y . " years ago.";
            }
          }
          else if ($interval->m >= 1) {
            if ($interval->d == 0) {
              $days = " ago";
            }
            else if ($interval->d == 1) {
              $days = $interval->d . " day ago";
            }
            else {
              $days = $interval->d . " days ago";
            }

            if ($interval->m == 1) {
              $time_message = $interval->m . " month" . $days;
            }
            else {
              $time_message = $interval->m . " months" . $days;
            }
          }
          else if ($interval->d >= 1) {
            if ($interval->d == 1) {
              $days = "Yesterday";
            }
            else {
              $time_message = $interval->d . " days ago";
            }
          }
          else if ($interval->h >= 1) {
            if ($interval->h == 1) {
              $time_message = $interval->h . " hour ago";
            }
            else {
              $time_message = $interval->h . " hours ago";
            }
          }
          else if ($interval->i >= 1) {
            if ($interval->i == 1) {
              $time_message = $interval->i . " minute ago";
            }
            else {
              $time_message = $interval->i . " minutes ago";
            }
          }
          else {
            if ($interval->s < 30) {
              $time_message = "Just now";
            }
            else {
              $time_message = $interval->s . " seconds ago";
            }
          }

          $string .= "<div class='status_post'>
                        <div class='post_profile_pic'>
                          <img src='$profile_pic' width='50'>
                        </div>

                        <div class='posted_by' style='color:#ACACAC;'>
                          <a href='$added_by'> $first_name $last_name
                          </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp; $time_message
                        </div>
                        <div id='post_body'>
                          $body
                          <br>
                        </div>

                      </div>
                      <hr>";
        }



      } // End of while loop 

      if ($count > $limit) {
        $string .= "<input type='hidden' class='nextPage' value='"
        . ($page + 1) . "'>
        <input type='hidden' class='noMorePosts' value='false'>";
      }
      else {
        $string .= "<input type='hidden' class='noMorePosts' value='true'>
        <p style='text-aslign: center;'> No more posts to show </p>";
      }
  }

    echo $string;

  }

}





 ?>
