<?php
// Contains functions concerning retreival and insertation of team data
//require_once '../lib/connectplotr.php';


// Takes a USER_ID, Checks if user is associated with a team
//returns true or false
function hasTeam($user, $database) {
  try {
    $stmt = $database->prepare("SELECT * FROM USERS_TEAMS WHERE USER_ID = ?");
    $stmt->execute(array($user));
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> FAILD TO QUERY USER_TEAMS";
  }

  if($stmt->rowCount() >  0) {
    return true;
  }
  return false;
}


//Selects all teams inwhich the passed user_id is a member of
//returns records
function getTeams($user_id, $dbc) {
  try {
    $stmt = $dbc->prepare("SELECT u.USER_ID, u.IS_ADMIN, t.TEAM_NAME, t.TEAM_ID, t.USER_CREATED, t.REGISTRATION_TM
                           FROM USERS_TEAMS AS u JOIN  TEAMS AS t USING(TEAM_ID)
                           WHERE u.USER_ID = ?");
    $results = $stmt->execute(array($user_id));
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> FAILD TO SELECT USERS TEAMS, getTeams";
  }
  return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function isTeamMember($userId,$teamId, $dbc) {
  $usersTeams = getTeams($userId, $dbc);
  foreach ($usersTeams as $key => $val) {
    if($val['TEAM_ID'] == $teamId) {
      return true;
    }
  }
  return false;
}


//Takes a single array of results created by getTeams function above.
//Function returns a single module based on data
//Can only take a single record of team data, if the user belongs to multiple teams the function must be called for each team
function buildTeamModule($teamData, $dbc) {
  $moduleNote = ($teamData['IS_ADMIN'] ? "<i class='fa fa-unlock module__note col-good' aria-hidden='true'></i>\n"  : "<i class='fa fa-lock module__note col-error' aria-hidden='true'></i>\n");
  $creator = ($teamData['USER_CREATED'] == $_SESSION['user_id'] ? 'You' : getRecord($teamData['USER_CREATED'], 'USER_ID', 'PLOT_USERS', $dbc)['UNAME']);


  $module = "<div class='project__module'>\n";
  $module .= "<a href='index.php?page=team&teamId={$teamData['TEAM_ID']}' class='module__header'>
              <div class='module__title'><h2 href=''>".$teamData['TEAM_NAME']."</h2></div>\n".
              $moduleNote."</a>\n";
  $module .= "<span class='module__subheader'>Created by <span class='col-error'>".$creator."</span> on ".date('M j Y', strtotime($teamData['REGISTRATION_TM']))."</span><br>";
  $module .= "<span class='module__subheader'></span>";
  $module .= "</div>\n"; //end project__module
  return $module;
}

//returns
function getMembers($teamId, $dbc) {
  try {
    $stmt = $dbc->prepare("SELECT u.USER_ID, u.FNAME, u.LNAME, u.UNAME, ut.IS_ADMIN
                           FROM USERS_TEAMS AS ut JOIN PLOT_USERS as u USING(USER_ID)
                           WHERE ut.TEAM_ID = ?
                           ORDER BY u.FNAME");
    $stmt->execute(array($teamId));
  } catch (PDOException $e) {
    echo $e->getMessage()."<br>FAILD TO SELECT USERS IN TEAM";
  }

  return $stmt->fetchall(PDO::FETCH_ASSOC);
}


function buildMemberModule($memberData) {
  $module = "<a class='small__module member__module' id={$memberData['USER_ID']}>";
  $module .="<img src='../images/riverme.png' alt='picture of team member' class='member__image'>";
  $module .='<h2 class="module__title--small member__name">'.$memberData['FNAME'].' '.$memberData['LNAME'].'</h2>';
  $module .= '<p class="module__subtitle--small member__title">'.$memberData['UNAME'].'</p>';
  $module .= '</a>';
  return $module;
}

//function countMembers($teamId)
 ?>
