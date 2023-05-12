<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
                    <?php if($this->session->flashdata('grade_criteria_added')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('grade_criteria_added').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('grade_criteria_updated')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('grade_criteria_updated').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('grade_criteria_deleted')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('grade_criteria_deleted').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url()?>grade-criteria" class="btn btn-primary text-uppercase">
                            Go Back
                        </a>
                        <a href="<?= base_url()?>grade-criteria/create/<?= $slug_subject;?>/<?= $id;?>" class="btn btn-primary px-3">
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
                            <th width="45%">Criteria Name</th>
                            <th class="text-center">Percentage</th>
                            <th class="text-center">Total Items</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($criteria as $row) { ?>
                            <tr>
                                <td class="align-middle"><?= $row['criteria_name']?></td>
                                <td class="align-middle text-center"><?= $row['percentage']?>%</td>
                                <td class="align-middle text-center"><?= $row['total_items']?></td>
                                <td class="align-middle d-sm-flex">
                                    <a href="<?= base_url()?>grade-criteria/edit/<?= $row['id']?>/<?= $slug_subject;?>/<?= $id;?>" class="btn btn-primary btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-100">
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
                        <?php } ?>
                        <tr>
                            <td class="align-middle font-weight-bolder">Total Percentage:</td>
                            <td class="align-middle font-weight-bolder text-center">
                                <?php 
                                    $total_percentage = 0;
                                    foreach($criteria as $row) {
                                        $result = $row['percentage'];
                                        $total_percentage += $result;
                                    } 
                                    echo $total_percentage.'%';
                                ?>
                            </td>
                            <td class="border-right-0"></td>
                            <td class="border-left-0"></td>
                        </tr>
                    </tbody>    
                </table>
            </div>
        </div>
    </section>
</div>