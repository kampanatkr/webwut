<?php 
	include('connectDB.php');
	$query = "SELECT * FROM `personal_info` LEFT JOIN `user` ON personal_info.userID=user.id ORDER BY `id` ASC";
	$statement = $conn->query($query);
	$row = $statement->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($row);
 ?>