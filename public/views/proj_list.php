<?php
$teams = getTeams($_SESSION['user_id'], $dbc);

 ?>

<div class="page__content">
  <div class="page__section page__section--fill fill--slim proj__fill-a">
    <div class="section__filter">
      <h1 class="page__title title--centered heading heading--light">Your Projects</h1>
    </div>
  </div>
  <div class="section__clear--slim"> </div>

  <div class="project__adder adder">
    <div class="adder__heading"><i class="fa fa-plus adder__icon" aria-hidden="true"></i><p>Add a project</p></div>
  </div>
<div class="select__container">
  <label for="team__selector">Select Team: </label>
  <select class="team__selector" name="team__selector" id="selectTeam">
    <?php
    foreach ($teams as $key => $val) {
      echo "<option value=".$val['TEAM_ID'].">".$val['TEAM_NAME']."</option>";
    }
     ?>
  </select>
</div>

<div id="projectList">

</div>


  <!-- <div class="project__module">
    <a class="module__header" href="index.php?page=proj_detail&projName=website_redesign">
    <div class="module__title"><h2>Website Redesign</h2></div>
      <span class="module__subheader">Started: 09/15/17</span>
    </a>
    <a href =""class="module-task">
      <h2 class="module-task__title">Mockup UI</h2>
      <span class="module-task__status">On-Time</span>
      <span class="module-task__update">Last Updated: 09/23/17</span>
      <span class="mudule-task__comments">5 comments</span>
    </a>

    <a class="module-task" href="">
      <h2 class="module-task__title">Take Promo Photos</h2>
      <span class="module-task__status col-error">LATE!</span>
      <span class="module-task__update">Last Updated: 09/15/17</span>
      <span class="module-task__comments">30 comments</span>
    </a>

    <a class="module-task" href="">
      <h2 class="module-task__title">Develope Registration</h2>
      <span class="module-task__status col-good">Complete!</span>
      <span class="module-task__update">Last Updated: 09/28/17</span>
      <span class="mudule-task__comments">12 comments</span>
    </a>
  </div>

  <div class="project__module">
    <div class="module__header">
      <h2 class="module__title">Brand Development</h2>
      <span class="module__subheader">Started: 03/15/17</span>
    </div>
    <div class="module-task">
      <h2 class="module-task__title">Develope Print Mockups</h2>
      <span class="module-task__status">On-Time</span>
      <span class="module-task__update">Last Updated: 09/23/17</span>
      <span class="mudule-task__comments">5 comments</span>
    </div>

    <div class="module-task dark-row">
      <h2 class="module-task__title">Take Promo Photos</h2>
      <span class="module-task__status col-error">LATE!</span>
      <span class="module-task__update">Last Updated: 09/15/17</span>
      <span class="mudule-task__comments">30 comments</span>
    </div>

    <div class="module-task">
      <h2 class="module-task__title">Hire additional designers</h2>
      <span class="module-task__status col-good">Complete!</span>
      <span class="module-task__update">Last Updated: 09/28/17</span>
      <span class="mudule-task__comments">12 comments</span>
    </div>
  </div>
</div> -->

<div class="section__clear--slim"></div>

<div class="adder__modal">
  <form class="page__form" id="addProjectForm">
    <label for="name">Name</label><input type="text" name="name" id="projName">
    <label for="due">Due:</label><input type="text" name="due" value="" id="projDue">
    <label for="team">Team: </label>
    <select class="team__selector" name="team__selector" id='newProjTeam'>
      <?php
      foreach ($teams as $key => $val) {
        echo "<option value=".$val['TEAM_ID'].">".$val['TEAM_NAME']."</option>";
      }
       ?>
    </select>
    <input type="submit" name="sub" value="Add Project" id='subProj'>
  </form>
</div>

<script src="scripts/addProject.js"></script>
<script src="scripts/loadProjects.js"></script>
