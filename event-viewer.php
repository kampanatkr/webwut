<?php
require_once "header.php";

/*   login session >>>
 *  "ID" = orgID,
 *  "ROLE" = "OR",
 *  "displayName" = orgName
 * */

// Send them back to index if they're not organizer
if ($_SESSION["ROLE"] !== "OR") {
    header("Location: index.php");
}

// Send them back to org's homepage if they don't specify the event id they
// want to view
if (empty($_GET)) {
    header("Location: org-homepage.php");
}
// if not, create session for eventID
$_SESSION["eventID"] = $_GET["eid"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Loading CSS -->
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/organizer.css">
    <link rel="stylesheet" href="css/event.css">
    <link rel="stylesheet" href="css/comments.css">
    <script defer
            src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <title>Organizer | Event Viewer </title>
</head>
<body>
<?php
require_once "services/connectDB.php";
require_once "organizer/php-scripts/Event.php";
require_once "organizer/php-scripts/EventAttendee.php";

// loading a specific event data to view
// contains >> $event <<
require_once "organizer/php-scripts/event-viewer-loader.php";

$orgID = $event->getOrgID();
$sql = "SELECT `orgName` FROM `organizer_info` WHERE `userID`= $orgID";
$stmt = $conn->prepare($sql);
$stmt->execute();
$orgName = $stmt->fetch(PDO::FETCH_OBJ)->orgName;
?>

<div class="container">

    <div class="card mt-4 .bg-light content-box no-border-bottom">
        <img class="img-responsive img-thumbnail image-fit-contain p-2"
             src="<?php echo "assets/events/" . $event->getThumbnail(); ?>"
             alt="">
        <div class="card-body content-box">
            <h1 id="event-title"
                class="card-title"><?php echo $event->getEventName(); ?></h1>
            <h2 class="pl-4">&raquo; <?php echo $event->getEventType(); ?></h2>

            <p class="card-text pl-4"><i class="fa fa-clock-o fa-fw
            text-primary"></i>
                <?php echo
                    date("j F Y \a\\t H:i", $event->getStartDate())
                    . " - " .
                    date("j F Y \a\\t H:i", $event->getEndDate());
                ?>
            </p>
            <hr/>
            <p class="pl-4"><i class="fa fa-map-marker fa-fw text-primary"></i>
                <?php echo $event->getIndoorName() . ' &raquo; '
                    . $event->getLocation(); ?></p>
        </div>
    </div>
    <!-- /.card -->
    <br/>
    <div class=container-fluid id='bg'>
        <div class="card rounded">
            <h3 class="m-4">Details</h3>
            <p class="card-text pl-4">
                <span>Event Description: </span> <?php echo
                $event->getDetail();; ?>
                <br/>
                <br/>
                <!-- Get founder -->
                <span>Event Founder: </span> <?php echo $orgName; ?>
                <br/>
                <br/>
                <span>Created Date: </span><?php echo date("j F Y \a\\t H:i:s", $event->getCreateDate()); ?>
                <br/>
                <br/>
                <span>Registrable Date: </span><?php echo date("j F Y \a\\t H:i", $event->getRegistrableDate()); ?>
            </p>
        </div>
        <div class="card rounded margin-top">
            <h3 class="m-4">Condition</h3>
            <p class="card-text pl-4"><span>Age:</span> <?php echo
                $event->getAgeCondition(); ?>
                <br/>
                <br/>
                <span>Gender:</span> <?php echo $event->getGenderCondition(); ?>
                <br/>
                <br/>
                <span>Attending Cost:</span> <?php echo
                $event->getAttendingCostStr(); ?>
            </p>
        </div>
        <div class="card rounded margin-top">
            <h3 class="m-4">Survey Link</h3>
            <p class="card-text pl-4"><span>Survey Link: </span>
                <?php echo
                $event->getSurveyLink(); ?>
            </p>
        </div>

        <div class="card rounded margin-top">
            <h3 class="m-4" id="attendee">Attendees</h3>
            <?php if (count($event->getAttendees()) > 0) { ?>
                <p class="card-text pl-4"><span>Attendee participated:</span>
                </p>
                <div class="px-4 pb-4 table-responsive">
                    <?php require 'organizer/event-view-components/attendee-table.php'; ?>
                    <a class="btn btn
                    btn-primary button-modal"
                       href="organizer/php-scripts/pdf-export/exportPDFAttendees.php"
                       target="_blank">Export as PDF
                    </a>
                </div>
            <?php } else { ?>
                <p class="card-text pl-4"><span>No one participate :(</span></p>
            <?php } ?>

        </div>
    </div>
</div>
</body>
</html>
