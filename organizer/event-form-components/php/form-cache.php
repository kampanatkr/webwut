<?php

require_once 'services/connectDB.php';

$detail = null;
$type = null;
$eventName = null;
$registrableDate = null;
$startDate = null;
$endDate = null;
$maxEntries = null;
$indoorName = null;
$location = null;
$surveyLink = null;

if (empty($_GET)) {
    $headings = "Adding an Event";
} else {
    $headings = "Editing an Event";
    $eventID = $_GET["eid"];

    // Invoke `eventID` in session
    $_SESSION["eventID"] = $eventID;
    $orgID = $_SESSION["ID"];

    $query = "SELECT `eventDetail`, `eventName`, `registrableDate`,
              `eventStart`, `eventEnd`, `type`, `capacity`,
              `indoorName`, `location`, `surveyLink` 
              FROM `event`
              LEFT JOIN `event_survey_link` 
              ON `event`.`eventID` = `event_survey_link`.`eventID` 
              WHERE `event`.`eventID` = $eventID
              AND `event`.`orgID` = $orgID";

    $statement = $conn->prepare($query);
    $statement->execute();
    if ($statement->rowCount()) {
        $eventData = $statement->fetch(PDO::FETCH_ASSOC);
        $detail = $eventData["eventDetail"];
        $type = $eventData["type"];
        $registrableDate = date("Y-m-d\TH:i:s", strtotime($eventData["registrableDate"]));
        $startDate = date("Y-m-d\TH:i:s", strtotime($eventData["eventStart"]));
        $endDate = date("Y-m-d\TH:i:s", strtotime($eventData["eventEnd"]));
        $eventName = $eventData["eventName"];
        $maxEntries = $eventData["capacity"];
        $indoorName = $eventData["indoorName"];
        $location = $eventData["location"];
        $surveyLink = $eventData["surveyLink"];
    } else {
        /*
        * If, for some reason, other organizer knows the event id, it will send
        * them back to add an event instead.
        */
        header("Location: " . $_SERVER['PHP_SELF']);
    }
}