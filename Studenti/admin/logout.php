<?php //destroy the session and return to login page
session_start();
if(session_destroy()){ header("Location: index.php");} 
?>