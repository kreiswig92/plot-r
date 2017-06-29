<?php
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';
$userData = getRecord($_POST['member'], 'USER_ID', 'PLOT_USERS', $dbc);
$userName = $userData['FNAME'].' '.$userData['LNAME'];
$teamId = $_POST['teamId'];
 ?>

<div class="detail__header">
  <img src="../images/riverme.png" alt="" class="detail__img">
  <div class="detail__title">
    <h2 class="page__title"><?php echo $userName; ?></h2>
    <p class="page__subtitle"><?php echo $userData['UNAME']; ?></p>
  </div>
</div>

<div class="adder user__message">
  <div class="adder__heading"><i class="fa fa-envelope-o adder__icon" aria-hidden="true"></i><p>Message</p></div>
</div>

<div class="adder__modal" id="messageModal">
  <form  action="" method="" id="messageForm" class="page__form">
    <h3>Send a message to <?php echo $userName; ?></h3>
    <input type="hidden" id="teamId" value=<?php echo $teamId; ?>>
    <input type="hidden" id="recId" value=<?php echo $userData['USER_ID']; ?>>
    <label for="subject">Subject:</label><input type="text" name="subject" id=mesSubj><br>
    <label for="content">Message:</label><br><textarea name="content" rows="8" cols="25" id="mesCont"></textarea>
    <input type="submit" value="Send" id="subMes">
  </form>
</div>

<script src="../scripts/messageUser.js"></script>
