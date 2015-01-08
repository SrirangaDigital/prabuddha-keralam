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
			<?php
								include("connect.php");
								require_once("common.php");
								if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}
								if(isset($_GET['part'])){$part = $_GET['part'];}else{$part = '';}
				
				
		


								if(!(isValidVolume($volume) && isValidPart($part)))
								{ 
									echo "Invalid URL";
									
									echo "</div></div>";
									echo "<div class=\"clearfix\"></div></div>";
									echo "</body></html>";
									exit(1);
								}

								$db = @new mysqli('localhost', "$user", "$password", "$database");
								$db->set_charset('utf8');
								if($db->connect_errno > 0)
								{
									echo 'Not connected to the database [' . $db->connect_errno . ']';
									echo "</div></div>";
									echo "<div class=\"clearfix\"></div></div>";
									echo "</body></html>";
									exit(1);
								}


								//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
								//~ $rs = mysql_select_db($database,$db) or die("No Database");

								$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

								$query = "select distinct year,month from article where volume='$volume' and part='$part'";

								//~ $result = mysql_query($query);
								//~ $num_rows = mysql_num_rows($result);

								$result = $db->query($query); 
								$num_rows = $result ? $result->num_rows : 0;

								if($num_rows > 0)
								{
									//~ $row=mysql_fetch_assoc($result);
									$row = $result->fetch_assoc();

									$month=$row['month'];
									$year=$row['year'];
									
									$dpart = preg_replace("/^0/", "", $part);
									$dpart = preg_replace("/\-0/", "-", $dpart);
									//~ echo "<div class=\"page_title\"><i class='fa fa-book fa-1x'></i>&nbsp;&nbsp".$year.",&nbsp;".$month_name{intval($month)}."&nbsp;&nbsp;&nbsp;</div><br>";
									
								}

								if($result){$result->free();}
												echo "<header>";
												echo "<h2>Volume&nbsp;".intval($volume).",&nbsp;Issue&nbsp;".intval($part)."</h2>";
												echo "<p>".getYear($volume)."&nbsp".$month_name{intval($month)}."</p>";
												echo "</header>";
				?>
				
				
								<div class="row">
									<div class="12u">
										<section class="box">
											<div class="row">
												<div class="6u 12u(3)">
													


<?php
$query = 'select * from article where volume=\'' . $volume . '\' and part=\'' . $part . '\'';

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;
//~ echo '<ul class="dot">';
if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$query3 = 'select feat_name from feature where featid=\'' . $row['featid'] . '\'';
		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();		
		
		$dpart = preg_replace("/^0/", "", $row['part']);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		
		if($result3){$result3->free();}

		echo '<div class="article">';
		echo "<li>";
		echo ($row3['feat_name'] != '') ? '<span class="featurespan"><a href="feat.php?feature=' . urlencode($row3['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row3['feat_name'] . '</a></span></div>' : '';
		echo '	<span class="titlespan"><a target="_blank" href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page'] . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span><br />';
		if($row['authid'] != 0) {

			echo '	<span class="authorspan"> ';
			$authids = preg_split('/;/',$row['authid']);
			$authornames = preg_split('/;/',$row['authorname']);
			$a=0;
			foreach ($authids as $aid) {

				echo '<a href="auth.php?authid=' . $aid . '&amp;author=' . urlencode($authornames[$a]) . '">&nbsp;' . $authornames[$a] . '</a> ';
				$a++;
			}
			
			echo '	</span>';
			echo '</li>';
		}
		
		echo '</div>';
	}
	//~ echo '</ul>';
}

if($result){$result->free();}
$db->close();

?>

			</div>
			</div>
			</div>
			</section>

			</section>

					
			
		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="https://www.facebook.com/pages/Prabuddha-Keralam/528116447198404" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Prabuddha Keralam, Sri Ramakrishna Math, Thrissur, Kerala. All rights reserved.</li><li>Digitized by <a href="#">Sriranga Digital Software Technologies Private Limited</a></li>
				</ul>
			</footer>

	</body>
</html>
