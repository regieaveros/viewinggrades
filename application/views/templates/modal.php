<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTitle">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Are you sure you want to delete?</h3>
            </div>
            <div class="modal-footer">
                <?= $form_delete;?>
                <input type="hidden" id="delete-id" name="id"/>
                <button type="submit" class="btn btn-danger text-uppercase font-weight-bold">
                    <span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Delete
                </button>
                <button type="button" class="btn btn-primary text-uppercase font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>