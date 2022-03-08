<?php
    include("check.php");
	include("config.php"); //included for connecting to the database
    $error="NoError";
	if(isset($_POST["submit"])) //check if is set the submit button
	{
       
		if(empty($_POST["name"]) || empty($_POST["lastname"]) || empty($_POST["birthday"]) || 
           empty($_POST["id_gender"]) || empty($_POST["id_faculty"]) || empty($_POST["academic_year"]) || !is_numeric($_POST["academic_year"]))//check for the input boxes
		{
            if(empty($_POST["name"])){$error = "Fusha e Emrit eshte e zbrazet!";}

            else if(empty($_POST["lastname"])){$error = "Fusha e Mbiemrit eshte e zbrazet!";}

            else if(empty($_POST["birthday"])){$error = "Fusha e Dates se lindjes eshte e zbrazet!";}

            else if(empty($_POST["id_gender"])){$error = "Fusha e Gjinis eshte e zbrazet!";}

            else if(empty($_POST["id_faculty"])){$error = "Fusha e Fakultetit eshte e zbrazet!";}

            else if(empty($_POST["academic_year"])){$error = "Fusha e Vitit Akademik eshte e zbrazet!";}
            
            else if(!is_numeric($_POST["academic_year"])){$error = "Fusha e Vitit Akademik duhet te jete numer!";}
        }
        else
		{
            $id_student = $_POST['id_student'];

			$name=mysqli_real_escape_string($conn,$_POST["name"]);
			$lastname=mysqli_real_escape_string($conn,$_POST["lastname"]);
            $birthday = $_POST['birthday'];
            $id_gender = $_POST['id_gender'];
            $id_faculty= $_POST['id_faculty'];
            $academic_year=mysqli_real_escape_string($conn,$_POST["academic_year"]);


			$sql="CALL student_update('$name','$lastname','$birthday','$id_gender','$id_faculty','$academic_year','$id_student');";
			$result=mysqli_query($conn,$sql); //execute query
			$error = "Te dhenat jane ndryshuar me sukses";
		}
	}
?>
<?php
include("config.php");

$id_student=$_GET['std'];
$result=mysqli_query($conn,"CALL student_selectById('$id_student')");
while($res = mysqli_fetch_array($result))
{
    $wname = $res['name'];
    $wlastname = $res['lastname'];
    $wbirthday = $res['birthday'];
    $wid_gender = $res['id_gender'];
    $wgender = $res['gender'];
    $wfaculty = $res['faculty'];
    $wid_faculty = $res['id_faculty'];
    $wacademic_year = $res['academic_year'];
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Ndrysho Studentet</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <style>
            p{margin:0;}
            #tbl{margin-left:4%; width:92.5%;}
			td.fitwidth {
			width: 1px;
			white-space: nowrap;
			}
            #bttShto{width:70%;}
            #formWraper{margin:0 25% 0 25%;}
			table{width:70%;margin-left:15%}
			@media only screen and (max-width: 600px) {
                a{width:110px;}
                #tbl{margin-left:20px; margin-right:20px;}
				#bttShto{margin-left:0; width:100%;}
				#searchBox{margin:0; width:100%;}
                a{width:110px;}
				#formWraper{margin:0 20px;}
			}
			</style>
              
			
			</style>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header and the message if the data is empty or wrong-->
                <?php 
                if($error=="NoError"){
                    echo"<header id='header'>
                            <h1><a href='index.php'>Studenti</a></h1>
                            <nav><a href='#menu'>Menu</a></nav>
                         </header>";
                } 
				if($error!="NoError"){
                if($error!="Te dhenat jane ndryshuar me sukses"){
                echo"<header id='header'>";
				echo "<div style='background-color:#e44c65; width:115%; height:100%; margin-left:-20px;'>
                <strong><p style='margin-left:37%; color:whitesmoke'>$error</p></strong></div></header>";}
                else{ echo"<header id='header'>";
                    echo "<script> setTimeout(function(){window.location.href = 'students.php';}, 3000);</script>";
				    echo "<div style='background-color:#2E8B57; width:115%; height:100%; margin-left:-20px; '><strong><p style='margin-left:37%;'>$error</p></strong></div>";
                    echo "</header>";
                }
                }?>

				<!-- Menu -->
              <?php include("nav.php"); ?>

				<!-- Wrapper -->
					<section id="wrapper">
						<header>
							<div class="inner">
								<h2>Ndrysho Student</h2>
								<p>Forma per Ndryshimin studentit</p>
							</div>
						</header>

						<!-- Content -->
							<div class="wrapper">
                            <form action="student_edit.php?std=<?php echo $_GET['std'];?>" method="post" enctype="multipart/form-data">
								<div class="row gtr-uniform gtr-50">
                                    <div id="formWraper" class="col-6 col-12">
                                        <p>Emri :</p>
									    <input type="text" name="name" id="name" value='<?php echo $wname ?>'/>
                                    </div>
									<div id="formWraper" class="col-6 col-12">
                                        <p>Mbiemri :</p>
										<input type="text" name="lastname" id="lastname" value='<?php echo $wlastname ?>'/>
                                    </div>
                                    <div id="formWraper" class="col-6 col-12">
                                        <p>Data e lindjes :</p>
										<input style="width:100%; color:black; padding-left:15px;" type="date" name="birthday" id="birthday" value='<?php echo $wbirthday ?>'/>
                                    </div>
									<div id="formWraper" class="col-6 col-12">
                                        <p>Gjinia :</p>
                                        <select  name="id_gender" id="id_gender"><option value="<?php echo $wid_gender ?>"><?php echo $wgender ?></option>
								        <?php   
									    include("config.php");
									    $sql = mysqli_query($conn,"CALL select_gender()"); 
									    while($row = mysqli_fetch_array($sql))
									    { 	
										    if($row['id_gender']==$wid_gender){ }
										    else{echo "<option value='$row[id_gender]'>$row[gender]</option>";}	
									    }
								        ?>
                                </select> 
                                </div>
                                <div id="formWraper" class="col-6 col-12">
                                    <p>Fakulteti :</p>
                                    <select  name="id_faculty" id="id_faculty"><option value="<?php echo $wid_faculty ?>"><?php echo $wfaculty ?></option>
								    <?php   
									include("config.php");
									$sql = mysqli_query($conn,"CALL select_faculty()"); 
									while($row = mysqli_fetch_array($sql))
									{ 	
										if($row['id_faculty']==$wid_faculty){ }
										else{echo "<option value='$row[id_faculty]'>$row[faculty]</option>";}	
									}
								?>
                                </select> 
                                </div>
									<div id="formWraper" class="col-6 col-12">
                                        <p>Viti Akademik :</p>
										<input type="text" name="academic_year" id="academic_year" value='<?php echo $wacademic_year ?>' />
                                    </div>
									<div id="formWraper" class="col-6 col-12">
										<ul class="actions fit">
											<li><input type="hidden" id="id_student" name="id_student" value='<?php echo $_GET['std'];?>'/>
												<input type="submit" name="submit" value="Ndrysho" class="button primary fit"></li>
										</ul>
									</div>
								</div>
							</form>
                            </div>
					</section>
				    <!-- Footer -->
					<?php include("footer.php"); ?>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>