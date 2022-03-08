<?php
	include("config.php"); //included for connecting to the database
	session_start();
    $error="NoError";
	if(isset($_POST["submit"])) //check if is set the submit button
	{
		if(empty($_POST["username"]) || empty($_POST["password"]))//check for the input boxes
		{
			$error = "Duhet te plotesohen te dy fushat";
        }
        else
		{
			$username=mysqli_real_escape_string($conn,$_POST["username"]); //get the data
			$password=mysqli_real_escape_string($conn,$_POST["password"]); //get the data
			$sql="CALL login('$username','$password');";
			$result=mysqli_query($conn,$sql); //execute query
			if(mysqli_num_rows($result) == 1) //check if gets any data
			{
				$_SESSION['username'] = $username; 
				header("location:admin_home.php"); 
            }
            else
			{
				$error = "Te dhenat nuk jane te sakta, provoni përsëri";
			}
		}
	}
	if ((isset($_SESSION['username']) != '')) {header('Location:admin_home.php');}//Kontrollo se a eshte perdoruesi i kyqur
	
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Studenti</title>
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
                         </header>";
                } 
				if($error=="Duhet te plotesohen te dy fushat" || $error=="Te dhenat nuk jane te sakta, provoni përsëri"){
                echo"<header id='header'>";
				echo "<div style='background-color:#e44c65; width:115%; height:100%; margin-left:-20px;'>
                <strong><p style='margin-left:37%; color:whitesmoke'>$error</p></strong></div></header>";	
                }?>

				<!-- Menu -->
                <!-- Deleted on login -->

				<!-- Wrapper -->
					<section id="wrapper">
						<header>
							<div class="inner">
								<h2>Kyçu</h2>
								<p>Forma për kyçjen e administratorëve në modulin Studenti</p>
							</div>
						</header>

						<!-- Content -->
							<div class="wrapper">
								<div class="inner">
                                <form method="post" action="">
								<div class="row gtr-uniform gtr-50">
									<div id="formWraper" class="col-6 col-12">
										<input type="text" name="username" id="username" placeholder="Përdoruesi" />
									</div>
									<div id="formWraper" class="col-6 col-12">
										<input type="password" name="password" id="password" placeholder="Fjalkalimi" />
									</div>
									<div id="formWraper" class="col-6 col-12">
										<ul class="actions fit">
											<li><input type="submit" name="submit" id="submit" value="Kyçu" class="button primary fit"></li>
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