<?php
function renderPage($template, $color) {
  $pageLoc = $template;
  $pageCol = $color;
  require '../lib/connectplotr.php';
  require_once 'head-nav.php';
  require_once 'views/'.$template.".php";
  require_once 'foot.php';
}

function renderNav() {
  if(!isset($_SESSION['user_id'])) {
    $nav = '<ul class="header__nav">
              <li><a href="index.php" class="nav__link" id="home">Home</a></li>
              <li><a href="index.php?page=register" class="nav__link" id="register">Join</a></li>
            </ul>';
  }
  else {
    $nav = '
            <ul class="header__nav">
              <li><a href="index.php?page=proj_list" class="nav__link" id="proj_list">Projects</a></li>
              <li><a href="index.php?page=team" class="nav__link" id="team">Team</a></li>
              <li><a href="index.php?page=profile" class="nav__link" id="profile">Profile</a></li>
              <li><a href="index.php?page=messages" class="nav__link" id="messages">Messages</a></li>
            </ul>';
  }
  echo $nav;
}
 ?>
