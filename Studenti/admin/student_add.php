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
			$name=mysqli_real_escape_string($conn,$_POST["name"]);
			$lastname=mysqli_real_escape_string($conn,$_POST["lastname"]);
            $birthday = $_POST['birthday'];
            $id_gender = $_POST['id_gender'];
            $id_faculty= $_POST['id_faculty'];
            $academic_year=mysqli_real_escape_string($conn,$_POST["academic_year"]);


			$sql="CALL student_add('$name','$lastname','$birthday','$id_gender','$id_faculty','$academic_year');";
			$result=mysqli_query($conn,$sql); //execute query
			$error = "Te dhenat jane shtuar me sukses";
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Shto Student</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <style>
              #formWraper{margin:0 20% 0 20%;}
			@media only screen and (max-width: 600px) {
				a{width:110px;}
				#formWraper{margin:0 20px;}
			}
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
                if($error!="Te dhenat jane shtuar me sukses"){
                echo"<header id='header'>";
				echo "<div style='background-color:#e44c65; width:115%; height:100%; margin-left:-20px;'>
                <strong><p style='margin-left:37%; color:whitesmoke'>$error</p></strong></div></header>";}
                else{ echo"<header id='header'>";
                    echo "<script> setTimeout(function(){window.location.href = 'admin_home.php';}, 3000);</script>";
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
								<h2>Shto Student</h2>
								<p>Forma per Insertimin e studentit te ri</p>
							</div>
						</header>

						<!-- Content -->
							<div class="wrapper">
								<div class="inner">
                                <form action="student_add.php" method="post" enctype="multipart/form-data">
								<div class="row gtr-uniform gtr-50">
                                    <div id="formWraper" class="col-6 col-12">
									    <input type="text" name="name" id="name" placeholder="Emri"/>
                                    </div>
									<div id="formWraper" class="col-6 col-12">
										<input type="text" name="lastname" id="lastname" placeholder="Mbiemri"/>
                                    </div>
                                    <div id="formWraper" class="col-6 col-12">
                                        <p style="margin:0;">Data e lindjes</p>
										<input style="color:black; width:100%;" type="date"  name="birthday" id="birthday"/>
                                    </div>
                                    <div id="formWraper" class="col-6 col-12">
									<select  name="id_gender" id="id_gender">
								    <option value="">- Zgjedh Gjinin -</option>
								    <?php   
									include("config.php");
									$sql = mysqli_query($conn,"CALL select_gender()"); 
									while($row = mysqli_fetch_array($sql))
									{ 		
										echo "<option value='".$row['id_gender']."'>";
										echo "".$row['gender']."</option>";
									}
								    ?>
								    </select></div>
                                    <div id="formWraper" class="col-6 col-12">
									<select  name="id_faculty" id="id_faculty">
								    <option value="">- Zgjedh Fakultetin -</option>
								    <?php   
									include("config.php");
									$sql = mysqli_query($conn,"CALL select_faculty()"); 
									while($row = mysqli_fetch_array($sql))
									{ 		
										echo "<option value='".$row['id_faculty']."'>";
										echo "".$row['faculty']."</option>";
									}
								    ?>
								    </select></div>
                                    <div id="formWraper" class="col-6 col-12">
										<input type="text" name="academic_year" id="academic_year" placeholder="Viti Akademik" />
                                    </div>
									<div id="formWraper" class="col-6 col-12">
										<ul class="actions fit">
											<li style="width:95%;">
												<button style="font-size:95%" type="submit" name="submit" id="submit" class="button primary fit">Shto Student</button>
											</li>
										</ul>
									</div>
								</div>
							</form>
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