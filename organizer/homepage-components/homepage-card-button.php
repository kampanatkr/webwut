<?php $eventID = $recentEvent->getEventID(); ?>
<div>
    <!-- Edit Event Button -->
    <button type="button" class="btn btn-primary m-1 edit-event"
            data-toggle="modal"
            data-target="#editModal<?php echo "-$eventID"?>">
        Edit Event
    </button>
    <!-- Delete Event Button -->
    <button type="button" class="btn btn-primary m-1 delete-event"
            data-toggle="modal"
            data-target="#deleteModal<?php echo "-$eventID"?>">
        Delete Event
    </button>
</div>

<!-- Edit Event Modal -->
<?php
$modalID = "editModal-$eventID";
$modalTitle = "Editing an event...";
$modalBody = "Do you want to edit an event?";
$modalCancelButton = "<button type=\"button\" class=\"btn btn-secondary button-modal\"
                        data-dismiss=\"modal\">No</button>";
$modalConfirmButton = "<a class=\"btn btn-primary button-modal\" 
href=\"event-form.php?eid=$eventID\">Yes</a>";
require "organizer/php-scripts/modal.php"; ?>


<!-- Delete Event Modal -->
<?php
$modalID = "deleteModal-$eventID";
$attendeeParticipated = count($recentEvent->getAttendees());
if(count($recentEvent->getAttendees()) > 0){
    // Case 1: contains any attendees: Cannot be removed
    $modalTitle = "Could not delete an event...";
    $modalBody = "You cannot delete an event if there was any attendee.";
    $modalCancelButton = "";
    $modalConfirmButton = "<button type=\"button\" class=\"btn btn-primary button-modal\" 
                        data-dismiss=\"modal\">Okay</button>";
} else {
    // Case 2: No attendee: Can be removed
    $modalTitle = "Deleting an event...";
    $modalBody = "Are you sure you want to delete an event?";
    $modalCancelButton = "<button type=\"button\" class=\"btn btn-secondary button-modal\" 
                        data-dismiss=\"modal\">No</button>";
    $modalConfirmButton = "<a class=\"btn btn-primary button-modal\" href=\"organizer/php-scripts/event-remover.php?eid=$eventID\">Yes</a>";
}

require "organizer/php-scripts/modal.php";
?>