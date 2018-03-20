<div class="form-group row align-items-center">
    <label class="col-sm-3 col-form-label" for="event-selector">Type
        of Event: <span class="required">*<span></label>
    <select class="col-sm-3 custom-select" id="event-selector"
            name="event-selector" required>
        <option value="">Choose...</option>
        <?php
        $options = array("Business", "Community", "Education", "Health", "Hobbies", "Music", "Science", "Sports");
        foreach ($options as $option) {
            $displayValue = $option;
            if ($option === "Science") {
                $displayValue = "Science & Techonology";
            }
            if ($option == $type) {
                echo "<option value =\"$option\" selected>$displayValue</option>";
            } else {
                echo "<option value =\"$option\">$displayValue</option>";
            }
        }
        ?>
    </select>

    <div class="invalid-feedback offset-sm-3">
        Please select a type of the event.
    </div>
</div>