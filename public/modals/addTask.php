<?php
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';
$name = $_POST['name'];
$due = $_POST['due'];
$milestone = $_POST['milestone'];
$projId = $_POST['projId'];

if(inTable($name, 'TASK_NAME', 'TASKS', $dbc)) {
  echo "used";
}
else {
  try {
    $stmt= $dbc->prepare("INSERT INTO TASKS(TASK_NAME, COMPLETION_TARGET,IS_MILESTONE, PROJECT_ID) VALUES(?,?,?,?)");
    $stmt->execute(array($name, $due, $milestone, $projId));
    echo 'success';
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> FAILED TO insert data";
  }
}
?>
