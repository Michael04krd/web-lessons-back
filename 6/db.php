<?php
return new PDO('mysql:host=localhost;dbname=u68608', 'u68608', '1096993', [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
?>