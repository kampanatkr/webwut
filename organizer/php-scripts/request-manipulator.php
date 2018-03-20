<?php
// open session
session_start();
require_once "../../services/connectDB.php";

// Send them back to index if they're not organizer
if($_SESSION["ROLE"] !== "OR"){
    header("Location: index.php");
}

if (!empty($_GET)) {
    $aID = intval($_GET["aid"]);
    $request = intval($_GET["request"]);
    $eID = $_GET["eid"];

    if($request){ // On Accept Case
        $query = "UPDATE `event_attendant` SET `flag` = $request WHERE `aID` = $aID";
    } else { // On Reject Case
        $query = "DELETE FROM `event_attendant` WHERE `aID` = $aID";
    }
    $statement = $conn->prepare($query);
    $statement->execute();
}


// close session
session_write_close();
// redirect to event viewer
header("Location: ../../event-viewer.php?eid=$eID#attendee");
?>