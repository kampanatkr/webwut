<?php
session_start();
include 'connectDB.php';
include 'sendMail.php';

if (array_key_exists("ID", $_SESSION) && array_key_exists("eventID", $_POST)) {

    $userID = $_SESSION['ID'];
    $eventID = $_POST['eventID'];
    
    $sql = "SELECT * FROM event WHERE eventID=?";
    $statement = $conn->prepare($sql); 
    $statement->execute([$eventID]);
    $event = $statement->fetch(PDO::FETCH_OBJ);

    $sql = 'SELECT count(*) as num FROM event_attendant WHERE eventID='.$eventID;;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $num = $stmt->fetch(PDO::FETCH_OBJ)->num;
    
    if ($num >= $event->capacity) {   
        header("location:../event.php?id=".$eventID);
    }

    $sql = "INSERT INTO payment() values()";
    $statement = $conn->prepare($sql); 
    $statement->execute();
    $sql = "SELECT MAX(paymentID) as id FROM payment";
    $statement = $conn->prepare($sql); 
    $statement->execute();
    $max_id = $statement->fetch(PDO::FETCH_OBJ)->id;

    $sql = "INSERT INTO event_attendant(eventID,aID,flag,paymentID) values(?,?,?,?)";
    $statement = $conn->prepare($sql); 
    $statement->execute([$eventID, $userID, 1, $max_id]);
    
    $sql = "SELECT email FROM organizer_info WHERE userID=?";
    $statement = $conn->prepare($sql); 
    $statement->execute([$event->orgID]);
    $orgEmail = $statement->fetch(PDO::FETCH_OBJ)->email;
    
    $sql = "SELECT email,gender FROM personal_info WHERE userID=?";
    $statement = $conn->prepare($sql); 
    $statement->execute([$userID]);
    $att = $statement->fetch(PDO::FETCH_OBJ);
    $attEmail = $att->email;
    $attGender = $att->gender;
    
    $sql = "SELECT surveyLink FROM event_survey_link WHERE eventID=?";
    $statement = $conn->prepare($sql); 
    $statement->execute([$eventID]);
    $hasSurveyLink = $statement->fetch(PDO::FETCH_OBJ);
    if ($hasSurveyLink !== FALSE) {
        $surveyLink = $hasSurveyLink->surveyLink;
    }

    $attendeeSubject = "You have joined an event: $event->eventName.";
    $organizerSubject = $_SESSION['displayName']." has joined your event: $event->eventName.";
    $attMessage = "<h1>Event: ".$event->eventName."</h1>";
    $attMessage .= "<h3>Location: '".$event->indoorName."' ".$event->location."</h3>";
    $attMessage .= "<h3>Start date: ".$event->eventStart."</h3>";
    $attMessage .= "<h3>Status: APPROVED</h3>";
    if ($hasSurveyLink !== FALSE) {
        $attMessage .= "<h3>Survey Link: <a href='$surveyLink'>$surveyLink</a></h3>";
    }
    $attMessage .= "<a href='http://localhost/webwut/event.php?id=$eventID'><h3>See more detail</h3></a>";

    $orgMessage = $_SESSION['displayName']." has joined your event: $event->eventName.";
    $orgMessage .= "<a href='http://localhost/webwut/profile.php?user=$userID'><h3>Check out ".($attGender=="male"?"his":"her")." profile</h3></a>";
    $SUCCESS = TRUE;

    sendMail($attEmail, $attendeeSubject, $attMessage);
    sendMail($orgEmail, $organizerSubject, $orgMessage);
}


header("location:../event.php?id=".$eventID);
?>