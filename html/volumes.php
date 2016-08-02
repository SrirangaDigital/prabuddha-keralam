<?php include("header.php");?>
<?php include("nav.php"); ?>

<section id="main" class="container">

<?php include("sec_nav.php"); ?>

	<header>
		<h2>Volumes</h2>
		<p>List of all volumes published from 1915 to 2015</p>
	</header>
	<div class="row">
		<div class="12u">
			<section class="box">

<?php

include("connect.php");
require_once("common.php");

$query = 'select distinct volume from article order by volume';
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$volume = $row['volume'];
		$VolhtmlFile = "volume_" .  $volume . ".html";
		echo '<a href="'. $VolhtmlFile .'">';
		echo '	<div class="button alt">Vol '. intval($row['volume']) .' &nbsp;('.getYear($row['volume']) . ')</div>';
		echo '</a>';
	}
}


if($result){$result->free();}
$db->close();

?>
			</section>	
		</div>
	</div>
</section>

<?php include("footer.php");?>
