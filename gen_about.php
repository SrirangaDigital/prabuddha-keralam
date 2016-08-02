<?php

$filename = "html/about.html";

$cmd = 'wget "http://localhost/prabuddha-keralam/html/about.php" --output-document=' . $filename . ' --quiet';

system($cmd);

?>
