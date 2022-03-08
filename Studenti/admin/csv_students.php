<?php 
include("config.php"); //included for connecting to the database
$query = mysqli_query($conn,"CALL student_select()");//used to check data in db to return false or true

if(mysqli_num_rows($query) > 0){

    $divide = ","; //used to divide the data
    $filename = "students_".date('Y-m-d').".csv"; 

    //file pointer
    $f = fopen('php://memory', 'w'); 

    //data in the first row
    $fields = array('id_student', 'name', 'lastname', 'birthday','gender', 'academic_year', 'faculty'); 
    //put the data in the first row
    fputcsv($f, $fields, $divide); 

    include("config.php");
    $result=mysqli_query($conn,"CALL student_select()");
    while($res = mysqli_fetch_array($result))
    {
        $Data = array( $res['name'], $res['lastname'], $res['birthday'], $res['gender'], $res['academic_year'],$res['faculty']);
        fputcsv($f, $Data, $divide); //put data everytime that goes into while
    }

    fseek($f, 0); 
     
    // Set headers to download file
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
}
exit;
?>