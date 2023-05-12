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
            <div class="form-group">
                <label>Course Code:</label>
                <input 
                    class="form-control" 
                    type="text" 
                    name="course_code"
                    placeholder="Enter a school year"
                    value="<?= set_value('course_code');?>" 
                />
            </div>
            <div class="form-group">
                <label>Course Name:</label>
                <input 
                    class="form-control" 
                    type="text" 
                    name="course_name"
                    placeholder="Enter a school year"
                    value="<?= set_value('course_name');?>" 
                />
            </div>
            <div class="form-group">
                <label>Staff:</label>
                <input type="hidden" id="get_select_1" value="<?= set_value('staff');?>" />
                <select 
                    class="selectpicker form-control" 
                    data-style="btn-outline-light text-secondary"
                    title="Choose Staff"
                    data-live-search="true" 
                    id="select_1" 
                    name="staff"
                >
                    <option value="Faculty">Faculty</option>
                    <option value="Student">Student</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url()?>course" class="btn btn-primary text-uppercase font-weight-bold">
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