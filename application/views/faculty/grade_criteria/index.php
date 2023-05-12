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
                            <th width="55%">Subject</th>
                            <th class="text-center">Course</th>
                            <th class="text-center">Section</th>
                            <th width="20%" class="text-center">List of Criteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['subject'] as $row_subject) { ?>
                            <tr>
                                <td class="align-middle">
                                    <a href="<?= base_url();?>grade-criteria/<?= $row_subject['slug_subject']?>/<?= $row_subject['id']?>" type="button" class="btn btn-link w-100 h-100 text-left">
                                        <?= substr($row_subject['subject_code'], 7)?> - <?= $row_subject['subject_name']?>
                                    </a>
                                </td>
                                <td class="align-middle text-center"><?= $row_subject['course_code'] ?></td>
                                <td class="align-middle text-center"><?= $row_subject['section'] ?></td>
                                <td class="align-middle text-center">
                                    <?php
                                        $criteria = array_filter($data['criteria'], function($result) use ($row_subject) {
                                            return $result['faculty_subject_id'] == $row_subject['id'];
                                        });
                                    ?>
                                    <?php if(empty($criteria)) { ?>
                                        <span>None</span>
                                    <?php } else { ?>
                                        <div class="d-flex flex-wrap justify-content-center">
                                            <?php foreach($criteria as $row_criteria) { ?>
                                                <span class="badge badge-warning m-1"><?= $row_criteria['criteria_name'] ?></span>
                                            <?php } ?>
                                        </div>
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