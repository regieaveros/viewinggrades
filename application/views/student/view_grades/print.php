<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title;?></title>
    <link rel="stylesheet" href="<?= base_url();?>css/bootstrap.min.css">
</head>
<style>
    .bg-image {
        position: absolute;
        top: 30%;
        left: 20%;
        z-index: -1;
        width: 60%;
        opacity: 0.2;
    }
    .info-layout {
        position:relative;
        height:7%;
    }
    .image-layout {
        position:absolute;
        top:0;
        left:0;
    }
    .position-left {
        position:absolute;
        top:5%;
        left:26%;
    }
    .position-right {
        position:absolute;
        top:5%;
        left:81%;
    }
    .hr-layout {
        border-top: 2px solid rgba(0,0,0);
    }
</style>
<body class="mt-3">
    <div class="info-layout">
        <div class="image-layout">
            <img src="<?= base_url();?>assets/dist/img/logo.png" alt="watermarks" width="80" height="80" />
        </div>
        <div class="text-center position-left">
            <p class="h4 text-uppercase font-weight-bold p-0 m-0">San Sebastian College</p>
            <p class="h4 text-uppercase font-weight-bold p-0 m-0">Office Of The Registrar</p>
        </div>
        <div class="text-primary position-right">
            <p class="h5 text-right text-uppercase font-weight-bold p-0 m-0">Record</p>
            <p class="h5 text-right text-uppercase font-weight-bold p-0 m-0">Of Student</p>
        </div>
    </div>
    <hr class="hr-layout" />
    <div class="clearfix mt-2 mb-4">
        <div class="float-left">
            <div class="align-items-baseline">
                <p class="font-weight-bold p-0 m-0 mt-1">
                    Student No:
                    <span class="font-weight-normal">
                        <?= $id_number;?>
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="font-weight-bold p-0 m-0 mt-1">
                    Student Name:
                    <span class="font-weight-normal">
                        <?= $name;?>
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="font-weight-bold p-0 m-0 mt-1">
                    Subject Code:
                    <span class="font-weight-normal">
                        <?= substr($subject_code, 7);?>
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="font-weight-bold p-0 m-0 mt-1">
                    Subject Name: 
                    <span class="font-weight-normal">
                        <?= $subject_name;?>
                    </span>
                </p>
            </div>
        </div>
        <div class="float-right">
            <div class="align-items-baseline">
                <p class="font-weight-bold p-0 m-0 mt-1">
                    Course:
                    <span class="font-weight-normal">
                        <?= $course_code;?>
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="font-weight-bold p-0 m-0 mt-1">
                    Section:
                    <span class="font-weight-normal">
                        <?= $section;?>
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="font-weight-bold p-0 m-0 mt-1">
                    Year:
                    <span class="font-weight-normal">
                        <?= $year_level;?>
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="font-weight-bold p-0 m-0 mt-1">
                    Date Admitted:
                    <span class="font-weight-normal"><?= $semester;?> Semester&#44;</span> <span class="font-weight-normal"><?= date('Y')."-".date('Y', strtotime('+1 years'));?></span>
                </p>
            </div>
        </div>
    </div>
    <table class="table table-bordered m-0">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Subject Code</th>
                <th class="text-center">Descriptive Title</th>
                <th class="text-center">Final</th>
                <th class="text-center">Credit</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; ?>
            <?php foreach($subjects as $subject) {?>
                <tr>
                    <td class="align-middle text-center">
                        <?= $count++;?>
                    </td>
                    <td class="align-middle text-center">
                        <?= substr($subject['subject_code'], 7);?>
                    </td>
                    <td class="align-middle text-center">
                        <?= $subject['subject_name'];?>
                    </td>
                    <td class="align-middle text-center">
                        <?php
                            switch($subject['final_grade']) {
                                case $subject['final_grade'] >= 98: 
                                    echo "<span class='font-weight-normal'>1.0</span>";
                                    break;
                                case $subject['final_grade'] >= 94: 
                                    echo "<span class='font-weight-normal'>1.25</span>";
                                    break;
                                case $subject['final_grade'] >= 90: 
                                    echo "<span class='font-weight-normal'>1.50</span>";
                                    break;
                                case $subject['final_grade'] >= 87: 
                                    echo "<span class='font-weight-normal'>1.75</span>";
                                    break;
                                case $subject['final_grade'] >= 84: 
                                    echo "<span class='font-weight-normal'>2.0</span>";
                                    break;
                                case $subject['final_grade'] >= 76: 
                                    echo "<span class='font-weight-normal'>2.25</span>";
                                    break;
                                case $subject['final_grade'] >= 66: 
                                    echo "<span class='font-weight-normal'>2.50</span>";
                                    break;
                                case $subject['final_grade'] >= 58: 
                                    echo "<span class='font-weight-normal'>2.75</span>";
                                    break;
                                case $subject['final_grade'] >= 50: 
                                    echo "<span class='font-weight-normal'>3.0</span>";
                                    break;
                                case $subject['final_grade'] <= 49: 
                                    echo "<span class='text-danger'>5.0</span>";
                                    break;
                                default: 
                                    echo "None";
                                    break;
                            }
                        ?>
                    </td>
                    <td class="align-middle text-center">
                        <?= $subject['units'];?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="border border-top-0 py-1 px-3">
        <span class="font-weight-bolder mr-1">Grading System:</span>
        <span class="small font-weight-bold font-italic mx-3">1.0&#44; Excellent&#59;</span>
        <span class="small font-weight-bold font-italic mx-3">1.25&#44; Superior&#59;</span>
        <span class="small font-weight-bold font-italic mx-3">1.50&#44; Very Good&#59;</span>
        <span class="small font-weight-bold font-italic mx-3">1.75&#44; Good&#594;</span>
        <div class="ml-3">
            <span class="small font-weight-bold font-italic mx-1">2.0&#44; Very Satisfactory&#59;</span>
            <span class="small font-weight-bold font-italic mx-1">2.25&#44; Satisfactory&#59;</span>
            <span class="small font-weight-bold font-italic mx-1">2.50&#44; Average&#59;</span>
            <span class="small font-weight-bold font-italic mx-1">2.75&#44; Fair&#59;</span>
            <span class="small font-weight-bold font-italic mx-1">3.0&#44; Passed&#59;</span>
            <span class="small font-weight-bold font-italic mx-1">5.0&#44; Failed&#59;</span>
        </div>
        <span class="font-weight-bolder mr-1">Credits:</span>
        <span class="small font-weight-bold font-italic">One unit of credit is none hour lecture or recitation, or three hours of laboratory, drafting, <span class="ml-5">or shopwork, each week for the period of a complete semester.</span></span>
    </div>
    <div class="border-top-0 border small font-weight-bold font-italic py-1 px-3">
        This record is valid only when it bears the University seal and the original signature of the Registrar. Any erasure or alteration made on this document renders it void unless initialed by the foregoing official.
    </div>
</body>
</html>