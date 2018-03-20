<?php 
	include("./connectDB.php");
	$id = $_POST['id'];
    $orgName = $_POST['orgName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if ($orgName != "" && $email != "" && $phone != "") {
		$query_check = 'SELECT * FROM `organizer_info` WHERE email="'.$email.'" AND userID!="'.$id.'"';
     	$statement_check = $conn->query($query_check);
     	$row_check = $statement_check->fetchAll(PDO::FETCH_OBJ);
     	if (sizeof($row_check) > 0) {
            echo "email has already !!";
        } else {
        	$query = 'UPDATE `organizer_info` SET `orgName`="'.$orgName.'",`email`="'.$email.'",`phoneNo`="'.$phone.'" WHERE userID="'.$id.'"';
        	$statement= $conn->exec($query);
        	echo "update complete";
        }

    // 	$d = $conn->exec('UPDATE `organizer_info` SET `email`="8" WHERE userID=54');
    // 	$affectedRow = $conn->exec(
    // 		"UPDATE `organizer_info` 
				// SET `email` = '$email'
				// WHERE userID = '$id' and NOT EXISTS (SELECT email 
    //                                 					FROM (SELECT * FROM organizer_info) 
    //                                 					WHERE userID != '$id' and email = '$email')"
    // 	);
    // 	echo $affectedRow;
    }
    else{
    	echo "not complete";
    }
 ?>