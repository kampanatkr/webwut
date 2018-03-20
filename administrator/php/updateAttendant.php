<?php 
	include("./connectDB.php");
	$id = $_POST['id'];
    $displayName = $_POST['displayName'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];

    if ($firstName != "" && $lastName != "" && $email != "" && $age != "" && $phone != "") {
		$query_check = 'SELECT * FROM `personal_info` WHERE email="'.$email.'" AND userID!="'.$id.'"';
     	$statement_check = $conn->query($query_check);
     	$row_check = $statement_check->fetchAll(PDO::FETCH_OBJ);
     	if (sizeof($row_check) > 0) {
            echo "email has already !!";
        } else {
        	$query = 'UPDATE `personal_info` SET `displayName`="'.$displayName.'",`firstName`="'.$firstName.'", `lastName`="'.$lastName.'",`email`="'.$email.'", `age`="'.$age.'",`phoneNo`="'.$phone.'" WHERE userID="'.$id.'"';
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