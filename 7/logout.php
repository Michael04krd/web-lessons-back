<?php
header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="Logged Out"');
header('Location: index.php');
exit;
?>
