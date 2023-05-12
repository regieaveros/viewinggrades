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
    <section class="content pb-5">
        <div class="container-fluid">
            <div class="row  mb-3">
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="form-row">
                        <div class="form-group w-100">
                            <input type="hidden" id="get_select_1" value="<?= $slug_subject;?>" />
                            <select
                                class="selectpicker form-control" 
                                data-style="btn-outline-light text-secondary"
                                title="Choose Student Subject"
                                data-live-search="true"
                                id="select_1"
                            >
                                <?php foreach($subjects as $subject) { ?>
                                    <option 
                                        value="<?= $subject['slug_subject']?>"
                                        data-id="<?= $subject['faculty_id']?>"
                                    >
                                        <?= substr($subject['subject_code'], 7)?> - <?= $subject['subject_name']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 pl-1">
                    <button class="btn btn-primary text-uppercase font-weight-bold" id="select_student_subject" type="button">
                        <span id="select_spin" class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Select Subject
                    </button>
                </div>
                <div class="col-sm-12 pl-1 pt-2">
                    <?php if(empty($students)) { ?>
                        <button type="button" class="btn btn-info text-uppercase font-weight-bold disabled">
                            Print Student List
                        </button>
                    <?php } else { ?>
                        <a id="btn_print" href="<?= base_url()?>student-list/print/<?= $slug_subject;?>/<?= $id;?>" role="button" class="btn btn-info text-uppercase font-weight-bold">
                            <span id="print_spin" class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Print Student List
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Students Number</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Course</th>
                            <th class="text-center">Year</th>
                            <th class="text-center">Section</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $student) { ?>
                            <tr>
                                <td class="align-middle text-center">
                                    <?= $student['id_number']?>
                                </td>
                                <td class="align-middle text-center">
                                    <?= $student['name']?>
                                </td>
                                <td class="align-middle text-center">
                                    <?= $student['course_code']?>
                                </td>
                                <td class="align-middle text-center">
                                    <?= $student['year_level']?>
                                </td>
                                <td class="align-middle text-center">
                                    <?= $student['section']?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>