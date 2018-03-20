<?php
// Check if image file is a actual image or fake image
session_start();
include 'connectDB.php';
include 'sendMail.php';
if (!array_key_exists("ID",$_SESSION)) die("You are not logged in, dude");

$successSubject = "Your profile has been updated successfully.";
$failedSubject = "Warning! Your profile has not been updated properly.";

$successMessage = "<h1>Your profile has been updated successfully.</h1>";
$failedMessage = "<h1>Your profile has not been updated properly.</h1>";
$defaultMessage = "<a href='http://localhost/webwut/profile.php'><h3>Check out your profile</h3></a>";
$SUCCESS = TRUE;
$ISEMAILUPDATED = FALSE;
$ISNAMEUPDATED = FALSE;


$UID = $_SESSION["ID"];
$sql = "SELECT email FROM personal_info WHERE userID=?";
$statement = $conn->prepare($sql); 
$statement->execute([$UID]);
$receiver = $statement->fetch(PDO::FETCH_OBJ)->email;
if($_FILES["image"]["name"] != "") {
    $target_dir = "../assets/users/";
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
    $new_file_name = "profile-".$UID.".".$imageFileType;
    $target_file = $target_dir .  $new_file_name;
    $uploadOk = 1;
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    echo $_FILES["image"]["tmp_name"];
    echo $target_file;
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            if (isset($conn)) {
                $sql = "UPDATE personal_info SET image=? WHERE userID=?";
        
                $statement = $conn->prepare($sql); 
                $statement->execute([$new_file_name, $UID]);
                echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
            }

        } else {
            echo "Sorry, there was an error uploading your file.";
            $SUCCESS = FALSE;
            $failedMessage .= "<h3>Some mistakes happen while you're uploading an image.</h3>";
            $failedMessage .= "<h3>Please try again later.</h3>";
        }
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        $SUCCESS = FALSE;
        $failedMessage .= "<h3>Your uploading file is not an image.</h3>";
        $failedMessage .= "<h3>Profile picture must be an image type file.</h3>";
    }
    
}
if (array_key_exists("submit", $_POST)) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $display_name = $_POST['display_name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    
    $sql = "UPDATE personal_info SET firstName=?,lastName=?,phoneNo=? WHERE userID=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$first_name, $last_name, $tel, $UID]);

    $sql = "SELECT email FROM personal_info WHERE email=? AND userID!=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $$UID]);
    $checkEmail = $stmt->fetch(PDO::FETCH_OBJ);
    if ($checkEmail === FALSE) {
        $sql = "UPDATE personal_info SET email=? WHERE userID=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $UID]);
        echo "success personal info with email";
        $receiver = $email;
    } else {
        echo "success personal info without email";
        $failedMessage .= "<h3>You have change your e-mail to '$email' but it's already used and your e-mail won't change.</h3>";
        $SUCCESS = FALSE;
    }
    $sql = "SELECT displayName FROM personal_info WHERE displayName=? AND userID!=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$display_name, $UID]);
    $checkDisplayName = $stmt->fetch(PDO::FETCH_OBJ);
    if ($checkDisplayName === FALSE) {
        $sql = "UPDATE personal_info SET displayName=? WHERE userID=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$display_name, $UID]);
        echo "success display name";
    } else {
        $SUCCESS = FALSE;
        echo "fail display name";
        $failedMessage .= "<h3>You have change your display name to '$display_name' but it's already used and your display name won't change.</h3>";
    }
    
}
sendMail($receiver, ($SUCCESS?$successSubject:$failedSubject), ($SUCCESS?$successMessage:$failedMessage).$defaultMessage);
header('location:../profile.php');

?>