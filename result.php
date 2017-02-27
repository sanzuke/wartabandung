<?php
$fp = fopen('proses.php', 'w');
fwrite($fp, 'Bla bla bla ');
fwrite($fp, 'Wkwkwkwkwkw!!!');
fclose($fp);
?>