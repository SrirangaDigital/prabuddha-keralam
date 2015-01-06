<!DOCTYPE HTML>
<html>
	<head>
		<title>Prabuddha Keralam</title>
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
		<script src="../js/malayalam_kbd.js"></script>
		<link rel="shortcut icon" type="image/ico" href="../images/favicon.ico" />
			<link rel="stylesheet" href="../css/skel.css" />
			<link rel="stylesheet" href="../css/style.css" />
			<link rel="stylesheet" href="../css/style-wide.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="../index.html">Prabuddha Keralam </a> by Sri Ramakrishna Math</h1>
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
					<h2>Search</h2>
					<p>Search in the volumes of Prabuddha Keralam !</p>
				</header>
<?php

include("connect.php");
require_once("common.php");

?>
                <div class="row">
					<div class="12u">
						
						<!-- Form -->
							<section class="box">
								<h3>Search</h3>
								<?php include("keyboard.php");?>
								<form method="get" action="search-result.php">
									<div class="row uniform 50%">
										<div class="6u 12u(3)">
											<input type="text" name="title" id="title" onfocus="SetId('title')" value="" placeholder="Title" />
										</div>
									</div>
									
									<div class="row uniform 50%">
										<div class="3u 12u(3)">
											<input type="text" name="author" id="author" onfocus="SetId('author')" value="" placeholder="Author" />
										</div>
									</div>
										<div class="row uniform 50%">
<!--
											<div class="2u 12u(3)">
-->
											<div class="2u 12u(3)">
												<select name="year1">
													<option value="">&nbsp;</option>
															<?php

																$query = "select distinct year from article order by year";
																$result = $db->query($query);
																$num_rows = $result ? $result->num_rows : 0;

																if($num_rows > 0)
																{
																	for($i=1;$i<=$num_rows;$i++)
																	{
																		$row = $result->fetch_assoc();

																		$year=$row['year'];
																		echo "<option value=\"$year\">" . $year . "</option>";
																	}
																}

																if($result){$result->free();}

															?>
												</select>
											</div>
											<span class="clr1">Year</span>
<!--
											<span class="clr1">&nbsp;to&nbsp;</span>
-->
											<div class="2u 12u(3)">
												<select name="year2" placeholder="Year">
													<option value="">&nbsp;</option>
														<?php
															$result = $db->query($query);
															$num_rows = $result ? $result->num_rows : 0;

															if($num_rows > 0)
															{
																for($i=1;$i<=$num_rows;$i++)
																{
																	$row = $result->fetch_assoc();

																	$year=$row['year'];
																	echo "<option value=\"$year\">" . $year . "</option>";
																}
															}
															if($result){$result->free();}
															$db->close();
														?>
												</select>
											</div>
										</div>
										<div class="row uniform 50%">
											<div class="4u 12u(3)">
												<input type="submit" value="Search" class="fit" />
											</div>
											<div class="2u 12u(3)">
												<input type="reset" value="Reset" class="fit" />
											</div>
										</div>
								</form>
							</section>
						</div>
					</div>
					</section>
				
			
		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="https://www.facebook.com/pages/Prabuddha-Keralam/528116447198404?ref=ts&fref=ts" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Prabuddha Keralam, Sri Ramakrishna Math, Thrissur, Kerala. All rights reserved.</li><li>Design: <a href="#">Sriranga Digital Software Technologies Private Limited</a></li>
				</ul>
			</footer>
	</body>
</html>
