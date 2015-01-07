<!DOCTYPE HTML>
<html>
	<head>
		<title>Prabuddha Keralam</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta charset="utf-8" />
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
				<h1><a href="../index.html">Prabuddha Keralam</a> by Sri Ramakrishna Math</h1>
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
					<h2>Authors</h2>
					<p>People who have contributed for Prabuddha Kerelam</p>
				</header>
				
				
								<div class="row">
									<div class="12u">
										<section class="box">
		<div class="archive_holder">
<!--
			<div class="page_title"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Articles</div>
-->
			<div class="alphabet">
				<span class="letter"><a href="authors.php?letter=അ">അ</a></span>
				<span class="letter"><a href="authors.php?letter=ആ">ആ</a></span>
				<span class="letter"><a href="authors.php?letter=ഇ">ഇ</a></span>
				<span class="letter"><a href="authors.php?letter=ഈ">ഈ</a></span>
				<span class="letter"><a href="authors.php?letter=ഉ">ഉ</a></span>
				<span class="letter"><a href="authors.php?letter=ഊ">ഊ</a></span>
				<span class="letter"><a href="authors.php?letter=എ">എ</a></span>
				<span class="letter"><a href="authors.php?letter=ഏ">ഏ</a></span>
				<span class="letter"><a href="authors.php?letter=ഐ">ഐ</a></span>
				<span class="letter"><a href="authors.php?letter=ഒ">ഒ</a></span>
				<span class="letter"><a href="authors.php?letter=ഓ">ഓ</a></span>
				<span class="letter"><a href="authors.php?letter=ക">ക</a></span>
				<span class="letter"><a href="authors.php?letter=ഗ">ഗ</a></span>
				<span class="letter"><a href="authors.php?letter=ച">ച</a></span>
				<span class="letter"><a href="authors.php?letter=ജ">ജ</a></span>
				<span class="letter"><a href="authors.php?letter=ട">ട</a></span>
				<span class="letter"><a href="authors.php?letter=ഡ">ഡ</a></span>
				<span class="letter"><a href="authors.php?letter=ത">ത</a></span>
				<span class="letter"><a href="authors.php?letter=ദ">ദ</a></span>
				<span class="letter"><a href="authors.php?letter=ധ">ധ</a></span>
				<span class="letter"><a href="authors.php?letter=ന">ന</a></span>
				<span class="letter"><a href="authors.php?letter=പ">പ</a></span>
				<span class="letter"><a href="authors.php?letter=ഫ">ഫ</a></span>
				<span class="letter"><a href="authors.php?letter=ബ">ബ</a></span>
				<span class="letter"><a href="authors.php?letter=ഭ">ഭ</a></span>
				<span class="letter"><a href="authors.php?letter=മ">മ</a></span>
				<span class="letter"><a href="authors.php?letter=യ">യ</a></span>
				<span class="letter"><a href="authors.php?letter=ര">ര</a></span>
				<span class="letter"><a href="authors.php?letter=റ">റ</a></span>
				<span class="letter"><a href="authors.php?letter=ല">ല</a></span>
				<span class="letter"><a href="authors.php?letter=വ">വ</a></span>
				<span class="letter"><a href="authors.php?letter=ശ">ശ</a></span>
				<span class="letter"><a href="authors.php?letter=ഷ">ഷ</a></span>
				<span class="letter"><a href="authors.php?letter=സ">സ</a></span>
				<span class="letter"><a href="authors.php?letter=ഹ">ഹ</a></span>
			</div>
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['letter']))
{
	$letter=$_GET['letter'];

	//~ if(!(isValidLetter($letter)))
	//~ {
		//~ echo "<li>Invalid URL</li>";
		//~ 
		//~ echo "</ul></div></div>";
		//~ echo "<div class=\"clearfix\"></div></div>";
		//~ echo "</body></html>";
		//~ exit(1);
	//~ }

	if($letter == '')
	{
		$letter = 'അ';
	}
}
else
{
	$letter = 'അ';
}

$db = @new mysqli('localhost', "$user", "$password", "$database");
$db->set_charset('utf8');
if($db->connect_errno > 0)
{
	echo '<li>Not connected to the database [' . $db->connect_errno . ']</li>';
	echo "</ul></div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

$query = "select * from author where authorname like '$letter%' order by authorname";
/*
$query = "select * from author where authorname like '$letter%' order by authorname";
*/

//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;
echo "<ul>";
if($num_rows > 0)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row=mysql_fetch_assoc($result);
		$row = $result->fetch_assoc();

		$authid=$row['authid'];
		$authorname=$row['authorname'];

		echo "<li>";
		echo "<span class=\"authorspan\"><a href=\"auth.php?authid=$authid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
		echo "</li>\n";
	}
}
else
{
	echo "<li>Sorry! No author names were found to begin with the letter '$letter' in Records of the Indian Museum / ZSI</li>";
}
        echo "</ul>";
if($result){$result->free();}
$db->close();
?>

			</div>
			</section>
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
