<?php 
include("check.php");
include("config.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Studenti</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
                <header id="header">
						<h1><a href="admin_home.php">Studenti</a></h1>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
				</header>

                <!-- Nav -->
				<?php include("nav.php"); ?>

				<!-- Banner -->
					<section id="banner" style="padding-bottom:10px;">
						<div class="inner">
							<h2>Moduli per Student</h2>
							<p>Moduli per menaxhimin e te dhenave te studenteve</p>
                            <p>Pershendetje <?php echo $user_logged ?></p>
						</div>
					</section>

				<!-- Wrapper -->
					<section id="wrapper" >
                        </section>
							<section id="four" class="wrapper alt style1">
								<div class="inner">
									<section class="features">
										<article>
											<h3 class="major">Shto Student</h3>
											<p>Shto student te ri ne modul</p>
											<a href="student_add.php" class="special">Shto Student</a>
										</article>
										<article>
											<h3 class="major">Shiko Studentet</h3>
											<p>Shiko, Ndrysho dhe fshij te dhenat e studenteve ekzistues</p>
											<a href="students.php" class="special">Shiko Studentet</a>
										</article>
									</section>
									
								</div>
							</section>

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