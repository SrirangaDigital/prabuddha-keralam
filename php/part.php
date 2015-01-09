<!DOCTYPE html>
<html lang="en" >
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Prabuddha Kerelam</title>
<!--
		<link rel="shortcut icon" href="favicon.ico"> 
-->
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/jquery.scrollgress.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/init.js"></script>
		<link rel="shortcut icon" type="image/ico" href="images/favicon.ico" />
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
					<?php include("nav.php"); ?>

		<!-- Main -->
			<section id="main" class="container">
				<?php include("sec_nav.php"); ?>
											<?php

												include("connect.php");
												require_once("common.php");

												if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}

												if(!(isValidVolume($volume)))
												{
													exit(1);
												}

												$query = "select distinct year,part,month from article where volume='$volume' order by part";
												$result = $db->query($query); 
												$num_rows = $result ? $result->num_rows : 0;
												
												echo '<header>';
												echo '<h2>Volume&nbsp;'.intval($volume).'</h2>';
												echo '<p>'.getYear($volume).'</p>';
												echo '</header>';
											?>
				
								<div class="row">
									<div class="12u">
										<section class="box">
												
												
								<div class="clearfix">
									<nav id="menu" class="nav">					
										<ul>
											<?php


												if($num_rows > 0)
												{
													$isFirst = 1;
													while($row = $result->fetch_assoc())
													{
														//~ echo (($row['month'] == '01') && ($isFirst == 0)) ? '<div class="deLimiter">|</div>' : '';
														echo "<li>";
														echo '<a href="toc.php?vol=' . $volume . '&amp;part=' . $row['part'] . '">';
														echo '<span>'.getMonth_part($row['month']).' </span>';
														echo "</a>";
														echo "</li>";
														//~ echo '<div class="iphonebadge"><a href="toc.php?vol=' . $volume . '&amp;part=' . $row['part'] . '">' . getMonth($row['month']) . '</a></div>';
														$isFirst = 0;
													}
												}
													echo '</ul>';

												if($result){$result->free();}
												$db->close();

												?>
							</nav>
							</div>
						</div>
					</div>
				</section>

			</section>
					
			
		<?php include("footer.php"); ?>
