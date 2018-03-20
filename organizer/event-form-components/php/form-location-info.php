<div class="form-group row">
    <!-- Outdoor Location Name -->
    <label for="location"
           class="col-sm-3 col-form-label">Outdoor
        Location: <span class="required">*<span></label>
    <input type="text" class="col-sm-9 form-control"
           id="location"
           name="location"
           placeholder="Outdoor Location"
           value="<?php echo $location ?>"
           required>
    <div class="invalid-feedback offset-sm-3">
        Please fill a location address.
    </div>
</div>
