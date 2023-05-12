<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
                    <div class="d-flex flex-row-reverse">
                        <a href="<?= $url;?>" class="btn btn-primary text-uppercase">
                            Go Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content pb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex align-items-baseline pb-2">
                        <p class="h5 font-weight-bold">Subject Name:</p>
                        <p class="h5 pl-2"><?= $subject_name;?></p>
                    </div>
                    <div class="d-flex align-items-baseline pb-2">
                        <p class="h5 font-weight-bold">Subject Code:</p>
                        <p class="h5 pl-2"><?= substr($subject_code, 7);?></p>
                    </div>
                    <div class="d-flex align-items-baseline pb-2">
                        <p class="h5 font-weight-bold">Units:</p>
                        <p class="h5 pl-2"><?= $units;?></p>
                    </div>
                    <div class="d-flex align-items-baseline pb-2">
                        <p class="h5 font-weight-bold">Course:</p>
                        <p class="h5 pl-2"><?= $course_code;?></p>
                    </div>
                    <div class="d-flex align-items-baseline pb-2">
                        <p class="h5 font-weight-bold">Year Level:</p>
                        <p class="h5 pl-2"><?= $year_level;?></p>
                    </div>
                    <div class="d-flex align-items-baseline pb-2">
                        <p class="h5 font-weight-bold">Semester:</p>
                        <p class="h5 pl-2"><?= $semester;?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>