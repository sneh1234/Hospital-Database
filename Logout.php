<?php session_start(); /* Starts the session */
session_destroy(); /* Destroy started session */
header("location:Main.php");  /* Redirect to login page */
exit;
?>
