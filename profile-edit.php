<?php
    // include 'checkLogin.php';
    include 'header.php'; 
    $ISOWNER = TRUE;
    if ($LOGGEDIN) {
        $ROLE = $_SESSION['ROLE'];
        $USER = $_SESSION['ID'];
        if ($ROLE == 'OR') {
            header('location:index.php');
        }
        if ($ROLE == 'AD') {
            header('location:index.php');
        }
    } else {
        header('location:oops.php');
    }

    include 'services/connectDB.php';
    if (isset($conn)) {
        $sql = "SELECT firstName, lastName, displayName, email, phoneNo, image FROM personal_info WHERE userID=?";
        

        $statement = $conn->prepare($sql); 
        $statement->execute([$USER]);
        $info = $statement->fetch(PDO::FETCH_OBJ);
        if ($info === FALSE) {
            header('location:oops.html');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <?php ?>
    <div class="container content padding-top">
        <div class="row">
            <div class="col-12"><h1>Edit Profile</h1><div>
        </div>
        <form action="services/updateProfile.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 col-12">
                    <figure>
                        <label for="image">
                            <img id="shownImage" src="assets/users/<?php echo ($info->image ? $info->image : "nopic.png")?>" style="border-radius: 25px; padding: 10px;" width="200" height="250">
                            <img src="assets/image/clickme.png" id="clickme">
                            <figcaption>
                                <input type="file" name="image" id="image" accept="image/*" hidden value="<?php echo ($info->image ? "assets/users/".$info->image : "")?>">
                            </figcaption>
                        </label>
                    </figure>
                </div>
                <div class="col-md-8 col-12">
                    <div class="row padding-top">
                        <div class="col-4"><h3>First Name: </h3></div><div class="col-8"><input type="text" name="first_name" id="first_name" required value="<?php echo $info->firstName ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><h3>Last Name: </h3></div><div class="col-8"><input type="text" name="last_name" id="last_name" required value="<?php echo $info->lastName; ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><h3>Display Name: </h3></div><div class="col-8"><input type="text" name="display_name" id="display_name" required value="<?php echo $info->displayName; ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><h3>E-mail: </h3></div><div class="col-8"><input type="email" name="email" id="email" required value="<?php echo $info->email; ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><h3>Tel: </h3></div><div class="col-8"><input type="tel" name="tel" id="tel" required pattern="[0-9]{10}" value="<?php echo $info->phoneNo; ?>"></div>
                    </div>
                    <div class="row padding-top">
                        <div class="col-2"></div>
                        <div class="col-2"><a class="btn btn-outline-danger" href="profile.php">cancel</a></div>
                        <div class="col-2"><input class="btn btn-primary" type="submit" name="submit" id="submit" value="submit"></div>
                        <div class="col-6"></div>
                    </div>
                </div>
            </div>
        </form>
    <div>
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#shownImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>
</body>
</html>

