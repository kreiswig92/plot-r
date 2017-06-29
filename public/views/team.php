<?php
if(!isset($_GET['teamId'])) {
  redirect('index.php?page=team_admin');
}
else {
  $teamId = $_GET['teamId'];
  $teamData = getRecord($teamId, 'TEAM_ID', 'TEAMS', $dbc);
  $teamName = $teamData['TEAM_NAME'];

  $teamMembers = getMembers($teamId, $dbc);
}

?>
<div class="page__content">

  <div class="sidebar sidebar--team">
    <h2 class="sidebar__title"><?php echo $teamName;?></h2>

    <?php
      foreach ($teamMembers as $key => $val) {
        if($val['USER_ID'] !== $_SESSION['user_id']){
          $member = buildMemberModule($val);
          echo $member;
        }
      }
     ?>

    <!-- <a class="small__module member__module member__module--selected" href="">
      <img src="../images/riverme.png" alt="picture of team member" class="member__image">
      <h2 class="module__title--small member__name">Member Name</h2>
      <p class="module__subtitle--small member__title">Graphic Designer</p>
    </a>

    <a class="small__module member__module" href="">
      <img src="../images/riverme.png" alt="picture of team member" class="member__image">
      <h2 class="module__title--small member__name">Member Name</h2>
      <p class="module__subtitle--small member__title">Graphic Designer</p>
    </a>

    <div class="small__module member__module">
      <img src="../images/riverme.png" alt="picture of team member" class="member__image">
      <h2 class="module__title--small member__name">Member Name</h2>
      <p class="module__subtitle--small member__title">Graphic Designer</p>
    </div>

    <div class="small__module member__module">
      <img src="../images/riverme.png" alt="picture of team member" class="member__image">
      <h2 class="module__title--small member__name">Member Name</h2>
      <p class="module__subtitle--small member__title">Graphic Designer</p>
    </div>

    <div class="small__module member__module">
      <img src="../images/riverme.png" alt="picture of team member" class="member__image">
      <h2 class="module__title--small member__name">Member Name</h2>
      <p class="module__subtitle--small member__title">Graphic Designer</p>
    </div>

    <div class="small__module member__module">
      <img src="../images/riverme.png" alt="picture of team member" class="member__image">
      <h2 class="module__title--small member__name">Member Name</h2>
      <p class="module__subtitle--small member__title">Graphic Designer</p>
    </div>

    <div class="small__module member__module">
      <img src="../images/riverme.png" alt="picture of team member" class="member__image">
      <h2 class="module__title--small member__name">Member Name</h2>
      <p class="module__subtitle--small member__title">Graphic Designer</p>
    </div>

    <div class="small__module member__module">
      <img src="../images/riverme.png" alt="picture of team member" class="member__image">
      <h2 class="module__title--small member__name">Member Name</h2>
      <p class="module__subtitle--small member__title">Graphic Designer</p>
    </div>

    <div class="small__module member__module">
      <img src="../images/riverme.png" alt="picture of team member" class="member__image">
      <h2 class="module__title--small member__name">Member Name</h2>
      <p class="module__subtitle--small member__title">Graphic Designer</p>
    </div> -->

  </div> <!--end sidebar-->

  <div class="member__detail sidebar__clear">

    <!-- <div class="detail__header">
      <img src="../images/riverme.png" alt="" class="detail__img">
      <div class="detail__title">
        <h2 class="page__title">Member Name</h2>
        <p class="page__subtitle">Member title</p>
      </div>
    </div>

    <div class="adder user__message">
      <div class="adder__heading"><i class="fa fa-envelope-o adder__icon" aria-hidden="true"></i><p>Message</p></div>
    </div>

    <div class="user__activity">
      <div class="activity__module">

        <div class="module__header activity__header">
          <h2 class="module__title">Member commented on task</h2>
          <p class="module__subheader">02/17/18</p>
          <p class="activity__content">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
            enim ad minim veniam, quis nostrud exercitation ullamco laboris
            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
            in reprehenderit in voluptate velit esse cillum dolore eu fugiat
            nulla pariatur. Excepteur sint occaecat cupidatat non proident,
            sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </div>

      </div>


    </div> -->

  </div>

</div> <!--end of page__content-->

<script src="../scripts/sidebar.js"></script>
<script src="../scripts/memberSelect.js"></script>

<form class="" action="" method="">
  <input type="hidden" id="teamId" value=<?php echo $teamId; ?>>
</form>
