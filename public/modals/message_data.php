<?php
function getMessages($userId, $dbc) {
  try {
    $stmt = $dbc->prepare("SELECT du.SENDER_ID, du.RECEIVER_ID, m.MESSAGE_ID, m.MESSAGE_TM, m.MESSAGE_SUBJECT, m.MESSAGE_CONTENT, m.IS_IMPORTANT, m.IS_INVITE
                           FROM DIR_MESSAGES_USERS AS du JOIN DIR_MESSAGES AS m USING(MESSAGE_ID)
                           WHERE du.RECEIVER_ID = ?");
    $stmt->execute(array($userId));
  } catch (PDOException $e) {
    echo $e->getMessage().'<br>at getMessages';
  }
  return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function buildMessageModule($messageData, $dbc) {
   $senderId = $messageData['SENDER_ID'];
   $senderName = getRecord($senderId, 'USER_ID', 'PLOT_USERS', $dbc)['UNAME'];
   $titleClass = ($messageData['IS_INVITE'] ? 'invite__module' : '');

  $module = "<a class='small__module message__module' id={$messageData['MESSAGE_ID']}>";
  $module .='<h2 class="module__title--small message__subject '.$titleClass.'">'.$messageData['MESSAGE_SUBJECT'].'</h2>';
  $module .= '<p class="module__subtitle--small message__sender">From: '.$senderName.'</p>';
  $module .= '</a>';
  return $module;
}
 ?>
