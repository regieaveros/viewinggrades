<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
                    <?php if($this->session->flashdata('section_added')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('section_added').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('section_updated')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('section_updated').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('section_deleted')) : ?>
                        <?= 
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                '.$this->session->flashdata('section_deleted').'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        ?>
                    <?php endif;?>
                    <div class="d-flex justify-content-end">
                        <a href="<?= base_url()?>section/create" class="btn btn-primary px-3">
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
                            <th>Course Code</th>
                            <th>Section</th>
                            <th>Year Level</th>
                            <th>Semester</th>
                            <th>Adviser</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $row){?>
                        <tr>
                        <td class="align-middle"><?= $row['course_code']?></td>
                            <td class="align-middle"><?= $row['section']?></td>
                            <td class="align-middle"><?= $row['year_level']?></td>
                            <td class="align-middle"><?= $row['semester']?></td>
                            <td class="align-middle"><?= $row['faculty_name']?></td>
                            <td class="align-middle d-sm-flex">
                                <a href="<?= base_url();?>section/edit/<?= $row['id']?>" class="btn btn-primary btn-sm d-flex flex-row justify-content-center align-items-center m-1 py-1 px-2 w-100">
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