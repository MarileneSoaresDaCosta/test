<?php
session_start();


//check if user logged in and send to index.php,
unset($_SESSION['fingerprint']);

unset($_SESSION['username']);



  header("Location:login.php"); 

?>

