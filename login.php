<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
</head>
<body>
    <?php
        session_start();

        if (array_key_exists("e", $_GET)) {
            if ($_GET['e']==1) {
                ?>
                <div class="alert alert-light alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning</strong> Incorrect Username and/or Password
                </div>
                <?php
            } else if ($_GET['e']==2) {
                ?>
                <div class="alert alert-light alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning</strong> Please login first.
                </div>
                <?php
            }
        }
    ?>
    
    <div class="text-center">
        <div class="text-center"><span><img src="assets/image/logo.png" width="80" height="80" class="d-inline-block align-top"></span></div>
        <div class="logo text-center">Sign In</div>
        <!-- Main Form -->
            <div class="login-form-1">
                <form id="login-form" class="text-left" action="services/doLogin.php" method="post">
                    <div class="login-form-main-message"></div>
                    <div class="main-login-form">
                        <div class="login-group">
                            <div class="form-group">
                                <label for="lg_username" class="sr-only">Username</label>
                                <input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username">
                            </div>
                            <div class="form-group">
                                <label for="lg_password" class="sr-only">Password</label>
                                <input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
                            </div>
                            <div>
                                <label class="btn login-button" for="submit_button"><i class="fa fa-chevron-right"><input type="submit" name="submit_button" id="submit_button" hidden></i></label>
                            </div>
                            <div class="etc-login-form">
                                <p><a href="login/regis_attendant.php"><span class="ion-person-add"></span> create new attendant</a></p>
                                <p><a href="login/regis_organizer.php"><span class="ion-person-stalker"></span> create new organizer</a></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
</body>
</html>