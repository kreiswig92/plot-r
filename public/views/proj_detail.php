<?php
$projectName = $_GET['projName'];
$projectRecord = getRecord($projectName, 'TITLE', 'PROJECTS', $dbc);

if(!hasTasks($projectRecord['PROJECT_ID'], $dbc)) {
  $headerText = 'No Current Tasks';
}
else {
  $compPer = calcCompletion($projectRecord['PROJECT_ID'], $dbc);
  $headerText = $compPer.'% complete';
  $tasks = getTasks($projectRecord['PROJECT_ID'], $dbc);
}
 ?>

<div class="page__content">
  <div class="page__section page__section--fill fill--slim p-detail__fill-a">
    <div class="section__filter">
      <h1 class="page__title title--centered heading heading--light"><?php echo ucwords( str_replace( '_', ' ',$_GET['projName'] ) ); ?></h1>
    </div>
  </div>

  <div class="section__clear--slim"></div>

  <div class="project__detail">
    <h2 class="detail__title page__title"><?php echo $headerText ?></h2>
    <div class="task__adder adder">
      <div class="adder__heading"><i class="fa fa-plus adder__icon" aria-hidden="true"></i><p>New Task</p></div>
    </div>

    <?php
      foreach ($tasks as $key => $val) {
        $module = buildTaskModule($val, $dbc);
        echo $module;
      }
     ?>

    <!-- <div class="project__module">
      <div class="module__header" href="index.php?page=proj_detail&projName=website_redesign">
      <div class="module__title">
        <h2>Mockup UI</h2>
        <p>Due: 10/30/17</p>
        <a href="" class="task__completer button">Complete</a>
      </div>

      </div>
      <div class="module-comment">
        <div class="comment__header">
          <h2 class="module-task__title">Member Wrote:</h2>
          <p class="module-task__subtitle">09/06/17</p>
        </div>
        <p class="module__text">This is taking too long, Lets give up?</p>
        <a href="" class="reply__link">reply</a>
        <div class="comment__reply">
          <p class="reply__header">Member replied</p>
          <p class="reply__header">09/05/17</p>
          <p class="module__text">I think we should keep going.</p>
        </div>

        <div class="comment__reply">
          <p class="reply__header">Member replied</p>
          <p class="reply__header">09/05/17</p>
          <p class="module__text">agree lets push through</p>
        </div>
      </div>

      <div class="module-comment">
        <div class="comment__header">
          <h2 class="module-task__title">Member Wrote:</h2>
          <p class="module-task__subtitle">09/06/17</p>
        </div>
        <p class="module__text">This is taking too long, Lets give up?</p>
        <a href="" class="reply__link">reply</a>
        <div class="comment__reply">
          <p class="reply__header">Member replied</p>
          <p class="reply__header">09/05/17</p>
          <p class="module__text">I think we should keep going.</p>
        </div>

        <div class="comment__reply">
          <p class="reply__header">Member replied</p>
          <p class="reply__header">09/05/17</p>
          <p class="module__text">agree lets push through</p>
        </div>
      </div>

    </div>

  </div> -->

</div>

<div class="adder__modal">
  <form class="page__form" id="addTaskForm">
    <label for="name">Name</label><input type="text" name="name" id="taskName">
    <label for="due">Due:</label><input type="text" name="due" value="" id="taskDue">
    <label for="milestone">Make Milestone: </label>
    <select class="" name="mileston" id="taskMilestone">
      <option value="0">No</option>
      <option value="1">Yes</option>
    </select>
    <input type="hidden" id="projectId" value=<?php echo $projectRecord['PROJECT_ID'] ?>>
    <input type="submit" name="sub" value="Add Task" id='subTask'>
  </form>
</div>
<script src="scripts/addTask.js"></script>
<script src="scripts/completeTask.js"></script>
