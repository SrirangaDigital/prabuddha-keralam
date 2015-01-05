<!DOCTYPE HTML>
<html>
	<head>
		<title>Prabuddha Kerelam</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="../js/jquery.min.js"></script>
		<script src="../js/jquery.dropotron.min.js"></script>
		<script src="../js/jquery.scrollgress.min.js"></script>
		<script src="../js/skel.min.js"></script>
		<script src="../js/skel-layers.min.js"></script>
		<script src="../js/main.js"></script>
		<script src="../js/init.js"></script>
			<link rel="stylesheet" href="../css/skel.css" />
			<link rel="stylesheet" href="../css/style.css" />
			<link rel="stylesheet" href="../css/style-wide.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="../index.html">Prabuddha Kerelam </a> by Sri Ramakrishna Math</h1>
				<nav id="nav">
					<ul>
						<li><a href="../index.html">Home</a></li>
						<li>
<!--
							<a href="#" class="icon fa-angle-down">About</a>
-->
							<a href="../about.html">About</a>
<!--
							<ul>
								<li><a href="generic.html">Generic</a></li>
								<li><a href="contact.html">Contact</a></li>
								<li><a href="elements.html">Elements</a></li>
								<li>
									<a href="">Submenu</a>
									<ul>
										<li><a href="#">Option One</a></li>
										<li><a href="#">Option Two</a></li>
										<li><a href="#">Option Three</a></li>
										<li><a href="#">Option Four</a></li>
									</ul>
								</li>
							</ul>
-->
						</li>
						<li><a href="../archives.php">Archives</a></li>
						<li><a href="#">Search</a></li>
<!--
						<li><a href="#" class="button">Sign Up</a></li>
-->
					</ul>
				</nav>
			</header>

		<!-- Main -->
			<section id="main" class="container">
				<div id="sec_nav">
					<ul class="actions">
						<li><a href="#" class="button vol_bag icon fa-book">Volumes</a></li>
						<li><a href="#" class="button art_bag icon fa-pencil">Articles</a></li>
						<li><a href="#" class="button aut_bag icon fa-user">Author</a></li>
						<li><a href="#" class="button sea_bag icon fa-search">Search</a></li>
					</ul>

				</div>
				<header>
					<h2>Issue</h2>
					<p>Select a month !</p>
				</header>
				
				
								<div class="row">
									<div class="12u">
										<?php
							
							include("connect.php");
							require_once("common.php");

							if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}

							if(!(isValidVolume($volume)))
							{
								exit(1);
							}
							echo '<div class="main clearfix">';
							echo '<nav id="menu_month" class="nav_month">';
							
							$query = "select distinct part,month from article where volume='$volume' order by part";
							$result = $db->query($query); 
							$num_rows = $result ? $result->num_rows : 0;
							echo '<ul>';

							if($num_rows > 0)
							{
								$isFirst = 1;
								while($row = $result->fetch_assoc())
								{
									//~ echo (($row['month'] == '01') && ($isFirst == 0)) ? '<div class="deLimiter">|</div>' : '';
									echo "<li>";
									echo '<a href="../toc.php?vol=' . $volume . '&amp;part=' . $row['part'] . '">';
									echo '<span>'.getMonth($row['month']).' </span>';
									echo "</a>";
									echo "</li>";
									//~ echo '<div class="iphonebadge"><a href="../toc.php?vol=' . $volume . '&amp;part=' . $row['part'] . '">' . getMonth($row['month']) . '</a></div>';
									$isFirst = 0;
								}
							}


							if($result){$result->free();}
							$db->close();

							?>
					</ul>
				</nav>
			</div>
		</div>
	</div>	
</section>
					
			
		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
<!--
					<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
					<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
					<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
-->
				</ul>
				<ul class="copyright">
					<li>&copy; Prabuddha Kerelam, Sri Ramakrishna Math, Thrissur, Kerela. All rights reserved.</li><li>Design: <a href="#">Sriranga Digital Software Technologies Private Limited</a></li>
				</ul>
			</footer>

	
		
	</body>
</html>
