<?php include 'services/checkLogin.php' ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/header.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  </head>

  <body>

    <div id="banner"></div>
    <nav class="navbar navbar-light" style="background-color: white;">
      <div class="container"><div class="container-fluid">
        <div class="row">
          <div class="col-6">
          <a class="navbar-brand" href="../webwut">
            <img src="assets/image/logo.png" width="50" height="50" class="d-inline-block align-top" alt="">
            <font size="6" color="#f675b3">WEBWUT <b>Event</b></font>
          </a>
          </div>
          <div class="col-6 noPadding">
          <?php
          if ($LOGGEDIN) {
            $displayName = $_SESSION['displayName'];

            echo "Welcome, ". $displayName;
            ?>
            <?php
            if ($_SESSION['ROLE'] != "AD")
            echo '<a href="profile.php"><i class="material-icons" style="font-size:48px;color:#61b3cf">account_box</i></a>
            <a href="personalMessage.php"><i class="material-icons" style="font-size:48px;color:#df8a83">mail</i></a>';
            ?>
            <a href="services/doLogout.php"><button type="button" class="btn btn-light" id="btn-login" role="button">SIGN OUT</button></a>
            <?php
          } else {
            ?>
            <div id="bg-me">
              <a href="login.php"><button type="button" class="btn btn-light" id="btn-login" role="button">SIGN IN</button></a>
            </div>
            <?php
          }
          ?>
        </div>
      </div></div>
    </nav>
    <div id="fake-navbar"></div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
      $(window).scroll(function(){
          if ($(window).scrollTop() < 116) {
              $(".navbar").removeClass("fixed-top");
              $("#fake-navbar").hide();
          } else {
              $(".navbar").addClass("fixed-top");
              $("#fake-navbar").show();
          }
      });
    </script>

  </body>
</html>
