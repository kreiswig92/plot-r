<?php
SESSION_START();
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';

$newFname = $_POST['fname'];
$newLname = $_POST['lname'];
$newEmail = $_POST['email'];
$user = $_POST['user'];

if(!empty($newFname) && !empty($newLname && !empty($newEmail))) {
  try {
    $stmt = $dbc->prepare("UPDATE PLOT_USERS
                           SET FNAME = ?,
                               LNAME = ?,
                               EMAIL = ?
                           WHERE USER_ID = ?");
    $stmt->execute(array($newFname, $newLname, $newEmail, $_SESSION['user_id']));
    echo 'success';
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> Could not alter user table";
  }

}
else {
  echo 'blank';
}

?>
