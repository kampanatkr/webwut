<?php

$eventID = $_SESSION["eventID"];
$orgID = $_SESSION["ID"];

$query = "SELECT `event`.*, `event_image`.`image`, `event_survey_link`.`surveyLink` FROM `event` 
          LEFT JOIN `event_image` ON `event`.`eventID` = `event_image`
          .`eventID` 
          LEFT JOIN `event_survey_link` ON `event`.`eventID` = 
          `event_survey_link`.`eventID` 
          WHERE `event`.`eventID` = $eventID";

$statement = $conn->prepare($query);
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);
$orgIDDB = $row["orgID"];

// If other organizers somehow get an access to the event, redirect them back
if($orgID !== $orgIDDB){
    header("Location: org-homepage.php");
} else {
    $detail = $row["eventDetail"];
    $type = $row["type"];
    $eventName = $row["eventName"];
    $createDate = date(strtotime($row["eventCreate"]));
    $registrableDate = date(strtotime($row["registrableDate"]));
    $startDate = date(strtotime($row["eventStart"]));
    $endDate = date(strtotime($row["eventEnd"]));
    $age = intval($row["age"]);
    $gender = $row["gender"];
    $attendingCost = intval($row["price"]);
    $maxEntries = intval($row["capacity"]);
    $indoorName = $row["indoorName"];
    $location = $row["location"];

    $thumbnailPath = $row["image"];
    $surveyLink = $row["surveyLink"];

    $event = new Event($eventID, intval($orgID), $eventName, $type, $detail,
        $createDate, $registrableDate, $startDate, $endDate, $age,
        $gender, $maxEntries, $attendingCost, $indoorName, $location);

    $event->setThumbnail($thumbnailPath);
    $event->setSurveyLink($surveyLink);

    $query = "SELECT `event_attendant`.`aID`, `event_attendant`.`flag`, `event_attendant`.`paymentID`, `event_attendant`.`qrCode`, `event_attendant`.`registerStamp`, `personal_info`.`displayName`, `personal_info`.`email`, `payment`.`evidence` FROM `event`
              INNER JOIN `event_attendant` ON `event`.`eventID` = `event_attendant`.`eventID`
              INNER JOIN `payment` ON `event_attendant`.`paymentID` = `payment`.`paymentID`
              INNER JOIN `personal_info` ON `event_attendant`.`aID` = `personal_info`.`userID`
              WHERE `event`.`eventID` = $eventID
              ORDER BY `event`.`eventID`";

    $statement = $conn->prepare($query);
    $statement->execute();

    while ($nested_row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $attendeeID = intval($nested_row["aID"]);
        $attendeeName = $nested_row["displayName"];
        $flag = intval($nested_row["flag"]);
        $paymentID = intval($nested_row["paymentID"]);
        $qrCode = $nested_row["qrCode"];
        $registerStamp = $nested_row["registerStamp"];
        $email = $nested_row["email"];
        $evidence = $nested_row["evidence"];

        $attendeeObject = new EventAttendee();
        $attendeeObject->setAttendeeID($attendeeID);
        $attendeeObject->setAttendeeName($attendeeName);
        $attendeeObject->setFlag($flag);
        $attendeeObject->setEmail($email);
        $attendeeObject->setQRCode($qrCode);
        $attendeeObject->setPaymentID($paymentID);
        $attendeeObject->setEvidence($evidence);
        $attendeeObject->setRegisterStamp($registerStamp);
        $event->pushAttendee($attendeeObject);
    }
}
