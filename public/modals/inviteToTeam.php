<?php
SESSION_START();
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';
require_once '../modals/team_data.php';

$flag = true;
$team = $_POST['team'];
$email = $_POST['email'];
$admin = $_POST['admin'];
$receiverRecord = getRecord($email, 'EMAIL', 'PLOT_USERS', $dbc);
$sender = $_SESSION['user_id'];


if(!inTable($email, 'EMAIL', 'PLOT_USERS', $dbc)) {
  'notJoined';
  $flag = false;
}
if(isTeamMember($receiverRecord['USER_ID'], $team, $dbc)) {
  echo 'isMember';
  $flag = false;
}
if($flag) {
  $adminForm = "<form id='adminForm'><input type='hidden' value=$admin id='is_admin'></form>";
  $teamName = getRecord($team, 'TEAM_ID', 'TEAMS', $dbc )['TEAM_NAME'];
  $teamId = getRecord($team, 'TEAM_ID', 'TEAMS', $dbc )['TEAM_ID'];
  $subject = 'New Invite';
  $message = "You've been invited to join $teamName! Join the team!".$adminForm;
  $specialId = time();

  try {
    $stmt=$dbc->prepare("INSERT INTO DIR_MESSAGES(MESSAGE_SUBJECT,MESSAGE_CONTENT,IS_INVITE, SPECIAL_ID,TEAM_SENDING) VALUES(?,?,?,?,?)");
    $stmt->execute(array($subject, $message, 1, $specialId, $teamId));
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> FAILED TO insert data into DIR_MESSAGES";
  }

  $messageId = getRecord($specialId, 'SPECIAL_ID', 'DIR_MESSAGES', $dbc)['MESSAGE_ID'];

  try {
    $stmt = $dbc->prepare("INSERT INTO DIR_MESSAGES_USERS(MESSAGE_ID, SENDER_ID, RECEIVER_ID) VALUES(?,?,?)");
    $stmt->execute(array($messageId, $sender, $receiverRecord['USER_ID']));
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> FAILD TO inser data into DIR_MESSAGES_USERS";
  }
  echo "success";
}

 ?>
