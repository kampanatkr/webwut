<?php
    // include 'checkLogin.php';
    include 'header.php'; 
    $ISOWNER = TRUE;
    if ($LOGGEDIN) {
        $ROLE = $_SESSION['ROLE'];
        $UID = $_SESSION['ID'];
        if (array_key_exists('user', $_GET)) {
            $USER = $_GET['user'];
        }
    } else {
        if (!array_key_exists('user', $_GET)) {
            $_SESSION["PREV"] = "../profile.php";
            header('location:login.php');
        }
        $USER = $_GET['user'];
    }

    include 'services/connectDB.php';
    if (isset($conn)) {
        if (isset($USER)) {
            $sql = "SELECT * FROM personal_info WHERE displayName=?";
        } else {
            $sql = "SELECT * FROM personal_info WHERE userID=?";
            $USER = $UID;
        }
        

        $statement = $conn->prepare($sql); 
        $statement->execute([$USER]);
        $info = $statement->fetch(PDO::FETCH_OBJ);
        if ($info === FALSE) {
            header('location:oops.php');
        }
        $sql = "SELECT eventID, eventStart, eventEnd, eventName, location FROM event_attendant LEFT JOIN event USING (eventID) WHERE aID=?";
        $statement = $conn->prepare($sql); 
        $statement->execute([$USER]);
        $events = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach ($events as $event) {
            $event->prettydate = date("d/m/Y g:i A", strtotime($event->eventEnd));
            $event->prettydate1 = date("d/m/Y g:i A", strtotime($event->eventStart));
            $sql = "SELECT image FROM event_image WHERE eventID=?";
            $statement = $conn->prepare($sql); 
            $statement->execute([$event->eventID]);
            $images = $statement->fetchAll(PDO::FETCH_OBJ);
            $event->images = array();
            if ($images !== FALSE) {
                $event->images = $images;
            }
        }
        if (isset($info->userID) && $info->userID != $_SESSION['ID']) {
            $ISOWNER = FALSE;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <title>Document</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <?php ?>
    <div class="container content padding-top">
        <div class="row">
            <div class="col-12"><h1>Profile <?php echo $ISOWNER ? '<a href="profile-edit.php"><i class="far fa-edit"></i></a>' : ''; ?></h1><div>
        </div>
        <div class="row">
            <div class="col-md-4 col-12">
                <figure>
                    <?php
                    echo $ISOWNER ? '<form action="services/updateProfile.php" method="post" enctype="multipart/form-data">
                        <label for="image">' : '';
                    echo '<img id="shownImage" src="assets/users/'.($info->image ? $info->image : "nopic.png").'" style="border-radius: 25px; padding: 10px;" width="200" height="250">';
                    echo $ISOWNER ? '<img src="assets/image/clickme.png" id="clickme">
                            <figcaption>
                                <input type="file" name="image" id="image" accept="image/*" hidden onchange="form.submit();">
                            </figcaption>
                        </label>
                    </form>' : '';
                    ?>
                </figure>
            </div>
            <div class="col-md-8 col-12">
                <div class="row padding-top">
                    <div class="col-12"><h3>Name: <?php echo $info->firstName." ".$info->lastName; ?></h3></div>
                </div>
                <div class="row">
                    <div class="col-12"><h3>Gender: <?php echo $info->gender; ?></h3></div>
                </div>
                <div class="row">
                    <div class="col-12"><h3>Age: <?php echo $info->age; ?></h3></div>
                </div>
                <div class="row">
                    <div class="col-12"><h3>E-mail: <?php echo $info->email; ?></h3></div>
                </div>
                <div class="row">
                    <div class="col-12"><h3>Tel: <?php echo $info->phoneNo; ?></h3></div>
                </div>
            </div>
        </div>
        <div class="row" id="attended-event">
            <div class="col-lg-6 col-md-12" id="upcoming-events">
                <div class="row"><div class="col-12 text-centered"><h1>Upcoming Events</h1></div></div>
                <div class="row table-header row-with-centered-col">
                    <div class="col-5 text-centered">Event Name</div>
                    <div class="col-3 text-centered">Place</div>
                    <div class="col-3 text-centered">Date</div>
                </div>
                <no-event class="row table-row row-with-centered-col">
                    <div class="col-11 text-centered">No Event</div>
                </no-event>
            </div>
            <div class="col-lg-6 col-md-12" id="past-events">
                <div class="row"><div class="col-12 text-centered"><h1>Events You've Joined</h1></div></div>
                <div class="row table-header row-with-centered-col">
                    <div class="col-5 text-centered">Event Name</div>
                    <div class="col-3 text-centered">Place</div>
                    <div class="col-3 text-centered">Date</div>
                </div>
                <no-event class="row table-row row-with-centered-col">
                    <div class="col-11 text-centered">No Event</div>
                </no-event>
            </div>
        </div>
        <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="mymodalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src="">
                        <p id="modalLocation"></p>
                        <p id="modalDate"></p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary" id="detail-btn">More detail</a>
                    </div>
                </div>
            </div>
        </div>
    <div>
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        var events = <?php if ($events !== FALSE) echo json_encode($events); else echo "[]"; ?>;
        var past = [];
        var soon = [];
        var now = Date.now();
        function parseSQLdate(sqlDate) {
            sqlDate = sqlDate.replace(/:| /g,"-");
            var YMDhms = sqlDate.split("-");
            var jsDate = new Date();
            jsDate.setFullYear(parseInt(YMDhms[0]), parseInt(YMDhms[1])-1, parseInt(YMDhms[2]));
            jsDate.setHours(parseInt(YMDhms[3]), parseInt(YMDhms[4]), parseInt(YMDhms[5]), 0);
            return jsDate
        }
        for (event of events) {
            let date = parseSQLdate(event.eventEnd);
            if (date < now) {
                past.push(event);
                $("#past-events").append(`<div data-user="`+event.eventID+`" class="row table-row row-with-centered-col modal-toggler" data-toggle="modal" data-target="#mymodal">
                <div class="col-5 text-centered">`+event.eventName+`</div>
                <div class="col-3 text-centered">`+event.location+`</div>
                <div class="col-3 text-centered">`+event.prettydate1+" - "+event.prettydate+`</div>
                </div>`);
            }
            else {
                soon.push(event);
                $("#upcoming-events").append(`<div data-user="`+event.eventID+`" class="row table-row row-with-centered-col modal-toggler" data-toggle="modal" data-target="#mymodal">
                <div class="col-5 text-centered">`+event.eventName+`</div>
                <div class="col-3 text-centered">`+event.location+`</div>
                <div class="col-3 text-centered">`+event.prettydate1+" - "+event.prettydate+`</div>
                </div>`);
            }
        }        
        if (past.length > 0) {
            $('#past-events > no-event').hide();
        } else {
            $('#past-events > no-event').show();
        }
        if (soon.length > 0) {
            $('#upcoming-events > no-event').hide();
        } else {
            $('#upcoming-events > no-event').show();
        }

        $('.modal-toggler').on('click', (e)=>{
            let toggler = e.target;
            while (!toggler.className.includes("modal-toggler")) {
                toggler = toggler.parentNode
            }
            let eventID = $(toggler)[0].dataset['user']
            let evnt = null
            for (event of events) {
                if (event.eventID == eventID) evnt = event
            }
            $('#modalTitle').html(evnt.eventName)
            if (evnt.images.length > 0) {
                $('#modalImage').attr("src", "assets/events/"+evnt.images[0].image)
            }
            $('#modalLocation').html("Location: " + evnt.location)
            $('#modalDate').html("Date: " + evnt.prettydate)
            $('#detail-btn').attr("href", "event.php?id="+evnt.eventID)
        })
    </script>
</body>
</html>

