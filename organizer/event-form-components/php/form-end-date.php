<?php $time = date('Y-m-d\TH:i:s', strtotime("+15 hours")); ?>
<div class="form-group row">
    <label for="event-end-date" class="col-sm-3 col-form-label">Event
        End Date: <span class="required">*<span></label>
    <input type="datetime-local" class="col-sm-3 form-control"
           id="event-end-date"
           name="event-end-date"
        <?php if ($endDate !== null) { ?>
            disabled value="<?php echo $endDate; ?>"
        <?php } else { ?>
           min="<?php echo $time; ?>"
           value="<?php echo $time; ?>"
           onchange="<?php echo 'setDateTimeRules(2)'; } ?>"
           required>
    <div class="invalid-feedback offset-sm-3">
        Please select a proper end date.
    </div>
</div>