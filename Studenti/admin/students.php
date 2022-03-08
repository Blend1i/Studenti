<?php
    $error="NoError";
	include("config.php"); //included for connecting to the database
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Shiko Studentet</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <style>
                
            #tbl{margin-left:4%; width:92.5%;}
			td.fitwidth {
			width: 1px;
			white-space: nowrap;
			}
            #btn{margin-left:5%;}
            #btn2{width:50%;}
            #btn3{width:50%; margin-right:5%;}
            #formWraper{margin:0 20% 0 20%;}
			table{width:70%;margin-left:15%}
			@media only screen and (max-width: 600px) {
                a{width:110px;}
                #tbl{margin-left:20px; margin-right:20px;}
				#formWraper{margin:0 20px;}
                #btn{margin:0 10% 0 10%; width:80%;}
                 #btn2{margin:0 10% 0 10%; width:80%;}
                #btn3{margin:0 10% 0 10%; width:80%;}
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
								<h2>Shiko Student</h2>
								<p>Forma per Ndryshimin dhe Fshirjen e studenteve ekzistues</p>
							</div>
						</header> 
                         <form action="" method="post">
                            <ul class="actions fit">
								<li id="btn"><input type="text" name="term" value="" id="search" placeholder="Kërko Student sipas Emrit, Mbiemrit apo Fakultetit"/></li>
								<li id="btn2"> <input  type="submit" value="Kërko Student" class="fit primary" /></li>
								<li id="btn3"> <a href="csv_students.php" class="button primary fit">Shkarko ne Excel</a></li>
						    </ul>
                        </form>
						<!-- Content -->
							<div class="wrapper">
								
								<div style="width:100%;"class="table-wrapper">
									<table id="tbl">
										<thead>
											<tr>
												<th>Emri</th>
                                                <th>Mbiemri</th>
                                                <th>Data e Lindjes</th>
												<th>Gjinia</th>
												<th>Viti Akademik</th>
                                                <th>Fakulteti</th>
												<th >Modifiko të dhëna</th>
											</tr>
										</thead>
										<body>
										<?php
											include("config.php");
											if (!empty($_REQUEST['term'])) 
											{
                                                $term =$_REQUEST['term'];   
                                                $sql = mysqli_query($conn,"CALL student_select_term('$term')"); 
                                            }
                                            else if (empty($_REQUEST['term'])) 
											{
                                            	$sql = mysqli_query($conn,"CALL student_select()"); 
                                            }
												  
												while($row = mysqli_fetch_array($sql)) 
												{ 		
													echo "<tr>";
													echo "<td>".$row['name']."</td>";
													echo "<td>".$row['lastname']."</td>";	
													echo "<td>".$row['birthday']."</td>";
													echo "<td>".$row['gender']."</td>";
													echo "<td>".$row['academic_year']."</td>";
													echo "<td>".$row['faculty']."</td>";
                                                    echo "<td><a href=\"student_edit.php?std=$row[id_student]\" class='button small' style='width:120px; margin-right:10px; margin-bottom:5px;'>
														Ndrysho</a><a href=\"student_delete.php?std=$row[id_student]\" onClick=\"return confirm('A jeni të sigurt se doni ta fshini kete te dhene?')\" class='button small' style='width:120px;'>Fshij</a>
														</td></tr>";
												}
											
										?>
										</body>
									</table>
								</div>
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