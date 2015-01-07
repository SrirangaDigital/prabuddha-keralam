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
			<?php
				include("connect.php");
				require_once("common.php");
				if(isset($_GET['feature'])){$feat_name = $_GET['feature'];}else{$feat_name = '';}
				if(isset($_GET['featid'])){$featid = $_GET['featid'];}else{$featid = '';}
				$feat_name = entityReferenceReplace($feat_name);
				echo "<header>";
				echo"<h2>Category&nbsp; &nbsp;".$feat_name."</h2>";
				echo "</header>";
			?>
				
				
								<div class="row">
									<div class="12u">
										<section class="box">
											<div class="row">
												<div class="6u 12u(3)">
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['feature'])){$feat_name = $_GET['feature'];}else{$feat_name = '';}
if(isset($_GET['featid'])){$featid = $_GET['featid'];}else{$featid = '';}

$feat_name = entityReferenceReplace($feat_name);

if(!(isValidFeature($feat_name) && isValidFeatid($featid)))
{
	echo "Invalid URL";
	
	echo "</div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}

$db = @new mysqli('localhost', "$user", "$password", "$database");
$db->set_charset('utf8');
if($db->connect_errno > 0)
{
	echo 'Not connected to the database [' . $db->connect_errno . ']';
	echo "</div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

//~ echo "<div class=\"page_title\"><i class='fa fa-tags fa-1x'></i>&nbsp;&nbsp;Category&nbsp;:&nbsp;$feat_name</div>";
//~ echo "<ul class=\"dot\">";


$query1 = "select * from article where featid='$featid' order by volume, part, page";

$result1 = $db->query($query1); 
$num_rows1 = $result1 ? $result1->num_rows : 0;

//~ $result1 = mysql_query($query1);
//~ $num_rows1 = mysql_num_rows($result1);
echo '<ul>';
if($num_rows1 > 0)
{
	for($i=1;$i<=$num_rows1;$i++)
	{
		//~ $row1=mysql_fetch_assoc($result1);
		$row1 = $result1->fetch_assoc();

		$titleid=$row1['titleid'];
		$title=$row1['title'];
		$featid=$row1['featid'];
		$page=$row1['page'];
		$authid=$row1['authid'];
		$volume=$row1['volume'];
		$part=$row1['part'];
		$year=$row1['year'];
		$month=$row1['month'];
		
		$title1=addslashes($title);
		
		$query3 = "select feat_name from feature where featid='$featid'";
		
		//~ $result3 = mysql_query($query3);		
		//~ $row3=mysql_fetch_assoc($result3);
		
		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();

		$feature=$row3['feat_name'];
		
		if($result3){$result3->free();}
		
		$dpart = preg_replace("/^0/", "", $part);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		
		echo "<li>";
		echo "<span class=\"titlespan\"><a target=\"_blank\" href=\"../../Volumes/$volume/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\">$title</a></span>";
		echo "
		<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<span class=\"yearspan\">
			<a href=\"toc.php?vol=$volume&amp;part=$part\">".$year."&nbsp;&nbsp;" . $month_name{intval($month)}."&nbsp;;&nbsp;(Volume&nbsp;".intval($volume)."&nbsp;&nbsp;Issue&nbsp;".$dpart.")</a>
		</span>";
		
		if($authid != 0)
		{

			echo "<br />";
			$aut = preg_split('/;/',$authid);

			$fl = 0;
			foreach ($aut as $aid)
			{
				$query2 = "select * from author where authid=$aid";

				$result2 = $db->query($query2); 
				$num_rows2 = $result2 ? $result2->num_rows : 0;
				
				//~ $result2 = mysql_query($query2);
				//~ $num_rows2 = mysql_num_rows($result2);

				if($num_rows2 > 0)
				{
					//~ $row2=mysql_fetch_assoc($result2);
					$row2 = $result2->fetch_assoc();

					$authorname=$row2['authorname'];
					

					if($fl == 0)
					{
						echo "<span class=\"authorspan\"><a href=\"../auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
						$fl = 1;
					}
					else
					{
						echo "<span class=\"titlespan\">;&nbsp;</span><span class=\"authorspan\"><a href=\"../auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
					}
				}
				if($result2){$result2->free();}

			}
		}
		//~ echo "<br /><span class=\"downloadspan\"><a href=\"../../Volumes/$volume/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\" target=\"_blank\">View article</a>&nbsp;|&nbsp;<a href=\"#\">Download article (DjVu)</a>&nbsp;|&nbsp;<a href=\"#\">Download article (PDF)</a></span>";

		echo "</li>";
		echo '</ul>';
	}
}
else
{
	echo "No data in the database";
}

if($result1){$result1->free();}
$db->close();
?>

				</div>
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
					<li>&copy; Prabuddha Kerelam, Sri Ramakrishna Math, Thrissur, Kerela. All rights reserved.</li><li>Design: <a href="#">Sriranga Digital Software Technologies Private Limited</a></li>
				</ul>
			</footer>

	</body>
</html>
