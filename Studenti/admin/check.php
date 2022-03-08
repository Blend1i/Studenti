<?php
/* check the session */
include('config.php');
session_start();
$user_check=$_SESSION['username'];
$session = mysqli_query($conn,"CALL check_user('$user_check');");
$row=mysqli_fetch_array($session,MYSQLI_ASSOC);
$user_logged=$row['username'];
if(!isset($user_check))
{ header("Location: index.php");} 
?>