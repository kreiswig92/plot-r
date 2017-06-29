<?php
SESSION_START();
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';
$flag = true;
$name = $_POST['name'];
$user_id = $_SESSION['user_id'];

try{
$sql = "CREATE TABLE IF NOT EXISTS TEAMS(
          TEAM_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
          TEAM_NAME VARCHAR(256),
          USER_CREATED INT,
          REGISTRATION_TM TIMESTAMP
          );";
$dbc->exec($sql);
}catch (PDOException $e) {
echo $e->getMessage()."<br> FAILED TO CREATE TABLE";
}

if(!inTable($name, 'TEAM_NAME', 'TEAMS', $dbc) && !empty($name)) {
  try {
    $sql="INSERT INTO TEAMS(TEAM_NAME, USER_CREATED, REGISTRATION_TM) VALUES('$name', '$user_id', default)";
    $dbc->exec($sql);
  } catch (PDOException $e) {
    //echo $e->getMessage()."<br> FAILED TO insert data";
    echo 'failed';
    $flag = false;
  }

  $teamRecord = getRecord($name, 'TEAM_NAME', 'TEAMS', $dbc);
  $team_id = $teamRecord['TEAM_ID'];

  try {
    $sql="INSERT INTO USERS_TEAMS(USER_ID, TEAM_ID, IS_ADMIN) VALUES('$user_id', '$team_id', 1)";
    $dbc->exec($sql);
  } catch (PDOException $e) {
    echo $e->getMessage().'<br> FAILED TO INSERT DATA INTO USERS_TEAMS';
    $flag = false;
  }

  if($flag) {
    echo 'success';
  }
}
else {
  if(inTable($name, 'TEAM_NAME', 'TEAMS', $dbc)){
    echo 'used';
  }
  if(empty($name)) {
    echo 'blank';
  }
}

 ?>
