<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
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
                            <th width="70%">Section</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Number of Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row){?>
                        <tr>
                            <td class="align-middle">
                                <a href="<?= base_url()?>students/section/<?= $row['slug_section']?>" type="button" class="btn btn-link w-100 h-100 text-left">
                                    <?= $row['section']?>
                                </a>
                            </td>
                            <td class="align-middle text-center">
                                <?php if($row['students_subject_status'] == 1) { ?>
                                    <span class="badge badge-success">Completed</span>
                                <?php } else { ?>
                                    <span class="badge badge-secondary">Not Completed</span>
                                <?php } ?>
                            </td>
                            <td class="align-middle text-center"><?= $row['student_section_count']?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>