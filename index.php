<?php
include("includes/header.php");


if(isset($_POST['post']))
{
  $post = new Post($connection, $userLoggedIn);
  $post->submitPost($_POST['post_text'], 'none');
  header("Location: index.php");
}

 ?>
    <div class="user_details column">
      <a href="<?php echo $userLoggedIn;?>"> <img src="<?php
      echo $user['profile_pic']; ?>"> </a>

      <div class="user_details_beside_pic">
        <a href="<?php echo $userLoggedIn;?>">
          <?php
          echo $user['first_name'] . " " . $user['last_name'];
           ?>
        </a>
        <br>
        <?php
        echo "Posts: " . $user['num_posts'] . "<br>";
        echo "Likes: " . $user['num_likes'];
        ?>
      </div>

    </div>

    <div class="main_column column">

      <form class="post_form" action="index.php" method="POST">
        <textarea name="post_text" id="post_text"
        placeholder="Got something to say?"></textarea>
        <input type="submit" name="post" id="post_button" value="Post">
        <hr>

      </form>

       <div class="posts_area"></div>
       <img id="loading" src="assets/images/icons/loading.gif"
       alt="loading logo">


    </div>

    <div class="user_details column">

      <div class="trends">
        <h4>Popular</h4>
        <?php
        $query = mysqli_query($connection, "SELECT * FROM trends ORDER BY hits DESC LIMIT 9");

        foreach ($query as $row) {

          $word = $row['title'];
          $word_dot = strlen($word) >= 14 ? "..." : "";

          $trimmed_word = str_split($word, 14);
          $trimmed_word = $trimmed_word[0];

          echo "<div style='padding: 1px'>";
          echo $trimmed_word . $word_dot;
          echo "<br></div>";

        }
         ?>
      </div>

    </div>

    <script>
    // Code block that enables infinite scrolling
    var userLoggedIn = '<?php echo $userLoggedIn; ?>';

    $(document).ready(function(){

      $('#loading').show();

      // Original ajax request for loading first posts
      $.ajax({
        url: "includes/handlers/ajax_load_posts.php",
        type: "POST",
        data: "page=1&userLoggedIn=" + userLoggedIn,
        cache:false,

        success: function(data) {
          $('#loading').hide();
          $('.posts_area').html(data);
        }

      });

      $(window).scroll(function(){
        var height = $('.posts_area').height(); // Div containing posts
        var scroll_top = $(this).scrollTop();
        var page = $('.posts_area').find('.nextPage').val();
        var noMorePosts = $('.posts_area').find('.noMorePosts').val();

        if((document.body.scrollHeight == document.body.scroll_top +
          window.innerHeight) && noMorePosts == 'false') {
             $('#loading').show();


             var ajaxReq = $.ajax({
               url: "includes/handlers/ajax_load_posts.php",
               type: "POST",
               data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
               cache:false,

               success: function(response) {
                 $('.posts_area').find('.nextPage').remove(); // Removes current .nextPage
                 $('.posts_area').find('.noMorePosts').remove(); // Removes current .nextPage


                 $('#loading').hide();
                 $('.posts_area').append(response);
               }
             });

           } // End if

           return false;
      }); // End $(window).scroll(function()

    });
    </script>

  </div>
  </body>
</html>
