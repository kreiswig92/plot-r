<?php
require_once '../../lib/connectplotr.php';
$messageId = $_POST['messageId'];

//removing message from DIR_MESSAGES
try {
  $stmt = $dbc->prepare("DELETE FROM DIR_MESSAGES WHERE MESSAGE_ID = ?");
  $stmt->execute(array($messageId));
} catch (PDOException $e) {
  echo $e->getMessage()."<br>Faild to delete record from DIR_MESSAGES";
}

//removing message from DIR_MESSAGES_USERS
try {
  $stmt = $dbc->prepare("DELETE FROM DIR_MESSAGES_USERS WHERE MESSAGE_ID = ?");
  $stmt->execute(array($messageId));
} catch (PDOException $e) {
  echo $e->getMessage()."<br>Faild to delete record from DIR_MESSAGES_USERS";
}
 ?>
