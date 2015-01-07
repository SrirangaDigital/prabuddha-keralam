<!--
<?php
	// If nothing is GETed, redirect to search page
	if(empty($_GET['author']) && empty($_GET['title']) && empty($_GET['year1']) && empty($_GET['year2'])) {
		header('Location: search.php');
		exit(1);
	}
?>
-->

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

if(isset($_GET['author'])){$author = $_GET['author'];}else{$author = '';}
if(isset($_GET['text'])){$text = $_GET['text'];}else{$text = '';}
if(isset($_GET['title'])){$title = $_GET['title'];}else{$title = '';}
if(isset($_GET['featid'])){$featid = $_GET['featid'];}else{$featid = '';}
if(isset($_GET['year1'])){$year1 = $_GET['year1'];}else{$year1 = '';}
if(isset($_GET['year2'])){$year2 = $_GET['year2'];}else{$year2 = '';}

$text = entityReferenceReplace($text);
$author = entityReferenceReplace($author);
$title = entityReferenceReplace($title);
$featid = entityReferenceReplace($featid);
$year1 = entityReferenceReplace($year1);
$year2 = entityReferenceReplace($year2);

$author = preg_replace("/[,\-]+/", " ", $author);
$author = preg_replace("/[\t]+/", " ", $author);
$author = preg_replace("/[ ]+/", " ", $author);
$author = preg_replace("/^ +/", "", $author);
$author = preg_replace("/ +$/", "", $author);
$author = preg_replace("/  /", " ", $author);
$author = preg_replace("/  /", " ", $author);

$title = preg_replace("/[,\-]+/", " ", $title);
$title = preg_replace("/[\t]+/", " ", $title);
$title = preg_replace("/[ ]+/", " ", $title);
$title = preg_replace("/^ +/", "", $title);
$title = preg_replace("/ +$/", "", $title);
$title = preg_replace("/  /", " ", $title);
$title = preg_replace("/  /", " ", $title);

$text = preg_replace("/[,\-]+/", " ", $text);
$text = preg_replace("/[\t]+/", " ", $text);
$text = preg_replace("/[ ]+/", " ", $text);
$text = preg_replace("/^ +/", "", $text);
$text = preg_replace("/ +$/", "", $text);
$text = preg_replace("/  /", " ", $text);
$text = preg_replace("/  /", " ", $text);

if($title=='')
{
    $title='[a-z]*';
}
if($author=='')
{
    $author='[a-z]*';
}
if($featid=='')
{
    $featid='[a-z]*';
}

($year1 == '') ? $year1 = 1915 : $year1 = $year1;
($year2 == '') ? $year2 = date('Y') : $year2 = $year2;

if($year2 < $year1)
{
    $tmp = $year1;
    $year1 = $year2;
    $year2 = $tmp;
}

$authorFilter = '';
$titleFilter = '';

$authors = preg_split("/ /", $author);
$titles = preg_split("/ /", $title);

for($ic=0;$ic<sizeof($authors);$ic++)
{
    $authorFilter .= "and authorname REGEXP '" . $authors[$ic] . "' ";
}
for($ic=0;$ic<sizeof($titles);$ic++)
{
    $titleFilter .= "and title REGEXP '" . $titles[$ic] . "' ";
}

$authorFilter = preg_replace("/^and /", "", $authorFilter);
$titleFilter = preg_replace("/^and /", "", $titleFilter);
$titleFilter = preg_replace("/ $/", "", $titleFilter);

