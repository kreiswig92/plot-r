<?php
try{
$dbc = new PDO('mysql:host=localhost;dbname=kennethr_plotr;charset=utf8','kennethr_phpmod','r@dWIZARD15');
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
echo $e->getMessage()."<br>";
}
?>