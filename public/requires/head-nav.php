<?php
$flag = false;

if( !empty($_POST['uname']) && !empty($_POST['pass']) ) {
  $uname = $_POST['uname'];
  $pass = $_POST['pass'];

  $feild = 'UNAME';
  $table = 'PLOT_USERS';

  if( inTable( $uname, $feild, $table, $dbc ) ) {
  $salt = getSalt( $uname, $dbc );
  $hashedPass = hash( "sha512", $pass.$salt );
  $flag = true;
}//end if in-table
}//end if empty uname/pass

if($flag) {
  $record = getRecord($uname, $feild, $table, $dbc);
  $passStore = $record['PASSWORD'];
  if($hashedPass == $passStore) {
    $_SESSION['uname'] = $uname;
    $_SESSION['user_id'] = $record['USER_ID'];
  }
}
?>



<!DOCTYPE html>
<html>
  <head>
    <script src="https://use.fontawesome.com/4b1425c147.js"></script> <!--fontawesome-->
    <meta charset="utf-8">
    <title>PLOT-R-<?php echo $pageLoc ?></title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700|Nunito:200,400,900" rel="stylesheet">
    <link rel="stylesheet" href="../bower_components/jquery-ui/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/head-nav_main.css">
    <link rel="stylesheet" href="styles/forms_main.css">
    <link rel="stylesheet" href="styles/modals.css">

    <!-- Color specific CSS added here -->
    <?php
      if(isset($pageCol)) {
     ?>

    <link rel="stylesheet" href="styles/forms_<?php echo $pageCol ?>.css">
    <link rel="stylesheet" href="styles/head-nav_<?php echo $pageCol ?>.css">
    <?php } ?>

    <!-- End of color specific CSS -->

    <!-- Page specific CSS added here -->
    <?php
    if($pageLoc == 'home') {
      echo "<link rel='stylesheet' href='styles/home_main.css'>";
    }
    if($pageLoc == 'register') {
      echo "<link rel='stylesheet' href='styles/register_main.css'>";
    }
    if($pageLoc == 'proj_list') {
      echo "<link rel='stylesheet' href='styles/proj_list_main.css'>";
    }
    if($pageLoc == 'proj_detail') {
      echo "<link rel='stylesheet' href='styles/proj_detail.css'>";
    }
    if($pageLoc == 'team' || $pageLoc == 'team_admin' || $pageLoc === 'messages') {
      echo "<link rel='stylesheet' href='styles/team.css'>";
    }
     ?>
    <!--End of page specific CSS  -->

    <script src="../bower_components/jquery/dist/jquery.js"></script> <!--jquery-->
    <script src="../bower_components/jquery-ui/jquery-ui.js"></script> <!--jquery-ui-->

  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1 class="heading header__title">PLOT-R</h1>

        <?php renderNav() ?> <!--nav gets rendered based on if user is logged in -->

        <div class="header__login" id="log">
          <?php if(!isset($_SESSION['uname'])) { ?>
          <form class="header__form login__form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="log__form">
            <!-- Gender Neutral User icon by Icons8 -->
            <img class="login__icon" width="48" height="48" alt="login"           src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAB+ElEQVRoQ+2Y/TEEQRDF30VABogAESACRIAMiAARIAJEgAgQARkQAhFQP2bU1lbt7sx0732omaqr++OuZ957/brnY6IFH5MFx69KYNYZrBn4jxnYlrQrie+NBsEdSU/ehD0ttCzpQtJhB0jAn0h69SThRQDwjy3Fu3BC5NwrG14ErnuU7yJyJOnGmg0PAvj8pQDIh6RNSe8FsX8hHgRQ8aAQxJWk48LYnzAPAqjf7DY5eChoslA8PAh8Fa/+G2jCYAoOwBeeAMW4ZMiCSURTcABNX98qJPAcduzCcKP/wqqWLjQXBM4knRZKyI5MfPHwsNCepLtCBGvzsJGBnd10JZOEeRMz9+AGYDYyijm1Gz2EsxMdzDQ8LBQBQIKCXh9A5KJ8XMOTQJyTmuDDhQZbfYY7ADajYE2Ht7Y4YxAwWSI3uBLIVcz7/zUDQVHuxJyHmi8Rq5L4xH0iFi93AFoux4iZt1FuYtyoLBeaS0m3pdYqtRDAaYlR4dL1Y1xssdlEcgkAmBcIrDLGwFr7OdbKIYBNePvB72MO6oJXvKQHsFQC0wIfhUkmkUIAxd+moHw7q5DguN3bqVIIYJuxPD9kxftQE53/SyFgfXUYAjn0ey/GSmBIPoffawYcRBxvipQaGG91h5krAQcRTVPUDJjkcwiuGXAQ0TTFN8qwRjFUT4dkAAAAAElFTkSuQmCC">
            <input type="text" name="uname"  id="log__uname">
            <img class="login__icon" width="48" height="48" alt="password" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAACOUlEQVRoQ+2Z8TEFMRDGv1cBKkAHdEAFdIAKUAEqQAXogArogA5QASpgfiOZOTvnXrLJO3Mj+9eNl0322/12N1kzTVxmE7dfDcBfR7B2BJYl7UjalbQmaSMAfJL0IulW0p2k91rAawHA8ENJR5L4HhKMv5B0WQNIDQB4+T7BcAsKINuSiI5bSgHsS7pyn/6teCDp2rtHCQA8/9hz8EcwCL4/hN+3Ql4AeKlHZ9MbCS8AeP7cQ5ubkAe/JSl68H/PgGD9uicnvAAwgqTtynEwLoUNp5JOzMIzSfw9SzwA8OKbOQXPQ48cgfc2Eiu5UfAAsIkL56n5ubUdR9AbujmRndAeACQnzSqKK/RB2VKRJkcTTBYPACpP7LAcRC2P1Sb54E51oodEoSdQkZLFA+DT7O7Zo7tF0X6ew4sO7HFt0X7/BgBV5jxwn+9FCpWJXKCv8D0oKRHAYBJ33i1z3lm5v1OWSehBECkAbNnMNaRk/dyymgKArju29yNovM8d6VdJAWCrRIlHPbqDNjYAHpdm6rQItBzIpIxdvhAKcYWOD3HeB/Z1hRG11lQH0Hf/t0/EWmtwRHUANBbb3rlu8MiPUmtNA4AHbBWqRY+UfRYSATaF80wiECYLfeOQWmuq50BhVcxWbwBaJ84mzU+FRqHJU4jHdd9Mv5AZSeqvYe5a9KSc/KOeew5zmrGjwNSbGWzxWIXwAYJJMhuuJgXfvwja4DD+41llsOU3ZQTNlKnECGb4j2gA/L6ro/kF28WBMd1WKdMAAAAASUVORK5CYII=">
            <input type="password" name="pass" id="log__pass">
            <input type="submit" name="submit" value="login">
          </form>
          <?php
        }
          else {
            echo "<p class='log_status'>Hello {$_SESSION['uname']}, not you? <a href='logout.php'>Logout</a></p>";
          }
           ?>
        </div>

      </div> <!--end header-->

      <!--FOLLOWING SCRIPT SETS THE ACTIVE NAVAGATION ELEMENT -->
      <script>
        $(document).ready(function() {
          var curPage = "#" + <?php echo "'".$pageLoc."'" ?>;
          $(curPage).addClass('active');
          if(curPage == '#team_admin') {
            $('#team').addClass('active');
          }
          if(curPage == '#proj_detail') {
            $('#proj_list').addClass('active');
          }
        });
      </script>
