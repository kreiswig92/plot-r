<?php
//////////////////////////////////////// DATABASE CONNECT ///////////////////////////////////
try{
$dbc = new PDO('mysql:host=localhost;dbname=kreiswig_233p;charset=utf8','kreiswig_phpmod','r@dWIZARD15');
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
echo $e->getMessage()."<br>";
}
///////////////////////////////////// END DATABASE CONNECT //////////////////////////////////
?>