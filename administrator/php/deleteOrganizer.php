<?php 
	include("./connectDB.php");
	$id = $_POST['id'];
    $query1='DELETE FROM `organizer_info` WHERE userID="'.$id.'"';
    $query2='DELETE FROM `user` WHERE id="'.$id.'" and role="OR"';
    $statement1= $conn->exec($query1);
    $statement2= $conn->exec($query2);

    echo 'delete complete';
 ?>