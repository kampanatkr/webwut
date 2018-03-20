<?php
    session_start();
    if (array_key_exists("submit", $_POST)) {
        $eventID = $_POST['eventID'];
        $comment = $_POST['comment'];
        $userID = $_SESSION['ID'];
        include 'connectDB.php';
        $stmt = $conn->prepare("INSERT INTO event_comment(eventID, userID, comment) VALUES(".$eventID.", ".$userID.", '".$comment."');");
        $stmt->execute();
        header("location:../event.php?id=".$eventID."#comments");
    }

?>