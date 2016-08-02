<?php

$filename = "html/volumes.html";

$cmd = 'wget "http://localhost/prabuddha-keralam/html/volumes.php" --output-document=' . $filename . ' --quiet';

system($cmd);

?>
