<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/event.css">
    <link rel="stylesheet" href="css/comments.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
    <?php
    include 'header.php';
    if (!$LOGGEDIN) {
        $_SESSION["PREV"] = "../event.php" . (array_key_exists("id", $_GET) ? "?id=".$_GET['id'] :'');
        header('location:login.php');
    }
    if (!array_key_exists("id", $_GET)) {
        header('location:oops.php');
    }

    // Redirect if the user is ad or org
    if(!empty($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "OR"){
        header('location: index.php');
    }
    include 'services/connectDB.php';
    if (isset($conn)) {
        $eventID = $_GET['id'];
        $sql = "SELECT * FROM event WHERE eventID=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$eventID]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result !== FALSE) {
            $event = $result;
        } else {
            header('location:oops.php');
        }

        $event->eventStart = date("j F Y G:i", strtotime($event->eventStart));
        $event->eventEnd = date("j F Y G:i", strtotime($event->eventEnd));
        $sql = "SELECT image FROM event_image WHERE eventID=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $event->images = array();
        if ($result !== FALSE) {
            foreach ($result as $value) {
                $event->images[] = $value->image;
            }
        }
        $sql = "SELECT event_comment.userID, comment, date, role FROM event_comment JOIN user ON event_comment.userID=user.id WHERE eventID=? ORDER BY date";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $comments = array();
        if ($result !== FALSE) {
            foreach ($result as $value) {
                $value->date = date("d/m/Y g:i A", strtotime($value->date));
                $role = $value->role;
                $userID = $value->userID;
                if ($role == "AT") {
                    $sql = 'SELECT displayName,image FROM personal_info WHERE userID='.$userID;
                } else if ($role == "OR") {
                    $sql = 'SELECT orgName as displayName FROM organizer_info WHERE userID='.$userID;
                } else if ($role == "AD") {
                    $sql = 'SELECT userID as displayName FROM user WHERE id='.$userID;
                }
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $pinfo = $stmt->fetch(PDO::FETCH_OBJ);
                $displayName = $pinfo->displayName;
                $value->name = $displayName;
                $value->image = $pinfo->image;
                $comments[] = $value;
            }
        }
        $sql = 'SELECT age, gender FROM personal_info WHERE userID='.$_SESSION['ID'];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $info = $stmt->fetch(PDO::FETCH_OBJ);
        $PASS_CONDITION = TRUE;
        if ($info->age < $event->age) {
            $PASS_CONDITION = FALSE;
        }
        if ($event->gender != "all" && $event->gender != $info->gender) {
            $PASS_CONDITION = FALSE;
        }

        $sql = 'SELECT * FROM event_attendant WHERE aID='.$_SESSION['ID'].' AND eventID='.$_GET['id'];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $attended = $stmt->fetch(PDO::FETCH_OBJ);
        $ISATTENDED = FALSE;
        if ($attended !== FALSE) {
            $ISATTENDED = TRUE;
        }

        $sql = 'SELECT surveyLink FROM event_survey_link WHERE eventID='.$_GET['id'];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $survey_link = $stmt->fetch(PDO::FETCH_OBJ);
        if ($survey_link !== FALSE) {
            $survey_link = $survey_link->surveyLink;
        }

        $sql = 'SELECT orgName FROM organizer_info WHERE userID='.$event->orgID;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $orgName = $stmt->fetch(PDO::FETCH_OBJ)->orgName;

        
        $sql = 'SELECT count(*) as num FROM event_attendant WHERE eventID='.$eventID;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $num = $stmt->fetch(PDO::FETCH_OBJ)->num;
        
    }
    ?>
    <div class="container" id="main-content">
        <div class="col-12 padding-top" id="event">
            <div class="event-cover">
                <img class="img-responsive top-radius" style="height: 250px;" src="assets/events/<?php echo $event->images[0]; ?>">
            </div>
            <div class="content-box no-border-bottom">
                <h1 id="event-title">
                    <?php echo $event->eventName; ?>
                </h1>
                <div class="row" id="event-sub">
                    <div id="event-info" class="col-xs-12 col-sm-8">
                        <div id="event-time">
                            <i class="fa fa-clock-o fa-fw text-primary"></i><?php echo $event->eventStart." - ".$event->eventEnd; ?>
                        </div>
                        <hr>
                        <div id="event-location">
                            <toggle id="event-map-toggle" data-toggle="collapse" href="#event-map">
                                <i class="fa fa-map-marker fa-fw text-primary"></i>
                                <?php echo $event->location; ?>
                                <i class="fa fa-caret-down text-primary"></i>
                            </toggle>
                        </div>
                    </div>

                 <div class="col-xs-12 col-sm-4 text-right text-xs-center action-button">
                        <?php
                        if (!$ISATTENDED) {
                            echo '<a class="btn btn-secondary '.($PASS_CONDITION ? '' : 'disabled').'" id="top-buy-tickets-btn" data-scroll="true" href="#event-ticket">'.($event->price <= 0 ? "Get Tickets" : "Buy Ticket").'</a>';
                        } else {
                            if ($attended->flag != 1) {
                                echo '<a class="btn btn-secondary disabled">รอการยืนยัน</a>';
                            } else {
                                echo '<a class="btn btn-success disabled">เข้าร่วมแล้ว</a>';
                            }
                        }

                        ?>
                    </div>
                </div>
                <div id="event-map" class="collapse">
                    <div id="gmap"></div>
                </div>
            </div>

            <br>
            <div class=container-fluid id='bg'>
            <div id="event-detail" class="margin-top">
                <h3>Detail</h3>
                <p><?php echo $event->eventDetail ?></p>
                <p>Event Founder: <?php echo $orgName ?></p>
                <p>Capacity: <?php echo "$num/$event->capacity"; ?></p>
            </div>
            <div id="event-condition" >
                <h3>Condition</h3>
                <p>Age: <?php echo $event->age==-1? "All age" : $event->age." above" ?></p>
                <p>Gender: <?php echo $event->gender=="all"? "All Gender" : "Only ".$event->gender ?></p>
                <h4 style="color: <?php echo $PASS_CONDITION ? 'green' : 'red' ?>"><?php echo $PASS_CONDITION ? "YOU DO PASS ALL OF THE CONDITIONS." : "YOU DO NOT PASS ALL OF THE CONDITIONS." ?></h4>
            </div>
            <?php
            if (!$ISATTENDED) {
                echo $PASS_CONDITION ?
                '<div id="event-ticket" >
                    <h3>Tickets</h3>
                    <p>1 Ticket for '.($event->price==0? "Free" : $event->price." baht.").'</p>
                    <a class="btn btn-outline-primary '.($num >= $event->capacity? "disabled" : "").'" data-toggle="modal" data-target="#mymodal">'.($event->price==0? "Get" : "Buy").' one now</a>
                </div>':"";
            } else {
                if ($attended->flag != 1) {
                    echo '<div id="event-ticket" >
                    <h3>Tickets</h3>
                    <p>1 Ticket for '.($event->price==0? "Free" : $event->price." baht.").'</p>
                    <a class="btn btn-secondary disabled" id="btnStatus" >รอการยืนยัน</a></div>';
                } else {
                    echo '<div id="event-ticket" >
                    <h3>Tickets</h3>
                    <p>1 Ticket for '.($event->price==0? "Free" : $event->price." baht.").'</p>
                    <a class="btn btn-success disabled">เข้าร่วมแล้ว</a></div>';
                }
            }
            if ($ISATTENDED && $survey_link !== FALSE && $attended->flag==1) {
                echo '
                <div id="event-survey">
                    <h3>Survey</h3>
                    <a id="assessment" href="'.$survey_link.'">ทำแบบประเมินที่นี่</a>
                </div>
                ';
            }
            ?>
        </div></div>

        <br>
        <div id="comments">
            <?php include 'services/comments.php'; ?>
        </div>
        <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="mymodalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"><?php echo ($event->price==0? "Get" : "Buy"); ?> Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>1 Ticket for <?php echo ($event->price==0? "Free" : $event->price." baht."); ?></p>
                    </div>
                    <div class="modal-footer">
                        <?php
                        if ($event->price==0) {
                            echo '<form method="post" action="services/getTicket.php">';
                            echo '<label class="btn btn-primary" for="getTicket">'.($event->price==0? "Get" : "Buy").' Now</label>';
                            echo '<input type="submit" name="getTicket" id="getTicket" hidden value="submit">';
                            echo '<input type="text" name="eventID" id="eventID" hidden value="'.$_GET['id'].'">';
                            echo '</form>';
                        } else {
                            echo '<a class="btn btn-primary" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#buyModal">'.($event->price==0? "Get" : "Buy").' Now</a>';
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="buyTitle"><?php echo ($event->price==0? "Get" : "Buy"); ?> Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="services/buyTicket.php" method="post" enctype="multipart/form-data">
                            <label for="evidence" class="btn btn-primary" >UPLOAD หลักฐานการจ่ายเงิน</label>
                            <input type="file" name="evidence" id="evidence" accept="image/*" hidden onchange="form.submit();">
                            <input type="text" name="eventID" id="eventID" hidden value="<?php echo $_GET['id']; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function initMap() {
            gmap = document.getElementById('gmap');
            geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(gmap, {
                center: {lat: -34.397, lng: 150.644},
                zoom: 15
            });

            google.maps.event.addListenerOnce(map, 'idle', codeAddress);
        }

        function codeAddress() {

            var address = '<?php echo $event->location; ?>';

            geocoder.geocode({
                'address': address
            }, function (results, status) {

                if (status == google.maps.GeocoderStatus.OK) {

                    // Center map on location
                    map.setCenter(results[0].geometry.location);

                    // Add marker on location
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });

                } else {
                    gmap.innerHTML = '';
                    gmap.style.display = "none";
                }
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8OKwMaEJnFUsBBoHsvaHF_cvYoXbJydM&callback=initMap" async defer></script>
</body>
</html>
<?php include 'footer.php';?>
