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

    if($_FILES["evidence"]["name"] != "") {
        $UID = $_SESSION["ID"];
        $target_dir = "../assets/payment/";
        $imageFileType = strtolower(pathinfo($_FILES["evidence"]["name"],PATHINFO_EXTENSION));
        $new_file_name = "payment-".$userID."-".$eventID.".".$imageFileType;
        $target_file = $target_dir .  $new_file_name;
        $uploadOk = 1;
        $check = getimagesize($_FILES["evidence"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
            if (move_uploaded_file($_FILES["evidence"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["evidence"]["name"]). " has been uploaded.";
                if (isset($conn)) {
                    
                    $sql = "INSERT INTO payment(evidence) values(?)";
                    $statement = $conn->prepare($sql); 
                    $statement->execute([$new_file_name]);
                    $sql = "SELECT MAX(paymentID) as id FROM payment";
                    $statement = $conn->prepare($sql); 
                    $statement->execute();
                    $max_id = $statement->fetch(PDO::FETCH_OBJ)->id;

                    $sql = "INSERT INTO event_attendant(eventID,aID,flag,paymentID) values(?,?,?,?)";
                    $statement = $conn->prepare($sql); 
                    $statement->execute([$eventID, $UID, 0, $max_id]);

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

                    $attendeeSubject = "You have joined an event: $event->eventName.";
                    $organizerSubject = $_SESSION['displayName']." has joined your event: $event->eventName.";
                    $attMessage = "<h1>Event: ".$event->eventName."</h1>";
                    $attMessage .= "<h3>Location: '".$event->indoorName."' ".$event->location."</h3>";
                    $attMessage .= "<h3>Start date: ".$event->eventStart."</h3>";
                    $attMessage .= "<h3>Status: PENDING</h3>";
                    $attMessage .= "<a href='http://localhost/webwut/event.php?id=$eventID'><h3>See more detail</h3></a>";

                    $orgMessage = $_SESSION['displayName']." has joined your event: $event->eventName.";
                    $orgMessage .= "<a href='http://localhost/webwut/event-viewer.php?eid=4$eventID'><h3>Approve or Deny ".($attGender=="male"?"him":"her")."</h3></a>";
                    $orgMessage .= "<a href='http://localhost/webwut/profile.php?user=$userID'><h3>Check out ".($attGender=="male"?"his":"her")." profile</h3></a>";
                    $SUCCESS = TRUE;

                    sendMail($attEmail, $attendeeSubject, $attMessage);
                    sendMail($orgEmail, $organizerSubject, $orgMessage);
                }
    
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        
    }



}


header("location:../event.php?id=".$eventID);
?>