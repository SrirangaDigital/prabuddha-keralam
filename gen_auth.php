<?php

require_once("html/connect.php");

$query = "select distinct authid,authorname from author order by authid";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

for($i=1;$i<=$num_rows;$i++)
{
	$row = $result->fetch_assoc();
	$authid=$row['authid'];
	$authorname=$row['authorname'];

	$filename = "html/auth_" . $authid . ".html";

	$cmd = 'wget "http://localhost/prabuddha-keralam/html/auth.php?authid=' . $authid . '&author=' . $authorname . '" --output-document=' . $filename . ' --quiet';

	system($cmd);
}
?>
