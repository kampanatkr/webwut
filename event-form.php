<?php
require_once "header.php";
/*   login session >>>
 *  "ID" = orgID,
 *  "ROLE" = "OR",
 *  "displayName" = orgName
 */

// Send them back to index if they're not organizer
if($_SESSION["ROLE"] !== "OR"){
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
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/organizer.css">

    <title>Organizer | Event Form </title>
</head>
<body>
<?php
// loading event data to edit in "Edit" case
require_once "organizer/event-form-components/php/form-cache.php";
?>

<!-- Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="headings my-4 p-4"><?php echo $headings ?></h1>
    <!-- Wrapper -->
    <div class="event-wrapper p-4">
        <!-- form -->
        <form class="col-10 offset-1 needs-validation" method="post"
              enctype="multipart/form-data"
              action="organizer/php-scripts/event-creator.php" novalidate>
            <!-- Event Name -->
            <?php require "organizer/event-form-components/php/form-name.php" ?>
            <!-- Type of Event -->
            <?php require "organizer/event-form-components/php/form-type.php" ?>
            <!-- Event Detail -->
            <?php require "organizer/event-form-components/php/form-detail.php" ?>
            <!-- Event Thumbnail -->
            <?php require "organizer/event-form-components/php/form-thumbnail.php" ?>
            <!-- Registrable Date -->
            <?php require "organizer/event-form-components/php/form-registrable-date.php" ?>
            <!-- Start Date -->
            <?php require "organizer/event-form-components/php/form-start-date.php" ?>
            <!-- End Date -->
            <?php require "organizer/event-form-components/php/form-end-date.php" ?>
            <!-- Event Entries -->
            <?php require "organizer/event-form-components/php/form-entries.php" ?>
            <!-- Event Preconditions -->
            <?php require "organizer/event-form-components/php/form-preconditions.php" ?>
            <!-- Attending Cost -->
            <?php require "organizer/event-form-components/php/form-attending-cost.php" ?>
            <!-- GG Map -->
            <?php require "organizer/event-form-components/php/form-map.php" ?>
            <!-- Indoor Name -->
            <?php require "organizer/event-form-components/php/form-indoor-name.php" ?>
            <!-- Location -->
            <?php require "organizer/event-form-components/php/form-location-info.php" ?>
            <!-- Survey Link -->
            <?php require "organizer/event-form-components/php/form-survey-link.php" ?>
            <!-- Submit -->
            <?php require "organizer/event-form-components/php/form-submit.php" ?>
            <!-- /.form -->
        </form>
        <!-- /.wrapper -->
    </div>
    <!-- /.container -->
</div>

<!-- Loading Additional Scripts -->
<!-- Google Maps JS API -->
<!-- Map Marker -->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFDllUC_ofU2tABnCon3X-WUfPtjS4H_o&callback=initMap">
</script>
<script src="organizer/event-form-components/js/google-marker.js"></script>

<!-- Form Validator-->
<script src="organizer/event-form-components/js/form-validator.js"></script>
<!-- Form Thumbnail Preview-->
<script src="organizer/event-form-components/js/form-thumbnail-preview.js"></script>
<!-- Form Checkbox -->
<script src="organizer/event-form-components/js/form-checkbox.js"></script>
<!-- Form Modal -->
<script src="organizer/event-form-components/js/form-modal.js"></script>
<!-- Form date -->
<script src="organizer/event-form-components/js/form-date.js"></script>
</body>
</html>


