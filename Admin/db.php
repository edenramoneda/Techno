<?php
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
 
/**
 * Connect to MySQL and instantiate the PDO object.
 */
    $pdo = new PDO(
        "mysql:host=" . "127.0.0.1:3333" . ";dbname=" . "techno", //DSN
        "newuser", //Username
        "589123456987", //Password
        $pdoOptions //Options
    );
   // echo "Connected successfully"; 
?>