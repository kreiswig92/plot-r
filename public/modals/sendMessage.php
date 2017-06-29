<?php
SESSION_START();
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';

$subject = $_POST['subject'];
$content = $_POST['content'];
$recId = $_POST['recId'];
$sender = $_SESSION['user_id'];
$teamId = $_POST['teamId'];
$specialId = time();

if(empty($subject)){
  $subject = 'No Subject';
}

try {
  $stmt=$dbc->prepare("INSERT INTO DIR_MESSAGES(MESSAGE_SUBJECT,MESSAGE_CONTENT,IS_INVITE, SPECIAL_ID,TEAM_SENDING) VALUES(?,?,?,?,?)");
  $stmt->execute(array($subject, $content, 0, $specialId, $teamId));
} catch (PDOException $e) {
  echo $e->getMessage()."<br> FAILED TO insert data into DIR_MESSAGES";
}

$messageId = getRecord($specialId, 'SPECIAL_ID', 'DIR_MESSAGES', $dbc)['MESSAGE_ID'];

try {
  $stmt = $dbc->prepare("INSERT INTO DIR_MESSAGES_USERS(MESSAGE_ID, SENDER_ID, RECEIVER_ID) VALUES(?,?,?)");
  $stmt->execute(array($messageId, $sender, $recId));
} catch (PDOException $e) {
  echo $e->getMessage()."<br> FAILD TO inser data into DIR_MESSAGES_USERS";
}
echo "success";
 ?>
