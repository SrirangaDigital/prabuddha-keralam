<?php

$alphabet = array("01"=>"അ","02"=>"ആ","03"=>"ഇ","04"=>"ഈ","05"=>"ഉ","06"=>"ഊ","07"=>"ഋ","08"=>"എ","09"=>"ഏ","10"=>"ഐ","11"=>"ഒ","12"=>"ഓ","13"=>"ക","14"=>"ഗ","15"=>"ഘ","16"=>"ച","17"=>"ഛ","18"=>"ജ","19"=>"ഞ","20"=>"ട","21"=>"ഡ","22"=>"ത","23"=>"ദ","24"=>"ധ","25"=>"ന","26"=>"പ","27"=>"ഫ","28"=>"ബ","29"=>"ഭ","30"=>"മ","31"=>"യ","32"=>"ര","33"=>"റ","34"=>"ല","35"=>"വ","36"=>"ശ","37"=>"ഷ","38"=>"സ","39"=>"ഹ","40"=>"Special",);

for($ia=1;$ia<=sizeof($alphabet);$ia++)
{
	$letter = $alphabet{str_pad($ia, 2, "0", STR_PAD_LEFT)};
	
	$filename = "html/articles_" . str_pad($ia, 2, "0", STR_PAD_LEFT) . ".html";

	$cmd = 'wget "http://localhost/prabuddha-keralam/html/articles.php?letter=' . $letter . '" --output-document=' . $filename . ' --quiet';

	system($cmd);
}

?>
