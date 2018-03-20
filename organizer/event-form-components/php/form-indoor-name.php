<div class="form-group row">
    <label for="indoor-name"
           class="col-sm-3 col-form-label">Indoor name: <span class="required">*<span></label>
    <input type="text" class="col-sm-9 form-control"
           id="indoor-name"
           name="indoor-name"
           placeholder="Indoor name"
           value="<?php echo $indoorName ?>"
           required>

    <div class="invalid-feedback offset-sm-3">
        Please fill an indoor location name.
    </div>
</div>
