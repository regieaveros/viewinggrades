<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
                    <?= validation_errors();?>
                </div>
            </div>
        </div>
    </div>
    <section class="content pb-3">
        <div class="container-fluid">
            <?= $form_edit;?>
            <div class="form-row">
                <div class="col-sm-6">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="avatar-profile shadow rounded-circle" style="background-image:url('<?= base_url();?>assets/dist/img/default.png');"></div>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="hidden" name="image" value="<?= $this->session->avatar;?>" />
                        <button class="form-control btn btn-primary" type="button" data-toggle="modal" data-target="#profileImage">Choose Avatar</button>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Student Name:</label>
                        <input 
                            class="form-control" 
                            type="text" 
                            name="name"
                            placeholder="Enter a name"
                            value="<?= $this->session->name;?>" 
                        />
                    </div>
                    <div class="form-group col-md-12">
                        <label>Email:</label>
                        <input 
                            class="form-control" 
                            type="email"
                            name="email"
                            placeholder="Enter a email"
                            value="<?= $this->session->email;?>" 
                        />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="my-2">
                        <h4 class="ml-2">Change Password</h4>
                        <hr class="ml-2">
                        <div class="form-group col-sm-12">
                            <label>Toggle Password:</label>
                            <input type="hidden" name="toggle-password" />
                            <div class="d-block btn-group btn-group-sm" role="group" aria-label="Toggle Button">
                                <button id="btn-off" type="button" class="btn btn-info">OFF</button>
                                <button id="btn-on" type="button" class="btn btn-secondary" value="on">ON</button>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>New Password:</label>  
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-secondary" type="button" id="toggle_password">
                                        <i id="visibility" class="fas fa-eye-slash" style="width: 25px;"></i>
                                    </button>
                                </div>
                                <input 
                                    class="form-control" 
                                    type="password"
                                    name="password"
                                    id="password"
                                    placeholder="Enter new password"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Confirm Password:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-secondary" type="button" id="confirm_toggle_password">
                                        <i id="confirm_visibility" class="fas fa-eye-slash" style="width: 25px;"></i>
                                    </button>
                                </div>
                                <input 
                                    class="form-control" 
                                    type="password"
                                    name="passconf"
                                    id="confirm_password"
                                    placeholder="Enter confirm password"
                                    disabled
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <input type="hidden" name="user_id" value="<?= $this->session->user_id;?>" />
                <button class="btn btn-info text-uppercase font-weight-bold mr-2" type="submit">
                    <span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Update
                </button>
            </div>
        </div>
    </section>
</div>