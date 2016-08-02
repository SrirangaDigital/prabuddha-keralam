<?php

$filename = "html/help.html";

$cmd = 'wget "http://localhost/prabuddha-keralam/html/help.php" --output-document=' . $filename . ' --quiet';

system($cmd);

?>
