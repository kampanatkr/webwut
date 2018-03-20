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
        <div class="logo">New Attendant</div>
        <!-- Main Form -->
        <div class="login-form-1">
            <form id="register-form" class="text-left" >
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                    <div class="login-group">
                        <div class="form-group">
                            <label for="reg_username" class="form-control">Username :</label>
                            <input type="text" required minlength="3" maxlength="16" class="form-control" id="reg_username" name="reg_username" placeholder="username">
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
                            <label for="reg_displayname" class="form-control">Display Name :</label>
                            <input type="text" required class="form-control" id="reg_displayname" name="reg_displayname" placeholder="display name">
                        </div>
                        <div class="form-group">
                            <label for="reg_firstname" class="form-control">First Name :</label>
                            <input type="text" required class="form-control" id="reg_firstname" name="reg_firstname" placeholder="first name">
                        </div>
                        <div class="form-group">
                            <label for="reg_lastname" class="form-control">Surname :</label>
                            <input type="text" required class="form-control" id="reg_lastname" name="reg_lastname" placeholder="surname">
                        </div>
                        <div class="form-group">
                            <label for="reg_age" class="form-control">Age :</label>
                            <input type="number" required min="1" max="150" class="form-control" id="reg_age" name="reg_age" placeholder="age">
                        </div>
                        <div class="form-group">
                            <label for="reg_email" class="form-control">Email Address :</label>
                            <input type="email" required class="form-control" id="reg_email" name="reg_email" placeholder="email address">
                        </div>
                        <div class="form-group">
                            <label for="reg_mobile_no" class="form-control">Mobile Number :</label>
                            <input type="tel" required pattern="[0-9]{10}" class="form-control" id="reg_mobile_no" name="reg_mobile_no" placeholder="mobile number">
                        </div>                          
                        <div class="form-group login-group-checkbox ">
                            <input type="radio" class="form-control" name="reg_gender" id="male" placeholder="username" value="male" checked="checked">
                            <label for="male">male</label>
                            <input type="radio" class="form-control" name="reg_gender" id="female" placeholder="username" value="female">
                            <label for="female">female</label>
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
    <script src="add_at.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</body>
</html>