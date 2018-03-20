<div class="form-group row">
    <label for="max-entries" class="col-sm-3 col-form-label">Maximum
        Entries: <span class="required">*<span></label>
    <input type="number" class="col-sm-3 form-control"
           id="max-entries"
           name="max-entries"
           placeholder="Entries" min="1" max="999"
        <?php
        if ($maxEntries !== null) {
            echo "value=$maxEntries" ?> disabled <?php } ?>
           required>
    <div class="invalid-feedback offset-sm-3">
        Please specify a proper maximum entries. (1-999)
    </div>
</div>