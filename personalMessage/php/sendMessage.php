<?php
	include("./connectDB.php");
	session_start();
	// $uid = $_SESSION['username'];
	$displayName = $_SESSION['displayName'];
	// $uid = 'user2';

	$connection = $conn;
	$statement = $connection->query('SELECT CURRENT_TIMESTAMP');
	$timestamp = $statement->fetchAll(PDO::FETCH_OBJ)[0]->CURRENT_TIMESTAMP;

	// echo $timestamp;

	$target_dir = "../messageFile/";
	$fromID = "1";
	$toID = $_POST['toID'];
	$msg = $_POST['msg'];
	
	if(array_key_exists("file", $_FILES)){
		// echo "has img file";

		// create file name 
		$target_file =  $displayName . "-to-" . $toID . " " . $timestamp . "." . basename($_FILES["file"]["type"]);
		// replace char can't use
		$target_file =  str_replace(":", "-", $target_file);


		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	    $check = getimagesize($_FILES["file"]["tmp_name"]);
	    if($check !== false) {
	        // echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        // echo "File is not an image.";
	        $uploadOk = 0;
	    }

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk !== 0) {

			// check not enter name of reciever
    		if ($toID!=""){
				try {
					$query = $connection->exec('INSERT INTO `personal_message`(`fromID`, `toID`, `message`, `filePath`, `timestamp`) VALUES ((select userID from personal_info where displayName="'.$displayName.'"),(select userID from personal_info where displayName="'.$toID.'"),"'.$msg.'","'."./personalMessage/messageFile/".$target_file.'","'.$timestamp.'")');
					echo "true";
					move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir .$target_file); // เพิ่มจุดเพื่อ upload file
				} catch (Exception $e) {
					echo "false";
					
				}

			} else{
				echo "not ID";
			}
		}
	}else {
		// echo "has not img file";

		// check not enter name of reciever and msg
	    if ($toID!="" && $msg!=""){
			try {
				$query = $connection->exec('INSERT INTO `personal_message`(`fromID`, `toID`, `message`, `filePath`, `timestamp`) VALUES ((select userID from personal_info where displayName="'.$displayName.'"),(select userID from personal_info where displayName="'.$toID.'"), "'.$msg.'","","'.$timestamp.'")');
				echo "true";		
			} catch (Exception $e) {
				echo "false";
			}
		} else{
				echo "not ID or Msg";
		}
	}
?>