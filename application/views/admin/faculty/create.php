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
                    <label>Name:</label>
                    <input 
                        class="form-control" 
                        type="text" 
                        name="name"
                        placeholder="Enter a name"
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
                    <label>Course:</label>
                    <input type="hidden" id="get_select_1" value="<?= set_value('course_code');?>" />
                    <select 
                        class="selectpicker form-control" 
                        data-style="btn-outline-light text-secondary"
                        title="Choose Course"
                        data-live-search="true" 
                        id="select_1"
                        name="course_code"
                    >
                        <?php foreach($courses as $course){?>
                            <option value="<?= $course['code']?>"><?= $course['code']?> - <?= $course['name']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Subject Type:</label>
                    <input type="hidden" id="get_select_2" value="<?= set_value('subject_type[]');?>" />
                    <select 
                        class="selectpicker form-control" 
                        data-style="btn-outline-light text-secondary"
                        title="Choose Subject Type"
                        data-live-search="true"
                        id="select_2"
                        name="subject_type[]"
                        multiple
                    >
                        <optgroup label="List of Subject Types">
                            <option class="position-check" value="1">Computer Programming</option>
                            <option class="position-check" value="2">Computer Networking</option>
                            <option class="position-check" value="3">Computer Database</option>
                            <option class="position-check" value="4">Computer Security</option>
                            <option class="position-check" value="5">Computer Graphics</option>
                            <option class="position-check" value="6">Computer Peripherals</option>
                            <option class="position-check" value="7">Analytics</option>
                            <option class="position-check" value="8">Mathematics</option>
                            <option class="position-check" value="9">History & Philosophy</option>
                            <option class="position-check" value="10">Business</option>
                            <option class="position-check" value="11">Statistics</option>
                            <option class="position-check" value="12">Arts</option>
                            <option class="position-check" value="13">Service Training</option>
                            <option class="position-check" value="14">Physical Education</option>
                            <option class="position-check" value="15">Communication</option>
                            <option class="position-check" value="16" class="position-check">Values</option>
                            <option class="position-check" value="17">Thesis</option>
                            <option class="position-check" value="18">On Job Training(OJT)</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group col-sm-6">
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
                <a href="<?= base_url()?>faculty" class="btn btn-primary text-uppercase font-weight-bold">
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