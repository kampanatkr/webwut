<div class="form-group row">
    <label for="event-name" class="col-sm-3 col-form-label">Event
        Name: <span class="required">*<span></label>
    <input type="text" class="col-sm-8 form-control" id="event-name"
           name="event-name"
           placeholder="Name"
           value="<?php echo $eventName ?>"
           required autofocus>
    <div class="invalid-feedback offset-sm-3">
        Please fill an event name.
    </div>
</div>