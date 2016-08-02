<?php

$filename = "html/archives.html";

$cmd = 'wget "http://localhost/prabuddha-keralam/html/archives.php" --output-document=' . $filename . ' --quiet';

system($cmd);

?>
