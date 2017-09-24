<?php
header('HTTP/1.0 404 Not Found');
header('Content-Type: text/plain');
?>
Not Found: <?php echo($_SERVER['REQUEST_URI']);?>