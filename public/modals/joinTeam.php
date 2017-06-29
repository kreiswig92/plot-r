<?php
SESSION_START();
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';
$teamId = $_POST['teamId'];
$userId = $_POST['userId'];
$messageId = $_POST['messageId'];
$isAdmin = $_POST['admin'];

//add to table
try {
  $stmt = $dbc->prepare("INSERT INTO USERS_TEAMS(USER_ID, TEAM_ID, IS_ADMIN) VALUES(?,?,?)");
  $stmt->execute(array($userId, $teamId, $isAdmin));
} catch (PDOException $e) {
  echo $e->getMessage()."<br>Failed to insert USERS_TEAMS data";
}

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
