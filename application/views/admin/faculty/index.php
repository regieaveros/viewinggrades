<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
                    <?php if($this->session->flashdata('faculty_added')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('faculty_added').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('faculty_updated')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('faculty_updated').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('faculty_deleted')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('faculty_deleted').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <div class="d-flex justify-content-end">
                        <a href="<?= base_url()?>faculty/create" class="btn btn-primary px-3">
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
            <div class="table-responsive">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Faculty Number</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th width="15%">Subject Type</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row) {?>
                        <tr>
                            <td class="align-middle"><?= $row['id_number'];?></td>
                            <td class="align-middle"><?= $row['name'];?></td>
                            <td class="align-middle"><?= $row['email'];?></td>
                            <td class="align-middle"><?= $row['course_code'];?> - <?= $row['course_name']?></td>
                            <td class="align-middle">
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
                                    $subject_type = $row['subject_type'];
                                    $subject_type_array = explode(",", $subject_type);
                                    foreach ($subject_type_array as $value) {
                                        if (isset($subjectTypes[$value])) {
                                            echo "<span class='badge badge-dark'>".$subjectTypes[$value]."</span><br>";
                                        } else {
                                            echo "None";
                                        }
                                    }
                                ?>
                            </td>
                            <td class="align-middle d-sm-flex">
                                <a href="faculty/edit/<?= $row['id'];?>" class="btn btn-primary btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-100">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                                <button 
                                    type="button" 
                                    class="btn btn-danger btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-100"
                                    data-id="<?= $row['user_id'];?>"
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