<?php
function hasTasks($projId, $dbc) {
  try {
    $stmt = $dbc->prepare("SELECT * FROM TASKS WHERE PROJECT_ID = ?");
    $stmt->execute(array($projId));
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> Faild to check for tasks";
  }
  $records = $stmt->fetchall(PDO::FETCH_ASSOC);
  if(count($records) !== 0) {
    return true;
  }
  else {
    return false;
  }
}

function getProjects($teamId, $dbc) {
  try {
    $stmt = $dbc->prepare("SELECT * FROM PROJECTS WHERE TEAM_ID = ?");
    $stmt->execute(array($teamId));
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> FAILD TO GET PROJECTS";
  }
  return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function getTasks($projId, $dbc) {
  try {
    $stmt = $dbc->prepare("SELECT * FROM TASKS WHERE PROJECT_ID = ?");
    $stmt->execute(array($projId));
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> FAILD TO GET TASK";
  }
  return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function getCompTasks($projId, $dbc) {
  try {
    $stmt = $dbc->prepare("SELECT * FROM TASKS WHERE PROJECT_ID = ? AND IS_COMPLETE = ?");
    $stmt->execute(array($projId, 1));
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> FAILD TO GET TASK";
  }
  return $stmt->fetchall(PDO::FETCH_ASSOC);
}



function buildProjectModule($projectData, $dbc) {
  $projName = $projectData['TITLE'];
  $dueDate = date("m-d-Y", strtotime($projectData['COMPLETION_TARGET']));

  $module = "<div class='project__module'>";
  $module .= "<a class='module__header' href='index.php?page=proj_detail&projName=".$projName."'>
                <div class='module__title'><h2>$projName</h2></div>
                <span class='module__subheader'>Due: $dueDate </span>
              </a>";

  if(hasTasks($projectData['PROJECT_ID'], $dbc)){
    $task = getTasks($projectData['PROJECT_ID'], $dbc);
    if(count($task) > 3) {
      for($i = 0; $i < 3; $i++) {
        $taskTime = ($task[$i]['COMPLETION_TARGET'] > $projectData['COMPLETION_TARGET'] ? 'On-time' : 'Late');
        $convertedDate = date("m-d-Y", strtotime($task[$i]['COMPLETION_TARGET']));
        $taskStatus = ($taskTime == 'On-time' ? 'col-good' : 'col-error');
        $module .= "<a class='module-task'>";
        $module .= "<span class='module-task__status $taskStatus'>$taskTime</span>";
        $module .= "<span class='module-task__due'>".$convertedDate."</span>";
        $module .= "<span class='module-task__comments'>0 Comments</span>";
      }
    }
    else {
      for($i = 0; $i < count($task); $i++) {
        $taskTime = ($task[$i]['COMPLETION_TARGET'] > date('yy-mm-dd') ? 'On-time' : 'Late');
        $convertedDate = date("m-d-Y", strtotime($task[$i]['COMPLETION_TARGET']));
        $taskStatus = ($taskTime == 'On-time' ? 'col-good' : 'col-error');
        $module .= "<a class='module-task'>";
        $module .= "<span class='module-task__title'>".$task[$i]['TASK_NAME']."</span>";
        $module .= "<span class='module-task__status $taskStatus'>Status: $taskTime</span>";
        $module .= "<span class='module-task__due'>Due: ".$convertedDate."</span>";
        $module .= "<span class='module-task__comments'>0 Comments</span>";
      }
    }
  }
  $module .="</div>";
  return $module;
}

function calcCompletion($projId, $dbc) {
  $tasks = getTasks($projId, $dbc);
  $compTask = getCompTasks($projId, $dbc);
  if(count($tasks) == 0) {
    $percent = 0;
  }
  else {
    $percent = ( count($compTask) / count($tasks) ) * 100;
  }
  return $percent;
}

function buildTaskModule($taskData, $dbc) {
  $milestoneClass = ($taskData['IS_MILESTONE'] ? 'milestone' : '');
  $dueDate = date("m-d-Y", strtotime($taskData['COMPLETION_TARGET']));

  if($taskData['IS_COMPLETE']) {
    $completer = "<p class='complete__task'>COMPLETE!!!</p>";
  }
  else {
    $completer = "<a href='' id=".$taskData['TASK_ID']." class='task__completer button'>Complete</a>";
  }

  $module = "<div class='project__module ".$milestoneClass."'>";
  $module .= "<div class='module__header'>";
  $module .= "<div class='module__title'>
                  <h2>".$taskData['TASK_NAME']."</h2>
                  <p class='module-task__subtitle'>DUE: ".$dueDate."</p>".$completer."

              </div>";
  $module .= "</div>";
  $module .= "</div>";
  return $module;
}
 ?>
