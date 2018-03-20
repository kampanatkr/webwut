<div class="form-group row col-sm-8 offset-sm-2">
    <div class="col-centered">
        <!-- Confirm Button -->
        <button type="button" class="btn btn-primary button-modal"
                data-toggle="modal"
                data-target="#confirmModal">
            Confirm
        </button>
        <!-- Cancel Button -->
        <button type="button" class="btn btn-primary button-modal"
                data-toggle="modal"
                data-target="#cancelModal">
            Cancel
        </button>
    </div>
</div>

<!-- Confirm Modal -->
<?php
$modalID = "confirmModal";
$modalTitle = "Confirming...";
$modalBody = "Do you want to confirm your progress?";
$modalCancelButton = "<button type=\"button\" class=\"btn btn-secondary button-modal\"
                        data-dismiss=\"modal\">No</button>";
$modalConfirmButton = "<button type=\"submit\" class=\"btn btn-primary button-modal\"
                        onclick=\"closeSubmitModal()\">Yes</button>";
require 'organizer/php-scripts/modal.php'; ?>
<!-- Cancel Modal -->
<?php
$modalID = "cancelModal";
$modalTitle = "Canceling...";
$modalBody = "Do you want to cancel your progress?";
$modalCancelButton = "<button type=\"button\" class=\"btn btn-secondary button-modal\" 
                        data-dismiss=\"modal\">No</button>";
$modalConfirmButton = "<a class=\"btn btn-primary button-modal\" href=\"org-homepage.php\">Yes</a>";
require 'organizer/php-scripts/modal.php';
?>