<div class="modal fade" id="<?php echo $modalID ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php
                    echo $modalTitle
                    ?></h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $modalBody ?>
            </div>
            <div class="modal-footer">
                <?php echo $modalCancelButton ?>
                <?php echo $modalConfirmButton ?>
            </div>
        </div>
    </div>
</div>