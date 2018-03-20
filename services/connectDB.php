<?php
    //ก๊อบมาจาก https://www.w3schools.com/php/php_mysql_connect.asp
    $HOST = "localhost";
    $DB = "webwutdb";
    $USERNAME = "root";
    $PASSWORD = "";

    try {
        $conn = new PDO("mysql:host=$HOST;dbname=$DB; charset=utf8",
            $USERNAME,
            $PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"; 
    }
    catch(PDOException $e) {
        // echo "Connection failed: " . $e->getMessage();
    }
?>