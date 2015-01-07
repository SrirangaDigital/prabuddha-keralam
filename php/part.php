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
		<script src="js/modernizr.custom.js"></script>
		<link rel="shortcut icon" type="image/ico" href="../images/favicon.ico" />
			<link rel="stylesheet" href="months/css/component.css" />
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
						<li><a href="../about.html">About</a></li>
						<li><a href="../archives.php">Archives</a></li>
						<li><a href="search.php">Search</a></li>
					</ul>
				</nav>
			</header>

		<!-- Main -->
			<section id="main" class="container">
				<div id="sec_nav">
					<ul class="actions">
						<li><a href="volumes.php" class="button vol_bag icon fa-book">Volumes</a></li>
						<li><a href="articles.php" class="button art_bag icon fa-pencil">Articles</a></li>
						<li><a href="authors.php" class="button aut_bag icon fa-user">Author</a></li>
						<li><a href="search.php" class="button sea_bag icon fa-search">Search</a></li>
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
									echo '<a href="toc.php?vol=' . $volume . '&amp;part=' . $row['part'] . '">';
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
					<li><a href="https://www.facebook.com/pages/Prabuddha-Keralam/528116447198404" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Prabuddha Keralam, Sri Ramakrishna Math, Thrissur, Kerala. All rights reserved.</li><li>Design: <a href="#">Sriranga Digital Software Technologies Private Limited</a></li>
				</ul>
			</footer>

	
		
	</body>
</html>
