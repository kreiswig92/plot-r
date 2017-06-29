<?php
// Allows redirects after HTML headers have been sent
//pass page url
//requires that user isn't blocking Javascipt
function redirect($url)
{
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';

    echo $string;
}

function usedEmail($email, $dbc, $table) {
  try{
  $stmt = $dbc->prepare("SELECT * FROM $table WHERE EMAIL = ?");
  $stmt->execute(array($email));
}catch(PDOException $e) {
  echo $e->getMessage()."<br> FAILD TO CHECK FOR EXISTING EMAIL";
}

if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  return true;
}
return false;
}

function usedUname($uname, $dbc, $table) {
  try{
  $stmt = $dbc->prepare("SELECT * FROM $table WHERE UNAME = ?");
  $stmt->execute(array($uname));
}catch(PDOException $e) {
  echo $e->getMessage()."<br> FAILD TO CHECK FOR EXISTING EMAIL";
}

if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  return true;
}
return false;
}

function inTable($val, $feild, $table, $dbc) {
  try{
  $stmt = $dbc->prepare("SELECT * FROM $table WHERE $feild = ?");
  $stmt->execute(array($val));
}catch(PDOException $e) {
  echo $e->getMessage()."<br> FUNCTION inTable failed to search for value in table";
}

if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  return true;
}
return false;
}

function getSalt($uname, $dbc) {
  try {
    $stmt = $dbc->prepare("SELECT * FROM PLOT_USERS WHERE UNAME = ?");
    $stmt->execute(array($uname));
  } catch (PDOException $e) {
    echo $e->getMessage()."<br> FUNCTION getSalt failed to query the table";
  }
  If( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    return $row['SALT'];
  }
  else {
    echo "something went wrong...[54--salt]<br>";
  }
}

function getRecord( $val, $feild, $table, $dbc ) {
  try{
  $stmt = $dbc->prepare("SELECT * FROM $table WHERE $feild = ?");
  $stmt->execute(array($val));
  }catch(PDOException $e) {
    echo $e->getMessage()."<br> FUNCTION getRecord failed to search for value in table";
  }

  if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    return $row;
  }
  echo "no feilds to return";
  }
?>
