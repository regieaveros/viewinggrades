<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
                    <?php if($this->session->flashdata('faculty_subject_added')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('faculty_subject_added').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('faculty_subject_updated')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('faculty_subject_updated').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('faculty_subject_deleted')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('faculty_subject_deleted').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url()?>faculty-subject" class="btn btn-primary text-uppercase">
                            Go Back
                        </a>
                        <a href="<?= base_url()?>faculty-subject/create/<?= $slug_name;?>" class="btn btn-primary px-3">
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
                <div class="col-sm-7">
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Faculty Name:
                            <span class="font-weight-normal m-2">
                                <?= $name;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Course:
                            <span class="font-weight-normal m-2">
                                <?= $course_name;?> - <?= $course_code;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Subject Type: 
                            <?php
                                $subjectTypes = [
                                    1 => 'Computer Programming', 
                                    2 => 'Computer Networking', 
                                    3 => 'Computer Database', 
                                    4 => 'Computer Security', 
                                    5 => 'Computer Graphics', 
                                    6 => 'Computer Peripherals', 
                                    7 => 'Analytics', 
                                    8 => 'Mathematics', 
                                    9 => 'History & Philosophy', 
                                    10 => 'Business', 
                                    11 => 'Statistics', 
                                    12 => 'Arts', 
                                    13 => 'Service Training', 
                                    14 => 'Physical Education', 
                                    15 => 'Communication', 
                                    16 => 'Values', 
                                    17 => 'Thesis', 
                                    18 => 'On Job Training(OJT)'
                                ];
                                $subject_type_array = explode(",", $subject_type);
                                foreach ($subject_type_array as $value) {
                                    if (isset($subjectTypes[$value])) {
                                        echo "<span class='badge badge-dark mx-1'>".$subjectTypes[$value]."</span>";
                                    } else {
                                        echo "None";
                                    }
                                }
                            ?>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Number of Subjects: 
                            <span class="font-weight-normal m-2">
                                <?= $subject_count;?>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Email:
                            <span class="font-weight-normal m-2">
                                <?= $email;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Faculty Number:
                            <span class="font-weight-normal m-2">
                                <?= $id_number;?>
                            </span>
                        </p>
                    </div>
                    <div class="d-flex align-items-baseline pb-1">
                        <p class="h5 font-weight-bold">
                            Status:
                            <span class="font-weight-normal m-2">
                                <?php
                                    if($subject_count == 0) {
                                        echo "<span class='badge badge-secondary'>None</span>";
                                    } else {
                                        if($status == "Completed") {
                                            echo "<span class='badge badge-success'>Completed</span>";
                                        } else {
                                            echo "<span class='badge badge-secondary'>Not Completed</span>";
                                        }
                                    }
                                ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="45%">Subject</th>
                            <th class="text-center">Section</th>
                            <th class="text-center">Course Code</th>
                            <th class="text-center">Year Level</th>
                            <th class="text-center">Semester</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row){?>
                            <tr>
                                <td class="align-middle">
                                    <a href="<?= base_url()?>faculty-subject/subject/<?= $slug_name?>/<?= $row['slug_subject']?>/<?= $row['subject_id']?>" type="button" class="btn btn-link text-left w-100">
                                        <?= substr($row['subject_code'], 7)?> - <?= $row['subject_name']?>
                                    </a>
                                </td>
                                <td class="align-middle text-center">
                                    <?php if($row['section']) { ?>
                                        <?= $row['section']?>
                                    <?php } else { ?>
                                        None
                                    <?php } ?>
                                </td>
                                <td class="align-middle text-center"><?= $row['course_code']?></td>
                                <td class="align-middle text-center"><?= $row['subject_year']?></td>
                                <td class="align-middle text-center"><?= $row['subject_semester']?></td>
                                <td class="align-middle d-sm-flex">
                                    <a href="<?= base_url()?>faculty-subject/edit/<?= $slug_name?>/<?= $row['id']?>/<?= $row['slug_subject']?>/<?= $row['subject_id']?>" class="btn btn-primary btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-100">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                    <button 
                                        type="button" 
                                        class="btn btn-danger btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-100"
                                        data-id="<?= $row['id']?>"
                                        data-toggle="modal" 
                                        data-target="#deleteModal"
                                    >
                                        <i class="fas fa-trash mr-1"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>