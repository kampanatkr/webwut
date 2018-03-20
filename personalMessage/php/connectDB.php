<?php
	$DB_NAME = 'webwutdb';
	$USERNAME = 'root';
	$PASSWORD = '';
	// $connection = new PDO('mysql:host=localhost;dbname=editted_webwut;charset=utf8mb4', 'root', '');

	try {
        $conn = new PDO('mysql:host=localhost;dbname='.$DB_NAME.';charset=utf8mb4', $USERNAME, $PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"; 
    }
    catch(PDOException $e) {
    	echo "Connection failed";
        // echo "Connection failed: " . $e->getMessage();
    }
?>