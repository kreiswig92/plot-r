<?php
require_once '../../lib/connectplotr.php';
require_once '../requires/helpers.php';
require_once 'project_data.php';

$teamId = $_POST['teamId'];
$projects = getProjects($teamId, $dbc);

foreach ($projects as $key => $val) {
  $module = buildProjectModule($val, $dbc);
  echo $module;
}
 ?>
