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
                            <th class="text-center">Faculty Name</th>
                            <th width="38%" class="text-center">Course</th>
                            <th width="20%" class="text-center">List of Sections</th>
                            <th width="10%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Number of Subjects</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row){?>
                        <tr>
                            <td class="align-middle text-center">
                                <a href="<?= base_url()?>faculty-subject/<?= $row['slug']?>" type="button" class="btn btn-link w-100 h-100">
                                    <?= $row['name']?>
                                </a>
                            </td>
                            <td class="align-middle"><?= $row['course_code']?> - <?= $row['course_name']?></td>
                            <td class="align-middle text-center">
                                <?php
                                    if($row['sections']) {
                                        $array_value = array_map(
                                            function ($value) {
                                                return '<span class="badge badge-dark">'.$value.'</span>';
                                            },
                                            explode(',', $row['sections'])
                                        );
                                        echo implode(" ", $array_value);
                                    } else {
                                        echo "No Sections";
                                    }                                  
                                ?>
                            </td>
                            <td class="align-middle text-center">
                                <?php
                                    if($row['subject_count'] == 0) {
                                        echo "<span class='badge badge-secondary'>None</span>";
                                    } else {
                                        if($row['section_status'] == "completed") {
                                            echo "<span class='badge badge-success'>Completed</span>";
                                        } else {
                                            echo "<span class='badge badge-secondary'>Not Completed</span>";
                                        }
                                    }
                                ?>
                            </td>
                            <td class="align-middle text-center"><?= $row['subject_count']?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>