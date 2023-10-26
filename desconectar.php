
<?php
session_start();

session_destroy();

$_SESSION["LoggedIn"] = false;

header("Location: login.html"); 
?>
