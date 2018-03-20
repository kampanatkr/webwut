<?php 
	include('connectDB.php');
	$query = "SELECT * FROM `event` LEFT JOIN `organizer_info` ON event.orgID=organizer_info.userID ORDER BY `eventID` ASC";
	$statement = $conn->query($query);
	$row = $statement->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($row);
 ?>