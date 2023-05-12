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
            <div class="row mb-4">
                <div class="col-sm-7">
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Student Name:
                            <span class="font-weight-normal m-2">
                                <?= $name;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Section:
                            <span class="font-weight-normal m-2">
                            <?= $section;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Course: 
                            <span class="font-weight-normal m-2">
                            <?= $course_code;?>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Year:
                            <span class="font-weight-normal m-2">
                                <?= $year_level;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Semester:
                            <span class="font-weight-normal m-2">
                                <?= $semester;?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <?= $form_edit;?>
            <?php foreach($data as $row) { ?>
                <div class="form-group">
                    <label><?= $row['criteria_name']?>: </label>
                    <input 
                        class="form-control" 
                        type="number"
                        name="<?= strtolower($row['criteria_name'])?>"
                        placeholder="Enter a <?= strtolower($row['criteria_name'])?> score"
                        value="<?= set_value(strtolower($row['criteria_name']))?>"
                    />
                    <p class="font-italic mt-1">
                        <span class="mx-1">Total Items = <strong><?= $row['total_items']?></strong></span>
                        <span class="ml-5">Percentage = <strong><?= $row['percentage']?>%</strong></span>
                    </p>
                </div>
            <?php } ?>
            <div class="d-flex justify-content-between">
                <input type="hidden" name="id" value="<?= $id;?>" />
                <a href="<?= base_url()?>grades/<?= $slug_subject?>/<?= $subject_id?>" class="btn btn-primary text-uppercase font-weight-bold">
                    Go Back
                </a>
                <button class="btn btn-info text-uppercase font-weight-bold" type="submit">
                    <span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Compute Grades
                </button>
            </div>
        </div>
    </section>
</div>