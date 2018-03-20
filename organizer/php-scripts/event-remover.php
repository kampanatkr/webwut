<?php
// open session
session_start();
require_once "../../services/connectDB.php";
require_once "Event.php";

// Send them back to index if they're not organizer
if($_SESSION["ROLE"] !== "OR"){
    header("Location: index.php");
}

if (!empty($_GET)) {
    $eventID = $_GET["eid"];

    // get orgID from eventID, to prevent some brute force breach.
    $query = "SELECT `orgID` FROM `event` WHERE `eventID` = $eventID";
    $statement = $conn->prepare($query);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $orgIDFromEvent = $result['orgID'];
    if($orgIDFromEvent == $_SESSION['ID']){
        // delete thumbnail
        $query = "DELETE FROM `event_image` WHERE `eventID` = $eventID";
        $statement = $conn->prepare($query);
        $statement->execute();

        // delete survey link
        $query = "DELETE FROM `event_survey_link` WHERE `eventID` = $eventID";
        $statement = $conn->prepare($query);
        $statement->execute();

        // delete event
        $query = "DELETE FROM `event` WHERE `eventID` = $eventID";
        $statement = $conn->prepare($query);
        $statement->execute();
    }
}


// close session
session_write_close();
// redirect to organizer's homepage
header("Location: ../../org-homepage.php")
?>