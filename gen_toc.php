<?php

require_once("html/connect.php");

$query = "select distinct volume from article order by volume";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

for($i=1;$i<=$num_rows;$i++)
{
	$row = $result->fetch_assoc();
	$volume=$row['volume'];

	$query2 = "select distinct part from article where volume='$volume' order by part";
	$result2 = $db->query($query2); 
	$num_rows2 = $result2 ? $result2->num_rows : 0;

	for($i2=1;$i2<=$num_rows2;$i2++)
	{
		$row2 = $result2->fetch_assoc();
		$part=$row2['part'];

		$filename = "html/toc_" . $volume . "_" . $part . ".html";

		$cmd = 'wget "http://localhost/prabuddha-keralam/html/toc.php?vol=' . $volume . '&part=' . $part . '" --output-document=' . $filename . ' --quiet';

		system($cmd);
	}
}

?>
