<?php
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';
$name = $_POST['name'];
$due = $_POST['due'];
$team = $_POST['team'];

if(inTable($name, 'TITLE', 'PROJECTS', $dbc)) {
  echo "used";
}
else {
  try {
    $stmt= $dbc->prepare("INSERT INTO PROJECTS(TITLE, COMPLETION_TARGET,TEAM_ID) VALUES(?,?,?)");
    $stmt->execute(array($name, $due, $team));
    echo 'success';
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> FAILED TO insert data";
  }
}
?>
