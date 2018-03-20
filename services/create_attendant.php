<?php
    include("./connectDB.php");
    session_start();
    $username = $_POST['reg_username'];
    $password = crypt($_POST['reg_password'], '$webwut$');
    $con_password = crypt($_POST['reg_password_confirm'], '$webwut$');
    $displayname = $_POST['reg_displayname'];
    $firstname = $_POST['reg_fullname'];
    $lastname = $_POST['reg_lastname'];
    $age = $_POST['reg_age'];
    $email = $_POST['reg_email'];
    $mobile_no = $_POST['reg_mobile_no'];
    $gender = $_POST['reg_gender'];
    $role = 'AT';


    //sql check username & email ไม่ซ้ำ
    $query_check = "SELECT * FROM `personal_info` LEFT JOIN `user` ON personal_info.userID = user.id
        WHERE personal_info.email='".$email."' AND user.userID='".$username."' AND personal_info.displayName='".$displayname."'";
    $statement_check = $conn->query($query_check);
    $row_check = $statement_check->fetchAll(PDO::FETCH_OBJ);

    //empty filled
    if ($username != "" && $password != "" && $con_password != "" && $displayname != "" && $firstname != "" && $lastname != "" && $email != "" && $age != "" && $gender != "" && $mobile_no != "") {
        if (sizeof($row_check) > 0) {
            echo "2";
            // echo "username and email has already !!";
        } else {
            if ($password != $con_password) {
                echo "3" ;
                // echo "The confirm password does not match password" ;
            } else {
                $query1 = "INSERT INTO `user` (`userID`,`password`,`role`)
                    VALUES ('".$username."','".$password."','".$role."')";
                //insert USERNAME to DB
                $statement = $conn->exec($query1);
                $userID = $conn->lastInsertId();
                $query2 = "INSERT INTO `personal_info` (`userID`, `displayName`, `firstName`,`lastName`,`age`,`email`,`phoneNo`,`gender`)
                    VALUES ('$userID','".$displayname."' ,'".$firstname."','".$lastname."','".$age."','".$email."','".$mobile_no."','".$gender."')";
                //insert INFO to DB
                $statement = $conn->exec($query2);
                $_SESSION['ID'] = $userID;
                $_SESSION['ROLE'] = "AT";
                $_SESSION['displayName'] = $displayname;
                echo "0";
            }
        }
    } else {
        echo "1";
    }

?>
