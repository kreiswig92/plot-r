<?php
require 'requires/render_functions.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION = array();
SESSION_DESTROY();
renderPage('home', 'teal');
 ?>
