<?php

$alphabet = array("01"=>"അ","02"=>"ആ","03"=>"ഇ","04"=>"ഈ","05"=>"ഉ","06"=>"ഊ","07"=>"ഋ","08"=>"എ","09"=>"ഏ","10"=>"ഐ","11"=>"ഒ","12"=>"ഓ","13"=>"ക","14"=>"ഗ","15"=>"ച","16"=>"ജ","17"=>"ട","18"=>"ഡ","19"=>"ത","20"=>"ദ","21"=>"ധ","22"=>"ന","23"=>"പ","24"=>"ഫ","25"=>"ബ","26"=>"ഭ","27"=>"മ","28"=>"യ","29"=>"ര","30"=>"റ","31"=>"ല","32"=>"വ","33"=>"ശ","34"=>"ഷ","35"=>"സ","36"=>"ഹ","37"=>"Special",);

for($ia=1;$ia<=sizeof($alphabet);$ia++)
{
	$letter = $alphabet{str_pad($ia, 2, "0", STR_PAD_LEFT)};
	
	$filename = "html/authors_" . str_pad($ia, 2, "0", STR_PAD_LEFT) . ".html";

	$cmd = 'wget "http://localhost/prabuddha-keralam/html/authors.php?letter=' . $letter . '" --output-document=' . $filename . ' --quiet';

	system($cmd);
}

?>
