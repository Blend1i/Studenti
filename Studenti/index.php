<?php
	include("config.php"); //included for connecting to the database
    
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
                
            #tbl{margin-left:4%; width:92.5%;}
			td.fitwidth {
			width: 1px;
			white-space: nowrap;
			}
            #btn{margin-left:5%;}
            #btn3{width:50%; margin-right:5%;}
            #formWraper{margin:0 20% 0 20%;}
			table{width:70%;margin-left:15%}
			@media only screen and (max-width: 600px) {
                a{width:110px;}
                #tbl{margin-left:20px; margin-right:20px;}
				#formWraper{margin:0 20px;}
                #btn{margin:0 10% 0 10%; width:80%;}
                #btn3{margin:0 10% 0 10%; width:80%;}
			}
			</style>
              
			
			</style>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

			 <!-- Header -->
              <header id='header'>
                    <h1><a href='index.php'>Studenti</a></h1>
             </header>

				<!-- Menu -->
				<!-- ? -->
				<!-- Wrapper -->
					<section id="wrapper">
						<header>
							<div class="inner">
								<h2>Kerko dhe shiko Studentet</h2>
							</div>
						</header> 
                        <form method="post" action="#">
							<div style="width:80%; margin:0 10% 0 10%;" class="row gtr-uniform">
								<div class="col-6 col-12-xsmall">
									<label for="demo-name">Emri apo Mbiemri</label>
									<input type="text" name="name" id="name"placeholder="Sheno Emrin apo Mbiemrin" />
								</div>
                                <div class="col-6 col-12-xsmall">
									<label for="academic_year">Viti Akademik</label>
									<select name="academic_year" id="academic_year">
										<option value="">- Zgjedh Vitin Akademik -</option>
										<option value="1">I</option>
										<option value="2">II</option>
										<option value="3">III</option>
										<option value="4">IV</option>
                                        <option value="5">V</option>
                                        <option value="6">VI</option>
									</select>
								</div>
							</div>
                            <div style="width:80%; margin:0 10% 0 10%;" class="row gtr-uniform">
                            <div class="col-6 col-12-xsmall">
									<label for="id_gender">Gjinia</label>
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
								    </select>
								</div>
                                <div class="col-6 col-12-xsmall">
									<label for="id_faculty">Fakulteti</label>
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
								    </select>
								</div>
							</div>
                            <div style="width:80%; margin:0 10% 0 10%;" class="row gtr-uniform">
								<div class="col-6 col-12-xsmall">
									<input type="submit" class="fit primary"  name="submit" id="submit" value="Kerko Student" />
								</div>
							</div>
						</form>
						<!-- Content -->
							<div class="wrapper">
								<div style="width:100%; margin-top:5%;"class="table-wrapper">
									<table id="tbl">
										<thead>
											<tr>
												<th>Emri</th>
                                                <th>Mbiemri</th>
                                                <th>Data e Lindjes</th>
												<th>Gjinia</th>
												<th style="text-align:center">Viti Akademik</th>
                                                <th>Fakulteti</th>
											</tr>
										</thead>
										<body>
										<?php
											include("config.php");
											$name =$_REQUEST['name'];   
											$id_gender=$_REQUEST['id_gender'];  
											$id_faculty=$_REQUEST['id_faculty']; 
											$academic_year=$_REQUEST['academic_year'];
											$sql=mysqli_query($conn,"SELECT students.name,students.lastname,genders.id_gender, students.id_faculty,students.birthday,
											students.academic_year,faculties.faculty,genders.gender FROM students
											LEFT JOIN faculties
											ON students.id_faculty=faculties.id_faculty
											LEFT JOIN genders
											ON students.id_gender=genders.id_gender 
											WHERE  students.name  LIKE '%".$name."%'  
											AND students.id_faculty  LIKE '%".$id_faculty."%'  
											AND students.id_gender  LIKE '%".$id_gender."%' 
											AND students.academic_year  LIKE '%".$academic_year."%' ");
                                            if (empty($_REQUEST['name']) && empty($_REQUEST['id_gender']) && empty($_REQUEST['id_faculty']) && empty($_REQUEST['academic_year'])){
                                            	$sql = mysqli_query($conn,"CALL student_select()"); 
                                            }
											while($row = mysqli_fetch_array($sql)) 
											{ 		
												echo "<tr>";
												echo "<td>".$row['name']."</td>";
												echo "<td>".$row['lastname']."</td>";	
												echo "<td>".$row['birthday']."</td>";
												echo "<td>".$row['gender']."</td>";
												echo "<td style='text-align:center'>".$row['academic_year']."</td>";
												echo "<td>".$row['faculty']."</td>";
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