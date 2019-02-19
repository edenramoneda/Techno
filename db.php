<?php
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
 
/**
 * Connect to MySQL and instantiate the PDO object.
 */
    $pdo = new PDO(
        "mysql:host=" . "localhost" . ";dbname=" . "techno", //DSN
        "root", //Username
        "", //Password
        $pdoOptions //Options
    );
   // echo "Connected successfully"; 
?>