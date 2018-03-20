<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/loginStyle.css">
</head>
<body>
    <?php
        session_start();
    ?>
    <div class="text-center">
        <div class="logo">New Organizer</div>
        <!-- Main Form -->
        <div class="login-form-1">
            <form id="register-form" class="text-left">
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                    <div class="login-group">
                        <div class="form-group">
                            <label for="reg_username" class="form-control">Username :</label>
                            <input type="text" required minlength="3" maxlength="16" class="form-control" id="reg_username" name="reg_username" placeholder="username" value="">
                        </div>
                        <div class="form-group">
                            <label for="reg_password" class="form-control">Password :</label>
                            <input type="password" required minlength="3" maxlength="16" class="form-control" id="reg_password" name="reg_password" placeholder="password">
                        </div>
                        <div class="form-group">
                            <label for="reg_password_confirm" class="form-control">Password Confirm :</label>
                            <input type="password" required class="form-control" id="reg_password_confirm" name="reg_password_confirm" placeholder="confirm password">
                        </div>
                        <div class="form-group">
                            <label for="reg_orgname" class="form-control">Organization Name :</label>
                            <input type="text" required class="form-control" id="reg_orgname" name="reg_orgname" placeholder="organization name">
                        </div>
                        <div class="form-group">
                            <label for="reg_email" class="form-control">Email Address:</label>
                            <input type="email" required class="form-control" id="reg_email" name="reg_email" placeholder="email address">
                        </div>
                        <div class="form-group">
                            <label for="reg_mobile_no" class="form-control">Mobile number :</label>
                            <input type="tel" required pattern="[0-9]{10}" class="form-control" id="reg_mobile_no" name="reg_mobile_no" placeholder="mobile number">
                        </div>
                    </div>
                    <label class="btn login-button" for="submit_button"><i class="fa fa-chevron-right"><input type="submit" name="submit_button" id="submit_button" hidden></i></label>
                </div>
                <div class="etc-login-form">
                    <p>already have an account? <a href="../login.php">login</a></p>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"
            integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i"
            crossorigin="anonymous">
    </script>
    <script src="add_org.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</body>
</html>