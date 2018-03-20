<?php
// $event from event-viewer.php;
$attendees = $event->getAttendees();
?>
<table class="table">
    <thead>
    <tr class="table-primary">

        <th scope="col">#</th>
        <th>Attendee Name</th>
        <th>Attendee Email</th>
        <th>Registered At</th>
        <?php
        if ($event->getAttendingCost() !== 0) {
            echo '<th>Payment Status</th>';
            echo '<th>Payment Evidence</th>';
            echo '<th colspan="2">Verdict</th>';
        }
        ?>
    </thead>
    <tbody>
    <?php $index = 1;
    foreach ($attendees as $attendee) {
        echo '<tr>';
        echo '<th scope="row">' . $index . '</th>';
        echo '<td>' . $attendee->getAttendeeName() . '</td>';
        echo '<td>' . $attendee->getEmail() . '</td>';
        echo '<td>' . $attendee->getRegisterStamp() . '</td>';
        if ($event->getAttendingCost() !== 0) {
            $approved = ($attendee->getFlag());
            $disableButton = $approved ? "disabled" : "";
            echo '<td>' . $attendee->getPaymentStatus() . '</td>';
            echo '<td><a href="" data-toggle="modal" data-target="#evidence-pic">
            ' . $attendee->getEvidence() . '</a></td>';
            echo '<td><button class="btn btn-primary button-modal" data-toggle="modal" 
data-target="#approve-request" ' . $disableButton . '>Approve
</button></td>';
            echo '<td><button class="btn btn-secondary button-modal" data-toggle="modal" 
data-target="#reject-request" ' . $disableButton . ' >Reject</button></td>';
        }
        echo '</tr>';
        $index++;
    }
    ?>
    </tbody>
</table>


<!-- Evidence Modal -->
<div class="modal fade" id="evidence-pic" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php echo $attendee->getEvidenceLink() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary button-modal"
                        data-dismiss="modal">Okay
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approve-request" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Do you want to APPROVE this request?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary button-modal"
                        data-dismiss="modal">Cancel
                </button>
                <?php
                $aID = $attendee->getAttendeeID();
                $eID = $event->getEVentID();
                $acceptLink = "organizer/php-scripts/request-manipulator.php?request=1&aid=$aID&eid=$eID"
                ?>
                <a class="btn btn-primary button-modal"
                   href="<?php echo $acceptLink ?>">Confirm
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="reject-request" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Do you want to REJECT this request?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary button-modal"
                        data-dismiss="modal">Cancel
                </button>
                <?php
                $aID = $attendee->getAttendeeID();
                $rejectLink = "organizer/php-scripts/request-manipulator.php?request=0&aid=$aID&eid=$eID"
                ?>
                <a class="btn btn-primary button-modal"
                   href="<?php echo $rejectLink ?>">Confirm
                </a>
            </div>
        </div>
    </div>
</div>