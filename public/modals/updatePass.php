<?php
SESSION_START();
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';
$curPass = $_POST['curPass'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$userRecord = getRecord($_SESSION['user_id'], 'USER_ID', 'PLOT_USERS', $dbc);
$salt = $userRecord['SALT'];

$hashedPass = hash("sha512", $curPass.$salt);

if($hashedPass == $userRecord['PASSWORD']) {

  if(!empty($pass1) && !empty($pass2) && $pass1 == $pass2) {
    $newHash = hash('sha512', $pass1.$salt);

    try {
      $stmt = $dbc->prepare("UPDATE PLOT_USERS
                             SET PASSWORD = ?
                             WHERE USER_ID = ?");
      $stmt->execute(array($newHash, $userRecord['USER_ID']));
      echo 'success';
    } catch (PDOException $e) {
      echo $e->getMessage()."Faild to update password";
    }

  }
  else {
    echo "empty";
  }
}
else {
  echo "wrong";
}
?>
