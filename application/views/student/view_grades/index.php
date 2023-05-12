<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <section class="content pb-5">
        <div class="container-fluid">
            <div class="d-flex justify-content-end mb-4">
                <a id="btn_print" href="<?= base_url()?>view-grades/print" role="button" class="btn btn-info text-uppercase font-weight-bold">
                    <span id="print_spin" class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Print Grades
                </a>
            </div>
            <div class="row">
                <div class="col-xl-9 col-12">
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Subject Code</th>
                                    <th class="text-center">Subject Name</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Semester</th>
                                    <th class="text-center">Section</th>
                                    <th class="text-center">Final Grade</th>
                                    <th class="text-center">Equivalent</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data as $row) { ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <?= substr($row['subject_code'], 7)?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $row['subject_name']?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $row['year_level']?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $row['semester']?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?= $row['section']?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?php if($row['final_grade'] != null) { ?>
                                                <?= $row['final_grade']?>
                                            <?php } else { ?>
                                                None
                                            <?php } ?>
                                        </td>
                                        <td class="align-middle text-center">
                                        <?php
                                                switch($row['final_grade']) {
                                                    case $row['final_grade'] >= 98: 
                                                        echo "<span class='font-weight-bold'>1.0</span>";
                                                        break;
                                                    case $row['final_grade'] >= 94: 
                                                        echo "<span class='font-weight-bold'>1.25</span>";
                                                        break;
                                                    case $row['final_grade'] >= 90: 
                                                        echo "<span class='font-weight-bold'>1.50</span>";
                                                        break;
                                                    case $row['final_grade'] >= 87: 
                                                        echo "<span class='font-weight-bold'>1.75</span>";
                                                        break;
                                                    case $row['final_grade'] >= 84: 
                                                        echo "<span class='font-weight-bold'>2.0</span>";
                                                        break;
                                                    case $row['final_grade'] >= 76: 
                                                        echo "<span class='font-weight-bold'>2.25</span>";
                                                        break;
                                                    case $row['final_grade'] >= 66: 
                                                        echo "<span class='font-weight-bold'>2.50</span>";
                                                        break;
                                                    case $row['final_grade'] >= 58: 
                                                        echo "<span class='font-weight-bold'>2.75</span>";
                                                        break;
                                                    case $row['final_grade'] >= 50: 
                                                        echo "<span class='font-weight-bold'>3.0</span>";
                                                        break;
                                                    case $row['final_grade'] <= 49: 
                                                        echo "<span class='text-danger'>5.0</span>";
                                                        break;
                                                    default: 
                                                        echo "None";
                                                        break;
                                                }
                                            ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?php
                                                switch($row['final_grade']) {
                                                    case $row['final_grade'] >= 98: 
                                                        echo "<div class='badge badge-success'>Excellent</div>";
                                                        break;
                                                    case $row['final_grade'] >= 94: 
                                                        echo "<div class='badge badge-success'>Superior</div>";
                                                        break;
                                                    case $row['final_grade'] >= 90: 
                                                        echo "<div class='badge badge-success'>Very Good</div>";
                                                        break;
                                                    case $row['final_grade'] >= 87: 
                                                        echo "<div class='badge badge-success'>Good</div>";
                                                        break;
                                                    case $row['final_grade'] >= 84: 
                                                        echo "<div class='badge badge-success'>Very Satisfactory</div>";
                                                        break;
                                                    case $row['final_grade'] >= 76: 
                                                        echo "<div class='badge badge-success'>Satisfactory</div>";
                                                        break;
                                                    case $row['final_grade'] >= 66: 
                                                        echo "<div class='badge badge-success'>Average</div>";
                                                        break;
                                                    case $row['final_grade'] >= 58: 
                                                        echo "<div class='badge badge-success'>Fair</div>";
                                                        break;
                                                    case $row['final_grade'] >= 50: 
                                                        echo "<div class='badge badge-success'>Passed</div>";
                                                        break;
                                                    case $row['final_grade'] <= 49: 
                                                        echo "<div class='badge badge-danger'>Failed</div>";
                                                        break;
                                                    default: 
                                                        echo "None";
                                                        break;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xl-3 col-12">
                    <div class="border mt-xl-0 mt-5 py-3 px-3">
                        <div class="row">
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6">
                                <h6 class="font-weight-bold">Grade Equivalent</h6>                
                                <ul class="list-group list-group-horizontal font-weight-bold small mb-2">
                                    <li class="list-group-item flex-fill py-2 pl-3 p-0">
                                        <div class="my-1">
                                            <span class="mr-1">1.0</span> - <span class="badge badge-success ml-1">Excellent</span>
                                        </div>
                                        <div class="my-1">
                                            <span class="mr-1">1.25</span> - <span class="badge badge-success ml-1">Superior</span>
                                        </div>
                                        <div class="my-1">
                                            <span class="mr-1">1.50</span> - <span class="badge badge-success ml-1">Very Good</span>
                                        </div>
                                        <div class="my-1">
                                            <span class="mr-1">1.75</span> - <span class="badge badge-success ml-1">Good</span>
                                        </div>
                                        <div class="my-1">
                                            <span class="mr-1">2.0</span> - <span class="badge badge-success ml-1">Very Satisfactory</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item flex-fill py-2 pl-3 p-0">
                                        <div class="my-1">
                                            <span class="mr-1">2.25</span> - <span class="badge badge-success ml-1">Satisfactory</span>
                                        </div>
                                        <div class="my-1">
                                            <span class="mr-1">2.50</span> - <span class="badge badge-success ml-1">Average</span>
                                        </div>
                                        <div class="my-1">
                                            <span class="mr-1">2.75</span> - <span class="badge badge-success ml-1">Fair</span>
                                        </div>
                                        <div class="my-1">
                                            <span class="mr-1">3.0</span> - <span class="badge badge-success ml-1">Passed</span>
                                        </div>
                                        <div class="my-1">
                                            <span class="text-danger mr-1">5.0</span> - <span class="badge badge-danger ml-1">Failed</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6">
                                <h6 class="font-weight-bold text-left">Grade Computation</h6>  
                                <div class="d-flex flex-wrap font-weight-bold small bg-white border rounded">
                                    <div class="mx-3 my-1">
                                        <span class="font-italic mr-1">100 - 98</span> = <span class="ml-1">1.0</span>
                                    </div>
                                    <div class="mx-3 my-1">
                                        <span class="font-italic mr-1">97 - 94</span> = <span class="ml-1">1.25</span>
                                    </div>
                                    <div class="mx-3 my-1">
                                        <span class="font-italic mr-1">93 - 90</span> = <span class="ml-1">1.50</span>
                                    </div>
                                    <div class="mx-3 my-1">
                                        <span class="font-italic mr-1">89 - 87</span> = <span class="ml-1">1.75</span>
                                    </div>
                                    <div class="mx-3 my-1">
                                        <span class="font-italic mr-1">86 - 84</span> = <span class="ml-1">2.0</span>
                                    </div>
                                    <div class="mx-3 my-1">
                                        <span class="font-italic mr-1">83 - 76</span> = <span class="ml-1">2.25</span>
                                    </div>
                                    <div class="mx-3 my-1">
                                        <span class="font-italic mr-1">75 - 66</span> = <span class="ml-1">2.50</span>
                                    </div>
                                    <div class="mx-3 my-1">
                                        <span class="font-italic mr-1">65 - 58</span> = <span class="ml-1">2.75</span>
                                    </div>
                                    <div class="mx-3 my-1">
                                        <span class="font-italic mr-1">57 - 50</span> = <span class="ml-1">3.0</span>
                                    </div>
                                    <div class="text-danger mx-3 my-1">
                                        <span class="font-italic mr-1">49 below</span> = <span class="ml-1">5.0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>