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
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center gx-5">
                <?php foreach($data as $row) { ?>
                    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 px-2">
                        <a href="<?= $row['url']?>" class="stretched-link text-dark">             
                            <div class="card rounded-1 shadow-sm overflow-hidden">
                                <div class="d-flex" style="height:6rem;">
                                    <div class="bg-primary d-flex justify-content-center align-items-center p-4" style="width:5rem;"> 
                                        <?= $row['icon']?>
                                    </div>
                                    <div class="">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase"><?= $row['title']?></h5>
                                            <p class="card-text"><strong><?= $row['count']?></strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="row gx-5">
                <div class="col-md-6">
                    <div class="card card-info mt-4">
                        <div class="card-header">
                            <h3 class="card-title">List of Faculties</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-1" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Faculty Name</th>
                                            <th class="text-center">List of Sections</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Number of Subjects</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($faculty_subjects as $row){?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <a href="<?= base_url()?>faculty-subject/<?= $row['slug']?>" type="button" class="btn btn-link w-100 h-100">
                                                    <?= $row['name']?>
                                                </a>
                                            </td>
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
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary mt-4">
                        <div class="card-header">
                            <h3 class="card-title">List of Students</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-2" class="table table-hover">
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
                                        <?php foreach($student_subjects as $row){?>
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
                    </div>
                </div>
            </div>
            <div class="card card-success mt-4">
                <div class="card-header">
                    <h3 class="card-title">Count Of All Subject Types</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>