<div class="form-group row align-items-center">
    <label for="preconditions"
           class="col-sm-3 col-form-label">Preconditions: <span class="required">*<span></label>
    <!-- Wrapper -->
    <div class="col-sm-9 row">
        <!-- Age -->
        <div class="col-sm-4 input-group p-0">
            <div class="custom-control custom-checkbox m-2">
                <input type="checkbox" class="custom-control-input"
                       id="age-checkbox" name="age" value="-1"
                       checked>
                <label class="custom-control-label"
                       for="age-checkbox">Any Age</label>
            </div>
            <input type="number" class="form-control" id="age"
                   name="age"
                   placeholder="Age" min="12" max="130" required
                   disabled>
            <div class="invalid-feedback">
                Please specify a proper minimum age. (12-130)
            </div>
        </div>
        <!-- Gender -->
        <div class="col-sm-7 offset-sm-1 input-group p-0">
            <div class="form-check form-check-inline">
                <label class="form-check-label"
                       for="all-gender">Gender:</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="gender"
                       id="all-gender" value="all" checked>
                <label class="form-check-label" for="all-gender">All
                    Gender</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="gender"
                       id="male" value="male">
                <label class="form-check-label" for="male">Male
                    Only</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="gender"
                       id="female" value="female">
                <label class="form-check-label" for="female">Female
                    Only</label>
            </div>
        </div>
    </div>
</div>