<?php
require_once "header.php";

/*   login session >>>
 *  "ID" = orgID,
 *  "ROLE" = "OR",
 *  "displayName" = orgName
 * */

if ($_SESSION["ROLE"] !== "OR") {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Loading CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/organizer.css">

    <title>Organizer | Event Homepage</title>
</head>
<body>

<?php
require_once "services/connectDB.php";
require_once "organizer/php-scripts/Event.php";
require_once "organizer/php-scripts/EventAttendee.php";

// get $events element
require_once "organizer/php-scripts/event-homepage-loader.php";
$hasData = count($events) > 0;

// If unset eventID in session
if (isset($_SESSION["eventID"]) && !empty($_SESSION["eventID"])) {
    unset($_SESSION["eventID"]);
}
?>

<!-- Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="headings my-4 p-4">Events
        <small>from Organizer
            &raquo; <?php echo $_SESSION["displayName"] ?></small>
    </h1>

    <!-- Wrapper -->
    <div class="row">
        <!-- Add Events Button-->
        <div class="col-md-3 p-4">
            <div class="row">
                <button type="button"
                        class="btn btn-primary btn-lg btn-block p-3"
                        id="add-event-btn" data-toggle="modal"
                        data-target="#addEventModal">Add Event
                </button>
                <h4 class="col-12">View Event as:</h4>
                <div class="btn-group col-12" role="group"
                     aria-label="Basic example">
                    <button type="button" class="btn btn
                    btn-primary button-modal col-4"
                            onclick="viewCard()">Card
                    </button>
                    <button type="button" class="btn btn
                    btn-secondary button-modal col-4"
                            onclick="viewTable()">Table
                    </button>
                    <a class="btn btn
                    btn-primary button-modal col-4"
                       href="organizer/php-scripts/pdf-export/exportPDFOrgEvents.php"
                       target="_blank">PDF
                    </a>
                </div>
            </div>
            <!-- Add Event Modal -->
            <?php
            $modalID = "addEventModal";
            $modalTitle = "Adding Event...";
            $modalBody = "Do you want to add a new event??";
            $modalCancelButton = "<button type=\"button\" class=\"btn btn-secondary button-modal\" 
                        data-dismiss=\"modal\">No</button>";
            $modalConfirmButton = "<a class=\"btn btn-primary button-modal\" href=\"event-form.php\">Yes</a>";
            require "organizer/php-scripts/modal.php"; ?>
        </div>
        <!-- Events holder-->
        <div class="col-md-9 mx-auto p-4 container-fluid row <?php if (!$hasData) echo "invisible"; ?>">
            <div id="card-wrapper" class="container-fluid">
                <?php
                for ($i = 0; $i < count($events); $i++) { ?>
                    <!-- Event <?php echo $i + 1 ?> -->
                    <?php $recentEvent = $events[$i]; ?>
                    <div class="event-holder p-4">
                        <?php require "organizer/homepage-components/homepage-card.php"; ?>
                        <!-- /.event card holder -->
                    </div>
                <?php } ?>
            </div>
            <div id="table-wrapper" class="event-holder pb-4 table-responsive"
                 style="display: none">
                <?php require "organizer/homepage-components/homepage-table.php"; ?>
                <!-- /.event table holder -->
            </div>
            <!-- /.Event Holder -->
        </div>
        <!-- /.Wrapper -->
    </div>
    <!-- /.container -->
</div>
<script>
    function viewCard() {
        document.getElementById("card-wrapper").style.display = "block";
        document.getElementById("table-wrapper").style.display = "none";
    }

    function viewTable() {
        document.getElementById("card-wrapper").style.display = "none";
        document.getElementById("table-wrapper").style.display = "block";
    }
</script>
</body>
</html>