<?php
$flag = true;
$out = "";

if( !empty( $_POST['fname'] ) && isset($_POST['sub_reg']) ) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email1 = $_POST['email1'];
  $uname = $_POST['uname'];
  $pass1 = $_POST['pass1'];
  $pass2 = $_POST['pass2'];

  if( $pass1 !== $pass2) {
    $flag = false;
    $out .= "<br>The passwords did not match.";
  }//end if pass1 != pass2

  if( usedEmail($email1, $dbc, "PLOT_USERS") ) {
    $flag = false;
    $out .= "<br>That email has already been registered";
  }//end if used email

  if( usedUname($uname, $dbc, "PLOT_USERS") ) {
    $flag = false;
    $out .="<br>That username is taken";
  }

  if($flag) {
    $salt = time();
    $pass = hash( 'sha512', $pass1.$salt );

    try{
    $stmt = $dbc->prepare("INSERT INTO PLOT_USERS (FNAME, LNAME, UNAME, EMAIL, PASSWORD, SALT) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute(array($fname, $lname, $uname, $email1, $pass, $salt));
    }catch(PDOException $e){
      echo $e->getMessage()."<br> FAILD TO INSERT USER DATA";
    }
    $out = "You are registered!, Log-in above";
  }//end if flag

} //end if empty / isset

if(!isset($_SESSION['user_id'])) {
  ?>
  <div class="page__content">
    <?php echo '<h2>'.$out.'</h2>' ?>
    <h1 class="page__title form__title heading">Register:</h1>
    <form class="page__form reg__form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
      <p class="passInfo" id="passStructure">Pasword must contain a capital letter, a number, and a special character</p>
      <p class='passInfo' id="passMatch">passwords must match</p>
      <label for="fname">First Name: </label><input type="text" name="fname" class="laxVal">
      <label for="lname">Last Name: </label><input type="text" name="lname" class="laxVal">
      <label for="email1">E-mail: </label><input type="email" name="email1" id="email_validation">
      <label for="uname">Pick a Username: </label><input type="text" name="uname" class="laxVal">
      <label for="pass1">Password: </label><input type="password" name="pass1" class="pass" id="pass1_validation">
      <label for="pass2">Confirm Password: </label><input type="password" name="pass2" class="pass" id="pass2_validation">
      <input type="submit" name="sub_reg" value="Sign Up!">
    </form>
  </div>

 <?php
 }
 else {
 ?>
 <h1>Thank you for joining! Log in above</h1>

 <?php } ?>

 <script src="../scripts/regValidation.js"></script>
