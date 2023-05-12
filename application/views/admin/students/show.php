<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
                    
                    <?php if($this->session->flashdata('students_added')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('students_added').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('students_subject_added')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('students_subject_added').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('students_updated')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('students_updated').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('students_subject_completed')) : ?>
                        <?= 
                            '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('students_subject_completed').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('students_deleted')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('students_deleted').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url()?>students" class="btn btn-primary text-uppercase">
                            Go Back
                        </a>
                        <a href="<?= base_url()?>students/create/<?= $slug_section;?>" class="btn btn-primary px-3">
                            <i class="fas fa-plus mr-1"></i>
                            Add
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content pb-3">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-4">
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Course:
                            <span class="font-weight-normal m-2">
                                <?= $course_code;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Year Level:
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
                <div class="col-sm-4">
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
                            Adviser:
                            <span class="font-weight-normal m-2">
                                <?= $faculty_name;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Number of Students:
                            <span class="font-weight-normal m-2">
                                <?= $student_section_count;?>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Confirm Status:
                            <?php if($students_subject_status == 1) { ?>
                                <h5><span class="badge badge-success p-2 m-2">Completed</span></h5>
                            <?php } else { ?>
                                <?php if ($check_counts === true) { ?>
                                    <a href="<?= base_url()?>students/complete/<?= $slug_section;?>" class="btn btn-success px-3 m-2" id="complete">
                                        <span class="d-none spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                                        Approve
                                    </a>
                                <?php } else { ?>
                                    <button class="btn btn-secondary px-3 m-2" disabled>
                                        Not Complete
                                    </button>
                                <?php } ?>
                            <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Student Number</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-center">Has Subjects</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $student) { ?>
                        <tr>
                            <td class="align-middle"><?= $student['id_number']?></td>
                            <td class="align-middle"><?= $student['name']?></td>
                            <td class="align-middle"><?= $student['email']?></td>
                            <td class="align-middle text-center">
                                <?php if($student['subject_count'] != 0) {?>
                                    <h5><span class="badge badge-success">Yes</span></h5>
                                <?php } else { ?>
                                    <h5><span class="badge badge-secondary">No</span></h5>
                                <?php } ?>
                            </td>
                            <td class="align-middle d-sm-flex">
                                <?php if($student['subject_count'] == 0) {?>
                                    <a href="<?= base_url();?>students/subjects/<?= $slug_section;?>/<?= $student['id']?>" class="btn btn-info btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-75">
                                        <span class="d-none spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                                        <i class="far fa-list-alt mr-1"></i>
                                        Add Subjects
                                    </a>
                                    <a href="<?= base_url();?>students/edit/<?= $slug_section;?>/<?= $student['id']?>" class="btn btn-primary btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-50">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                    <button 
                                        type="button" 
                                        class="btn btn-danger btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-50"
                                        data-id="<?= $student['user_id']?>"
                                        data-toggle="modal" 
                                        data-target="#deleteModal"
                                    >
                                        <i class="fas fa-trash mr-1"></i>
                                        Delete
                                    </button>
                                <?php } else { ?>
                                    <a href="<?= base_url();?>students/edit/<?= $slug_section;?>/<?= $student['id']?>" class="btn btn-primary btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-50">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                    <button 
                                        type="button" 
                                        class="btn btn-danger btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-50"
                                        data-id="<?= $student['user_id']?>"
                                        data-toggle="modal" 
                                        data-target="#deleteModal"
                                    >
                                        <i class="fas fa-trash mr-1"></i>
                                        Delete
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>