<?php

    $hostname = "mysql-guidegalileo.alwaysdata.net";
    $username = "234514";
    $password = "42Ya4gls8";
    $db = "guidegalileo_general";

    try {
        $conn = new PDO("mysql:host=$hostname;dbname=guidegalileo_general", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Database connected successfully";
    } catch(PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }

?>