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
            <?= $form_create;?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>ID Number:</label>
                    <div class="input-group">
                        <input 
                            class="form-control" 
                            type="text" 
                            name="id_number"
                            placeholder="Enter a id number"
                            value="<?= set_value('id_number');?>" 
                        />
                        <div class="input-group-append">
                            <button id="generate" class="btn btn-warning font-weight-bold text-uppercase" type="button">
                                Generate
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Student Name:</label>
                    <input 
                        class="form-control" 
                        type="text" 
                        name="name"
                        placeholder="Enter a student name"
                        value="<?= set_value('name');?>" 
                    />
                </div>
                <div class="form-group col-md-6">
                    <label>Email:</label>
                    <input 
                        class="form-control" 
                        type="email"
                        name="email"
                        placeholder="Enter a email"
                        value="<?= set_value('email');?>" 
                    />
                </div>
                <div class="form-group col-md-6">
                    <label>Password:</label>  
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
                            placeholder="Enter a password"
                            value="<?= set_value('password');?>" 
                        />
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url()?>students/section/<?= $slug_section;?>" class="btn btn-primary text-uppercase font-weight-bold">
                    Go Back
                </a>
                <button class="btn btn-success text-uppercase font-weight-bold" type="submit">
                    <span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Create
                </button>
            </div>
        </div>
    </section>
</div>