<?php
// $events from org-homepage.php;
$attendees = $event->getAttendees();
?>
<table class="table">
    <thead>
    <tr class="table-primary">
        <th scope="col">#</th>
        <th>Event Name</th>
        <th>Event Type</th>
        <th>Event Detail</th>
        <th>Indoor Name</th>
        <th>Location Name</th>
        <th>Create Date</th>
        <th>Registrable Date</th>
        <th>Event Start</th>
        <th>Event End</th>
        <th>Age</th>
        <th>Gender</th>
        <th>AttendingCost</th>
        <th>Survey Form</th>
        <th>Reserved Entries</th>
        <th>Available Entries</th>
        <th>Total Entries</th>
    </tr>
    </thead>
    <tbody>
    <?php $index = 1;
    foreach ($events as $event) {
        $reservedEntries = count($event->getAttendees());
        $availableEntries = $event->getMaxEntries() - $reservedEntries;
        echo '<tr>';
        echo '<th scope="row">' . $index . '</th>';
        echo '<td>' . $event->getEventName() . '</td>';
        echo '<td>' . $event->getTypeStr() . '</td>';
        echo '<td>' . $event->getDetail() . '</td>';
        echo '<td>' . $event->getIndoorName() . '</td>';
        echo '<td>' . $event->getLocation() . '</td>';
        echo '<td>' . date("j F Y G:i", $event->getCreateDate()) . '</td>';
        echo '<td>' . date("j F Y G:i", $event->getRegistrableDate()) . '</td>';
        echo '<td>' . date("j F Y G:i", $event->getStartDate()) . '</td>';
        echo '<td>' . date("j F Y G:i", $event->getEndDate()) . '</td>';
        echo '<td>' . $event->getAgeCondition() . '</td>';
        echo '<td>' . $event->getGenderCondition() . '</td>';
        echo '<td>' . $event->getAttendingCostStr() . '</td>';
        echo '<td>' . $event->getSurveyLink() . '</td>';
        echo '<td>' . $reservedEntries. '</td>';
        echo '<td>' . $availableEntries . '</td>';
        echo '<td>' . $event->getMaxEntries() . '</td>';
        echo '</tr>';
        $index++;
    }
    ?>
    </tbody>
</table>