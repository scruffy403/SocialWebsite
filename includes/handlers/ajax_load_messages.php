<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Message.php");

$limit = 7; // Number of messages to load

$message = new Message($connection, $_REQUEST['userLoggedIn']);
echo $message->getConversationsDropdown($_REQUEST, $limit);

 ?>
