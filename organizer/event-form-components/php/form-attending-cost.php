<div class="form-group row align-items-center">
    <label for="attending-cost" class="col-sm-3 col-form-label">Attending
        Cost: <span class="required">*<span></label>
    <div class="col-sm-3 input-group p-0">
        <div class="custom-control custom-checkbox m-2">
            <input type="checkbox" class="custom-control-input"
                   id="attending-cost-free-checkbox"
                   name="attending-cost"
                   value="0" checked>
            <label class="custom-control-label"
                   for="attending-cost-free-checkbox">Free</label>
        </div>
        <input type="number" class="form-control"
               id="attending-cost"
               name="attending-cost"
               min="1" placeholder="Price" required disabled>
        <div class="input-group-append">
            <div class="input-group-text">฿</div>
        </div>
        <div class="invalid-feedback">
            Please specify a cost to attend the event.
        </div>
    </div>
</div>