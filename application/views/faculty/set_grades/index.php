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
                            <th width="45%">Subject</th>
                            <th class="text-center">Has Criteria</th>
                            <th class="text-center">Course</th>
                            <th class="text-center">Section</th>
                            <th width="20%" class="text-center">Number Of Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['faculty_subject'] as $row_faculty_subject) { ?>
                            <?php $row_criteria = null; ?>
                            <tr>
                                <td class="align-middle">
                                    <?php foreach ($data['criteria'] as $row_criteria) { ?>
                                        <?php if ($row_faculty_subject['id'] == $row_criteria['faculty_subject_id']) { ?>
                                            <a href="<?= base_url('grades/'.$row_faculty_subject['slug_subject'].'/'.$row_faculty_subject['id']); ?>" class="btn btn-link w-100 h-100 text-left">
                                                <?= substr($row_faculty_subject['subject_code'], 7).' - '.$row_faculty_subject['subject_name']; ?>
                                            </a>
                                            <?php break; ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if ($row_faculty_subject['id'] !== $row_criteria['faculty_subject_id']) { ?>
                                        <span class="btn none-cursor text-left w-100 h-100">
                                            <?= substr($row_faculty_subject['subject_code'], 7).' - '.$row_faculty_subject['subject_name']; ?>
                                        </span>
                                    <?php } ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php foreach ($data['criteria'] as $row_criteria) { ?>
                                        <?php if ($row_faculty_subject['id'] == $row_criteria['faculty_subject_id']) { ?>
                                            <div class="badge badge-success text-uppercase">
                                                Yes
                                            </div>
                                            <?php break; ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if ($row_faculty_subject['id'] !== $row_criteria['faculty_subject_id']) { ?>
                                        <div class="badge badge-secondary text-uppercase">
                                            No
                                        </div>
                                    <?php } ?>
                                </td>
                                <td class="align-middle text-center"><?= $row_faculty_subject['course_code']; ?></td>
                                <td class="align-middle text-center"><?= $row_faculty_subject['section']; ?></td>
                                <td class="align-middle text-center"><?= $row_faculty_subject['count_students']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>