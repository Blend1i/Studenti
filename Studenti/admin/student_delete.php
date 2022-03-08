<?php
include("config.php");

$id_student = $_GET['std'];

$result = mysqli_query($conn,"CALL student_delete('$id_student')");

header("Location:students.php");
?>
