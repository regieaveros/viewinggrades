<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="row bg-light rounded-lg shadow m-3 p-3">
        <div class="col-lg-12">
            <div class="d-flex justify-content-center py-1">
                <img src="<?= base_url();?>assets/dist/img/logo.png" class="rounded-circle logo-shadow" width="65px" alt="Main Logo">
            </div>
            <h2 class="text-center mb-4">Online Viewing Of Grades</h2>
            <hr>
            <?php if($this->session->flashdata('failed_login')) : ?>
                <?= '<p class="alert alert-danger">'.$this->session->flashdata('failed_login').'</p>'?>
            <?php endif;?>
            <?php if($this->session->flashdata('user_loggedout')) : ?>
                <?= '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'?>
            <?php endif;?>
            <?= validation_errors();?>
            <?= form_open('login');?>
            <div class="form-group">
                <label class="font-weight-bold">Username / Email:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input 
                        class="form-control" 
                        type="text" 
                        name="email"
                        autocomplete="off"
                        placeholder="Enter your username or email"
                    />
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Password:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input
                        class="form-control"
                        type="password" 
                        name="password"
                        placeholder="Enter password"
                    />
                </div>
                
            </div>
            <div class="form-group">
                <button class="btn btn-primary form-control text-uppercase font-weight-bold" type="submit">
                    <span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Login
                </button>
            </div>
        </div>
    </div>
</div>