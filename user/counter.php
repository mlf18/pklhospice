<?php
$open = fopen("hits.txt", "r+");
$value = fgets($open);
$close = fclose($open);
$open = fopen("hits.txt", "w+");
fwrite($open,$value);
?>