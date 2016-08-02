<?php

require_once("html/connect.php");

$query = "select distinct volume from article order by volume";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

for($i=1;$i<=$num_rows;$i++)
{
	$row = $result->fetch_assoc();
	$volume=$row['volume'];

	$filename = "html/volume_" . $volume . ".html";

	$cmd = 'wget "http://localhost/prabuddha-keralam/html/part.php?vol=' . $volume . '" --output-document=' . $filename . ' --quiet';

	system($cmd);
}

?>
