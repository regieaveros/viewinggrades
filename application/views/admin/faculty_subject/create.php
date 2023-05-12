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
                <label>Subject:</label>
                <input type="hidden" id="get_select_1" value="<?= set_value('subject[]');?>" />
                <select
                    class="selectpicker form-control"
                    data-style="btn-outline-light text-secondary"
                    title="Choose Subject"
                    data-header='For sequential searching (Year-Semester-Course) "Ex. 1st Year 1st BSIT"'
                    data-live-search="true"
                    data-size="20"  
                    id="select_1"
                    name="subject[]"
                    multiple
                    multiple data-selected-text-format="count > 1"
                >
                    <optgroup label="BSIT">
                        <?php foreach($subjects as $subject){?>
                            <?php if($subject['course_code'] == "BSIT") { ?>
                            <option
                                data-content="
                                    <strong class='mr-1'>Year:</strong> <?= $subject['year_level']?><br />
                                    <strong class='mr-1'>Semester:</strong> <?= $subject['semester']?><br />
                                    <strong class='mr-1'>Course:</strong> <?= $subject['course_code']?><br />
                                    <strong class='mr-1'>Code:</strong> <?= substr($subject['subject_code'], 7)?><br />
                                    <strong class='mr-1'>Name:</strong> <?= $subject['subject_name']?>
                                "
                                data-tokens="<?= $subject['year_level']?> <?= $subject['semester']?> <?= $subject['course_code']?> <?= substr($subject['subject_code'], 7)?> <?= $subject['subject_name']?>"
                                value="<?= $subject['subject_code']?>"
                            ></option>
                            <?php } ?>
                        <?php }?>
                    </optgroup>
                    <optgroup label="BSCS">
                        <?php foreach($subjects as $subject){?>
                            <?php if($subject['course_code'] == "BSCS") { ?>
                            <option
                                data-content="
                                    <strong class='mr-1'>Year:</strong> <?= $subject['year_level']?><br />
                                    <strong class='mr-1'>Semester:</strong> <?= $subject['semester']?><br />
                                    <strong class='mr-1'>Course:</strong> <?= $subject['course_code']?><br />
                                    <strong class='mr-1'>Code:</strong> <?= substr($subject['subject_code'], 7)?><br />
                                    <strong class='mr-1'>Name:</strong> <?= $subject['subject_name']?>
                                "
                                data-tokens="<?= $subject['year_level']?> <?= $subject['semester']?> <?= $subject['course_code']?> <?= substr($subject['subject_code'], 7)?> <?= $subject['subject_name']?>"
                                value="<?= $subject['subject_code']?>"
                            ></option>
                            <?php } ?>
                        <?php }?>
                    </optgroup>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url()?>faculty-subject/<?= $slug_name;?>" class="btn btn-primary text-uppercase font-weight-bold">
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