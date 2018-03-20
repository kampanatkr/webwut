<?php
    include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Personal Message</title>
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="personalMessage/css/messageStyle.css">
    
</head>
<body>   
    <div class="container" role="main">
        
        <!-- <link rel="import" href="header.php"> -->

        <div class="row" id="msg-form">
            <div class="col-12">
                <form id="message-sender" enctype="multipart/form-data">
                    <!-- user name -->
                    <span>Receiver: </span><input name="toID" type="text" id="toID" placeholder="Enter user ID"><br><br>

                    <!-- Enter Message -->
                    <textarea name="msg" id="msg-box" placeholder="Enter your message"></textarea><br>

                    <!-- attach image file -->
                    <label class="btnFile">Upload Image<input name="file" type="file" id="file" accept="image/*" hidden></label>

                    <!-- send button -->
                    <button class="btnSend" id="send">Send</button>
                    
                    <!-- show preview image -->
                    <div class="col-xs-12">
                        <img width="30%" id="preview" src="">
                    </div>
                </form>
                <button class="btnDeleteFile">Delete Image</button>
            </div>
        </div>

        <!-- snackbar: alert sending msg -->
        <div id="snackbar"></div>
        
        <!-- display msg -->
        <div class="row" id="displayMessage">
            <div class="col-xs-12 col-lg-6">
                <div class="row" id="header-box">
                    <div class="col">Inbox</div>
                </div>
                <div id="inbox"></div>
            </div>
            <div class="col-xs-12 col-lg-6">
                <div class="row" id="header-box">
                    <div class="col">Sent Message</div>
                </div>
                <div id="sentBox"></div>
            </div>
        </div>

    </div>


    <!-- Loading Scripts -->
    <!-- Bootstrap core JavaScript -->
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>

    <script src="personalMessage/js/messageScripts.js"></script>
</body>
</html>