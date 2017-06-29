<?php
$messages = getMessages($_SESSION['user_id'], $dbc);
 ?>

<div class="page__content">
  <div class="sidebar sidebar--mesages">
    <h2 class="sidebar__title">Messages</h2>

    <?php
      foreach ($messages as $key => $val) {
        $module = buildMessageModule($val, $dbc);
        echo $module;
      }
     ?>
  </div> <!--end sidebar-->

  <div class="member__detail message__detail sidebar__clear">

  </div>
</div>

<script src="../scripts/sidebar.js"></script>
<script src="../scripts/messageSelect.js"></script>
