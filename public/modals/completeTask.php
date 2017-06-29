<?php
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';

$taskId = $_POST['taskId'];

try {
  $stmt = $dbc->prepare("UPDATE TASKS SET IS_COMPLETE = 1 WHERE TASK_ID = ?");
  $stmt->execute(array($taskId));
  echo 'success';
} catch (PDOException $e) {
  echo $e->getMessage()."<br>failed to alter TASKS";
}


 ?>
