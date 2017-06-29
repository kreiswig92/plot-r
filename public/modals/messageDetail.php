<?php
SESSION_START();
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';
$messageId = $_POST['messageId'];

try {
  $stmt = $dbc->prepare("SELECT du.SENDER_ID, m.MESSAGE_TM, m.MESSAGE_CONTENT, m.MESSAGE_SUBJECT, m.IS_INVITE, m.TEAM_SENDING
                         FROM DIR_MESSAGES_USERS AS du JOIN DIR_MESSAGES AS m USING(MESSAGE_ID)
                         WHERE m.MESSAGE_ID = ? ");
  $stmt->execute(array($messageId));
} catch (PDOException $e) {
  echo $e->getMessage().'<br> Faild to select message';
}

$message = $stmt->fetch(PDO::FETCH_ASSOC);
$senderData = getRecord($message['SENDER_ID'], 'USER_ID', 'PLOT_USERS', $dbc);
$senderName = $senderData['FNAME']." ".$senderData['LNAME'];
$senderId = $senderData['USER_ID'];
$teamName = getRecord($message['TEAM_SENDING'], 'TEAM_ID', 'TEAMS', $dbc)['TEAM_NAME'];
$subject = $message['MESSAGE_SUBJECT'];
$reSubject = 'RE:'.$subject;
 ?>

<div class="detail__header">
  <div class="detail__title">
    <h2 class="page__title"><?php echo $message['MESSAGE_SUBJECT']; ?></h2>
    <p class="page__subtitle">From: <?php echo $senderName; ?>, Team: <?php echo $teamName; ?></p>
  </div>
</div>

<div class="detail__content message__content">
  <?php echo $message['MESSAGE_CONTENT']; ?>
</div>

<?php
if($message['IS_INVITE']) {
 ?>
 <div class="message__actions">
   <a href="#" class="button button--green" id="inviteAcpt">Accept</a>
   <a href="#" class="button" id="inviteDec">Decline</a>
 </div>
 <script src="../scripts/inviteActions.js"></script>
 <?php
}
else {
  ?>
  <div class="message__actions">
    <a href="#" class="button button--green" id="messageRep">Reply</a>
    <a href="#" class="button" id="messageDel">Delete</a>
  </div>
  <script src="../scripts/messageActions.js"></script>
<?php } ?>

<form class="" action="post" method="">
  <input type="hidden" name="team_id" id='teamId' value=<?php echo $message['TEAM_SENDING']; ?>>
  <input type="hidden" id="senderId" value=<?php echo $senderId; ?>>
  <input type="hidden" name="user_id" id='userId' value=<?php echo $_SESSION['user_id']; ?>>
  <input type="hidden" name="message_id" id='messageId' value=<?php echo $messageId; ?>>
</form>

<div class="adder__modal" id="messageModal">
  <form  action="" method="" id="messageForm" class="page__form">
    <h3>Reply To <?php echo $senderName; ?></h3>
    <label for="subject">Subject:</label><input type="text" name="subject" id=mesSubj value=<?php echo $reSubject; ?>><br>
    <label for="content">Message:</label><br><textarea name="content" rows="8" cols="25" id="mesCont"></textarea>
    <input type="submit" value="Send" id="subMes">
  </form>
</div>
