<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../lib/connectplotr.php';
require_once "requires/render_functions.php";
require_once "requires/helpers.php";
require_once "modals/team_data.php";
require_once "modals/message_data.php";
require_once "modals/project_data.php";

if(!isset($_GET['page']) || $_GET['page'] == 'home') {
  if(isset($_SESSION['user_id'])) {
    renderPage('proj_list', 'teal');
  }
  else {
    renderPage('home', 'teal');
  }
}
else if($_GET['page'] === 'register') {
  renderPage('register', 'teal');
}
else if($_GET['page'] === 'proj_list') {
  renderPage('proj_list', 'teal');
}
else if($_GET['page'] === 'proj_detail') {
  renderPage('proj_detail', 'teal');
}
else if($_GET['page'] === 'team') {
  if(hasTeam($_SESSION['user_id'], $dbc)) {
    renderPage('team', 'teal');
  }
  else {
    renderPage('team_admin', 'teal');
  }
}
else if($_GET['page'] === 'profile') {
  renderPage('profile', 'teal');
}
else if($_GET['page'] === 'team_admin') {
  renderPage('team_admin', 'teal');
}
else if($_GET['page'] === 'messages') {
  renderPage('messages', 'teal');
}
?>
