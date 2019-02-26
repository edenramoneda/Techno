<?php
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
 
/**
 * Connect to MySQL and instantiate the PDO object.
 */
    $pdo = new PDO(
        "mysql:host=" . "db4free.net:3306" . ";dbname=" . "ramsweetsph_17", //DSN
        "edenramoneda17", //Username
        "3d3nr4m0n3d4", //Password
        $pdoOptions //Options
    );
   // echo "Connected successfully"; 
?>