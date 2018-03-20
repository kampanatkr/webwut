<div class="form-group row">
    <label for="event-detail" class="col-sm-3 col-form-label">Event
        Detail: <span class="required">*<span></label>
    <textarea class="col-sm-9 form-control" id="event-detail"
              name="event-detail"
              rows="4"
              required><?php echo $detail ?></textarea>
    <div class="invalid-feedback offset-sm-3">
        Please describe a description about the event.
    </div>
</div>