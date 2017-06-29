<?php
require '../lib/connectplotr.php';

 if(isset($_SESSION['user_id']) && hasTeam($_SESSION['user_id'], $dbc)) {

?>
<div class="page__section page__section--fill fill--slim admin__fill-friends">
  <div class="section__filter">
    <h1 class="page__title title--centered heading heading--light">Your Teams</h1>
  </div>
</div>
<div class="section__clear--slim"> </div>

<div class="adder__split">
  <div class="team__adder adder">
    <div class="adder__heading"><i class="fa fa-plus adder__icon" aria-hidden="true"></i><p>Create Team</p></div>
  </div>
  <div class="team__invite adder">
    <div class="adder__heading"><i class="fa fa-plus adder__icon" aria-hidden="true"></i><p>Invite to join</p></div>
  </div>
</div>

<?php
  $teams = getTeams($_SESSION['user_id'], $dbc);
  foreach ($teams as $key => $val) {
    $module = buildTeamModule($val, $dbc);
    echo $module;
  }
 ?>

<?php
}
else{
?>
<div class="page__section page__section--fill fill--slim admin__fill-alone">
  <div class="section__filter">
    <h1 class="page__title title--centered heading heading--light">Join a Team</h1>
  </div>
</div>
<div class="section__clear--slim"> </div>

<h2 class="page__status">You are currently not a member of any teams, join or create a team below!</h2>

<div class="adder__split">
  <div class="team__adder adder">
    <div class="adder__heading"><i class="fa fa-plus adder__icon" aria-hidden="true"></i><p>Create Team</p></div>
  </div>
  <div class="team__invite adder">
    <div class="adder__heading"><i class="fa fa-plus adder__icon" aria-hidden="true"></i><p>Join Team</p></div>
  </div>
</div>

<h2 class="page__status page__status-small">I have nothing else to say... Join a team :)</h2>

<?php } ?>

<div class="adder__modal" id="teamAddModule">
  <form class="page__form" action="" method="" id="addTeamForm">
    <label for="name">Team-Name:</label><input type="text" name="name" id="teamName">
    <input type="submit" name="sub" value="Create Team" id='subTeam'>
  </form>
</div>

<div class="adder__modal" id="teamInviteModule">
  <form class="page__form" action="" method="" id="inviteTeamForm">
    <label for="email">User-email: </label><input type="text" name="email" id="userEmail">
    <label for="team">Invite to Team: </label>
    <select name="team" id='inviteTeam'>
      <?php
      foreach ($teams as $key => $val) {
        echo '<option value="'.$val['TEAM_ID'].'">'.$val['TEAM_NAME'].'</option>';
      }
      ?>
    </select>
    <label for="admin">Make Admin</label>
    <select  name="admin" id='makeAdmin'>
      <option value="0">No</option>
      <option value="1">Yes</option>
    </select>
    <input type="submit" name="sub" value="Invite" id='subInvite'>
  </form>
</div>

<script src="scripts/createTeam.js"></script>
<script src="scripts/inviteMember.js"></script>
