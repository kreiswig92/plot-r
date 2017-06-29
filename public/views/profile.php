<?php
echo $_SESSION['user_id'];
$userRecord = getRecord($_SESSION['user_id'], 'USER_ID', 'PLOT_USERS', $dbc);
$fname = $userRecord['FNAME'];
$lname = $userRecord['LNAME'];
$email = $userRecord['EMAIL'];
 ?>

<div class="page__content">
  <h1 class="page__title form__title">Edit Profile:</h1>
  <form  id = 'updateForm' class="page__form" action= '' method="">
    <img src="../images/riverme.png" class="form__image" alt=""><input type="file" name="" value="Change Profile Image">
    <input type="hidden" name="uid" id='uid' value=<?php echo $_SESSION['user_id'] ?>>
    <label for="fname">First Name: </label><input type="text" name="fname" id="fname" value=<?php echo $fname; ?>>
    <label for="lname">Last Name: </label><input type="text" name="lname" id="lname" value=<?php echo $lname; ?>>
    <label for="email">Email: </label><input type="text" name="email" id="email" value=<?php echo $email; ?>>
    <input type="submit" name="subInfo" value="Update" id="subInfo">
  </form>

  <!-- INSERT INTO MODAL -->
  <h1 class="page__title form__title">Change Password:</h1>
  <form id="passForm" class="page__form" action='' method="">
    <p class="formInfo">Passwords must have a capital letter, a number and a special character</p>
    <label for="cPass">Current Password: </label><input type="password"  id= 'curPass' name="cPass" value="">
    <label for="pass1">New Password: </label><input type="password" id='pass1' name="pass1" value="">
    <label for="pass2">Repeat Password: </label><input type="password" id='pass2' name="pass2" value="">
    <input type="submit" name="subPass" value="Update" id="subPass">
  </form>

<script src='../scripts/updateProfile.js'></script>
<script src='../scripts/updatePassword.js'></script>

</div>
