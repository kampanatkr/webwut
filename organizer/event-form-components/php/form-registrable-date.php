<?php $time = date('Y-m-d\TH:i:s', strtotime("+6 hours")); ?>
<div class="form-group row">
    <label for="event-registrable-date" class="col-sm-3 col-form-label">Registrable
        Date: <span class="required">*<span></label>
    <input type="datetime-local" class="col-sm-3 form-control"
           id="event-registrable-date"
           name="event-registrable-date"
        <?php if ($registrableDate !== null) { ?>
            disabled value="<?php echo $registrableDate; ?>"
        <?php } else { ?>
           min="<?php echo $time; ?>"
           value="<?php echo $time; ?>"
           onchange="<?php echo 'setDateTimeRules(0)'; } ?>"
           required>
    <div class="invalid-feedback offset-sm-3">
        Please select a proper start date.
    </div>
</div>