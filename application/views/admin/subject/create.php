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
                    <label>Subject Code:</label>
                    <input 
                        class="form-control" 
                        type="text" 
                        name="subject_code"
                        placeholder="Enter a subject code"
                        value="<?= set_value('subject_code');?>" 
                    />
                </div>
                <div class="form-group col-md-6">
                    <label>Subject Name:</label>
                    <input 
                        class="form-control" 
                        type="text" 
                        name="subject_name"
                        placeholder="Enter a subject name"
                        value="<?= set_value('subject_name');?>" 
                    />
                </div>
                <div class="form-group col-md-6">
                    <label>Units:</label>
                    <input 
                        class="form-control" 
                        type="number" 
                        name="units"
                        placeholder="Enter a units"
                        value="<?= set_value('units');?>" 
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
                    <label>Year Level:</label>
                    <input type="hidden" id="get_select_2" value="<?= set_value('year_level');?>" />
                    <select 
                        class="selectpicker form-control" 
                        data-style="btn-outline-light text-secondary"
                        title="Choose Year"
                        data-live-search="true" 
                        id="select_2" 
                        name="year_level"
                    >
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Semester:</label>
                    <input type="hidden" id="get_select_3" value="<?= set_value('semester');?>" />
                    <select 
                        class="selectpicker form-control" 
                        data-style="btn-outline-light text-secondary"
                        title="Choose Semester"
                        data-live-search="true"
                        id="select_3"
                        name="semester"
                    >
                        <?php foreach($semesters as $semester){?>
                            <option value="<?= $semester['semester']?>"><?= $semester['semester']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>Subject Type:</label>
                    <input type="hidden" id="get_select_4" value="<?= set_value('subject_type');?>" />
                    <select 
                        class="selectpicker form-control" 
                        data-style="btn-outline-light text-secondary"
                        title="Choose Semester"
                        data-live-search="true"
                        id="select_4"
                        name="subject_type"
                    >
                        <option value="1">Computer Programming</option>
                        <option value="2">Computer Networking</option>
                        <option value="3">Computer Database</option>
                        <option value="4">Computer Security</option>
                        <option value="5">Computer Graphics</option>
                        <option value="6">Computer Peripherals</option>
                        <option value="7">Analytics</option>
                        <option value="8">Mathematics</option>
                        <option value="9">History & Philosophy</option>
                        <option value="10">Business</option>
                        <option value="11">Statistics</option>
                        <option value="12">Arts</option>
                        <option value="13">Service Training</option>
                        <option value="14">Physical Education</option>
                        <option value="15">Communication</option>
                        <option value="16">Values</option>
                        <option value="17">Thesis</option>
                        <option value="18">On Job Training(OJT)</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url()?>subject" class="btn btn-primary text-uppercase font-weight-bold">
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