if($text=='')
{
    $query="SELECT * FROM
                (SELECT * FROM
                    (SELECT * FROM
                        (SELECT * FROM article WHERE $authorFilter) AS tb1
                    WHERE $titleFilter) AS tb2
                WHERE featid REGEXP '$featid') AS tb3
            WHERE year between $year1 and $year2 ORDER BY volume, part, page";

}
elseif($text!='')
{
    $text = rtrim($text);
    if(preg_match("/^\"/", $text)) {

        $stext = preg_replace("/\"/", "", $text);
        $dtext = $stext;
        $stext = '"' . $stext . '"';
    }
    elseif(preg_match("/\+/", $text)) {

        $stext = preg_replace("/\+/", " +", $text);
        $dtext = preg_replace("/\+/", "|", $text);
        $stext = '+' . $stext;
    }
    elseif(preg_match("/\|/", $text)) {

        $stext = preg_replace("/\|/", " ", $text);
        $dtext = $text;
    }
    else {

        $stext = $text;
        $dtext = $stext = preg_replace("/ /", "|", $text);
    }
    
    $stext = addslashes($stext);
    
    $query="SELECT * FROM
                (SELECT * FROM
                    (SELECT * FROM
                        (SELECT * FROM
                            (SELECT *, MATCH (text) AGAINST ('$stext' IN BOOLEAN MODE) AS relevance FROM searchtable WHERE MATCH (text) AGAINST ('$stext' IN BOOLEAN MODE) ORDER BY relevance DESC) AS tb1
                        WHERE $authorFilter) AS tb2
                    WHERE $titleFilter) AS tb3
                WHERE featid REGEXP '$featid') AS tb4
            WHERE year between $year1 and $year2 ORDER BY volume, part, cur_page";
}

$result = $db->query($query); 
$num_results = $result ? $result->num_rows : 0;

//~ if ($num_results > 0)
//~ {
    //~ echo '<div class="page_title">' . $num_results;
    //~ echo ($num_results > 1) ? ' results' : ' result';
    //~ echo '</div>';
    //~ echo '<br>';
    //~ echo '<br>';
//~ }

					echo'<header>';
					echo'<h2>Search Results</h2>';
					echo'<p>'.$num_results.'&nbsp;Results</p>';
				echo '</header>';
			?>
				<div class="row">
					<div class="12u">
						
						<!-- Form -->
							<section class="box">

<?php
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;
$id = 0;
echo '<ul>';
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
			
        if ((strcmp($id, $row['titleid'])) != 0) {

            //~ echo ($id == "0") ? '<div class="article">' : '</div><div class="article">';
            //~ echo '  <div class="gapBelowSmall">';
            echo '<li>';
            echo ($row3['feat_name'] != '') ? '     <span class="featurespan"><a href="feat.php?feature=' . urlencode($row3['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row3['feat_name'] . '</a></span> | ' : '';
            
            //~ echo '  </div>';
            echo '  <span class="titlespan"><a target="_blank" href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page'] . '.djvu&amp;zoom=page">  ' . $row['title'] . '&nbsp;</a></span>';
            echo '      <span class="yearspan"><a href="toc.php?vol=' . $row['volume'] . '&amp;part=' . $row['part'] . '">|&nbsp;&nbsp;' . getMonth($row['month']) . ' ' . $row['year'] . '  (Volume ' . intval($row['volume']) . ', Issue ' . $dpart . ')</a></span>';
            if($row['authid'] != 0) {

                echo '  <br /><span class="authorspan"> ';
                $authids = preg_split('/;/',$row['authid']);
                $authornames = preg_split('/;/',$row['authorname']);
                $a=0;
                foreach ($authids as $aid) {

                    echo '<a href="auth.php?authid=' . $aid . '&amp;author=' . urlencode($authornames[$a]) . '">&nbsp;' . $authornames[$a] . '</a> ';
                    $a++;
                }echo '  </span>';

                
            }	
                echo '</li>';
            if($text != '')
            {
                echo '<br /><span class="aIssue">Text match found at page(s) : </span>';
                echo '<span class="aIssue"><a href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['cur_page'] . '.djvu&amp;zoom=page&amp;find=' . $dtext . '/r" target="_blank">' . intval($row['cur_page']) . '</a> </span>';
            }
            $id = $row['titleid'];
        }
			else {

            if($text != '')
            {
                echo '&nbsp;<span class="aIssue"><a href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['cur_page'] . '.djvu&amp;zoom=page&amp;find=' . $dtext . '/r" target="_blank">' . intval($row['cur_page']) . '</a> </span>';
            }
            $id = $row['titleid'];
				}
    
    } echo '</ul>';
}
else
{
    echo '<a href="search.php" class="sml clr2">Sorry! No results. Hit the back button or click here to try again.</a>';
}

if($result){$result->free();}
$db->close();

?>
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
