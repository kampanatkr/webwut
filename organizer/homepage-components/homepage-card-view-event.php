<?php $eventID = $recentEvent->getEventID(); ?>

<a href="<?php echo "assets/events/" .
    $recentEvent->getThumbnail() ?>"
   data-toggle="modal"
   data-target="#viewModal-<?= $eventID ?>">
    <!-- Event Thumbnail -->
    <img class="image-640-360 image-fit-cover
                            img-thumbnail
                            rounded mb-3
                             mb-md-0"
         src="<?php echo "assets/events/" .
             $recentEvent->getThumbnail() ?>"/>
</a>

<!-- View Event Modal <?= $eventID ?> -->
<?php
$modalID = "viewModal-$eventID";
$modalTitle = "Viewing an event...";
$modalBody = "Do you want to view an event?";
$modalCancelButton = "<button type=\"button\" class=\"btn btn-secondary button-modal\"
                        data-dismiss=\"modal\">No</button>";
$modalConfirmButton = "<a class=\"btn btn-primary button-modal\" href=\"event-viewer.php?eid=$eventID\">Yes</a>";
require "organizer/php-scripts/modal.php"; ?>