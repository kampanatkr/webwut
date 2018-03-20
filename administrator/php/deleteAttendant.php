<?php 
	include("./connectDB.php");
	$id = $_POST['id'];
    $query1='DELETE FROM `personal_info` WHERE userID="'.$id.'"';
    $query2='DELETE FROM `user` WHERE id="'.$id.'" and role="AT"';
    $statement1= $conn->exec($query1);
    $statement2= $conn->exec($query2);

    echo 'delete complete';
 ?>