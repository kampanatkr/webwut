<?php
    include("./connectDB.php");

    $username = $_POST['userID'];
    $password = crypt($_POST['pwd'], '$webwut$');
    $con_password =  $password;
    $displayName = $_POST['displayName'];
    $firstname = $_POST['fName'];
    $lastname = $_POST['lName'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $mobile_no = $_POST['phone'];
    $gender = $_POST['gender'];
    $role = 'AT';


    //sql check username & email ไม่ซ้ำ
    $query_check = "SELECT * FROM `personal_info` LEFT JOIN `user` ON personal_info.userID = user.id 
        WHERE personal_info.email='".$email."' AND user.userID='".$username."'";
    $statement_check = $conn->query($query_check);
    $row_check = $statement_check->fetchAll(PDO::FETCH_OBJ);

    //empty filled
    if ($username != "" && $password != "" && $con_password != "" && $firstname != "" && $lastname != "" && $email != "" && $age != "" && $gender != "" && $mobile_no != "") {
        if (sizeof($row_check) > 0) {
            echo "username and email has already !!";
        } else {
            if ($password != $con_password) {
                echo "The confirm password does not match password" ;
            } else {
                $query1 = "INSERT INTO `user` (`userID`,`password`,`role`) 
                    VALUES ('".$username."','".$password."','".$role."')";
                //insert USERNAME to DB
                $statement = $conn->exec($query1);
                $userID = $conn->lastInsertId();
                $query2 = "INSERT INTO `personal_info` (`userID`, `displayName`, `firstName`,`lastName`,`age`,`email`,`phoneNo`,`gender`) 
                    VALUES ('$userID', '".$displayName."','".$firstname."','".$lastname."','".$age."','".$email."','".$mobile_no."','".$gender."')";
                //insert INFO to DB
                $statement = $conn->exec($query2);
                echo " ---create new attendant--- ";
            }
        }
    } else {
        echo "Please fill data !!";
    }

?>