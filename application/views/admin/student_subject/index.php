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
                            <th width="45%">Student Name</th>
                            <th class="text-center">Section</th>
                            <th class="text-center">Course</th>
                            <th class="text-center">Year</th>
                            <th class="text-center">Semester</th>
                            <th class="text-center" width="15%">Number of Subjects</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row){?>
                        <tr>
                            <td class="align-middle">
                                <a href="<?= base_url()?>student-subject/<?= $row['slug']?>" type="button" class="btn btn-link w-100 h-100 text-left">
                                    <?= $row['name']?>
                                </a>
                            </td>
                            <td class="align-middle text-center"><?= $row['section']?></td>
                            <td class="align-middle text-center"><?= $row['course_code']?></td>
                            <td class="align-middle text-center"><?= $row['year_level']?></td>
                            <td class="align-middle text-center"><?= $row['semester']?></td>
                            <td class="align-middle text-center"><?= $row['subject_count']?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>