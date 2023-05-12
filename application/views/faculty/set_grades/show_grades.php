<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
                    <?php if($this->session->flashdata('grades_updated')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('grades_updated').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <div class="d-flex justify-content-start">
                        <a href="<?= base_url()?>grades" class="btn btn-primary text-uppercase">
                            Go Back
                        </a>
                    </div>
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
                            Subject:
                            <span class="font-weight-normal m-2">
                                <?= $subject_name;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Subject Code:
                            <span class="font-weight-normal m-2">
                                <?= substr($subject_code, 7)?>
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
                            Section:
                            <span class="font-weight-normal m-2">
                                <?= $section;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Semester:
                            <span class="font-weight-normal m-2">
                                <?= $subject_semester;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Year:
                            <span class="font-weight-normal m-2">
                                <?= $subject_year;?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Student Number</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Course</th>
                            <th class="text-center">Year</th>
                            <th class="text-center">Semester</th>
                            <th class="text-center">Score</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $row) { ?>
                            <tr>
                                <td class="align-middle text-center"><?= $row['id_number']?></td>
                                <td class="align-middle text-center"><?= $row['name']?></td>
                                <td class="align-middle text-center"><?= $row['course_code']?></td>
                                <td class="align-middle text-center"><?= $row['year_level']?></td>
                                <td class="align-middle text-center"><?= $row['semester']?></td>
                                <td class="align-middle text-center">
                                    <?php if(!empty($row['final_grade'])) { ?>
                                        <?= $row['final_grade']?>
                                    <?php } else { ?>
                                        None
                                    <?php } ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php if($row['grade_status'] == 1 && $row['grade_status'] != null) { ?>
                                        <div class="badge badge-success">Passed</div>
                                    <?php } elseif($row['grade_status'] == 0 && $row['grade_status'] != null) { ?>
                                        <div class="badge badge-danger">Failed</div>
                                    <?php } else { ?>
                                        None
                                    <?php } ?>
                                </td>
                                <td class="align-middle d-sm-flex">
                                    <a href="<?= base_url()?>grades/input-grades/<?= $row['id']?>/<?= $slug_subject;?>/<?= $id;?>" class="btn btn-primary btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-100">
                                        <i class="fas fa-university mr-1"></i>
                                        Input Grades
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>    
                </table>
            </div>
        </div>
    </section>
</div>