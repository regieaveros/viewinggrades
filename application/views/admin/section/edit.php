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
                <div class="form-group col-md-6">
                    <label>Section:</label>
                    <input 
                        class="form-control" 
                        type="text" 
                        name="section"
                        placeholder="Enter a school year"
                        value="<?= $section;?>"
                    />
                </div>
                <div class="form-group col-md-6">
                    <label>Course:</label>
                    <input type="hidden" id="get_select_1" value="<?= $course_code;?>" />
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
                    <input type="hidden" id="get_select_2" value="<?= $year_level;?>" />
                    <select 
                        class="selectpicker form-control" 
                        data-style="btn-outline-light text-secondary"
                        title="Choose Year..."
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
                    <input type="hidden" id="get_select_3" value="<?= $semester;?>" />
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
                    <label>Adviser:</label>
                    <input type="hidden" id="get_select_4" value="<?= $faculty_name;?>" />
                    <select 
                        class="selectpicker form-control"
                        data-style="btn-outline-light text-secondary"
                        title="Choose Adviser"
                        data-live-search="true" 
                        id="select_4" 
                        name="faculty_name"
                    >
                        <?php foreach($faculties as $faculty){?>
                            <option value="<?= $faculty['name']?>"><?= $faculty['course_code']?> - <?= $faculty['name']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <input type="hidden" name="id" value="<?= $id;?>" />
                <a href="<?= base_url()?>section" class="btn btn-primary text-uppercase font-weight-bold">
                    Go Back
                </a>
                <button class="btn btn-info text-uppercase font-weight-bold" type="submit">
                    <span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Update
                </button>
            </div>
        </div>
    </section>
</div>