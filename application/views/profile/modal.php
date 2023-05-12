<div class="modal fade" id="profileImage" tabindex="-1" aria-labelledby="profileTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileTitle">Avatars</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Choose Your Avatar</h4>
                <div class="d-flex flex-wrap justify-content-center">
                    <?php
                        $avatars = array(
                            array(
                                'id' => 1,
                                'avatar' => base_url().'assets/dist/img/avatar1.png',
                                'value' => 'avatar1.png'
                            ),
                            array(
                                'id' => 2,
                                'avatar' => base_url().'assets/dist/img/avatar2.png',
                                'value' => 'avatar2.png'
                            ),
                            array(
                                'id' => 3,
                                'avatar' => base_url().'assets/dist/img/avatar3.png',
                                'value' => 'avatar3.png'
                            ),
                            array(
                                'id' => 4,
                                'avatar' => base_url().'assets/dist/img/avatar4.png',
                                'value' => 'avatar4.png'
                            ),
                            array(
                                'id' => 5,
                                'avatar' => base_url().'assets/dist/img/avatar5.png',
                                'value' => 'avatar5.png'
                            )
                        );  
                    ?>
                    <?php foreach($avatars as $avatar) { ?>
                        <button type="button" class="position-relative btn btn-light rounded-circle m-0 p-0 border shadow my-2 mx-2" value="<?= $avatar['value']?>">
                            <div class="avatar-layout" style="background-image:url('<?= $avatar['avatar']?>');"></div>
                            <div class="d-none avatar-check">
                                <i class="fas fa-check"></i>
                            </div>
                        </button>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="profile-image" />
                <button type="button" id="avatar-confirm" class="btn btn-info text-uppercase font-weight-bold">
                    Confirm
                </button>
                <button type="button" class="btn btn-primary text-uppercase font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>