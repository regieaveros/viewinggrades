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
    body {
        position: relative;
    }
    .bg-image {
        position: absolute;
        top: 30%;
        left: 20%;
        z-index: -1;
        width: 60%;
        opacity: 0.2;
    }
</style>
<body>
    <img class="bg-image" src="<?= base_url();?>assets/dist/img/logo.png" alt="watermarks" />
    <div class="text-center">
        <h1 class="display-5"><?= $title;?></h1>
    </div>
    <hr style="border-top: 2px solid rgba(0,0,0);" />
    <div class="clearfix mt-2 mb-4">
        <div class="float-left">
            <div class="align-items-baseline">
                <p class="h5 font-weight-bold">
                    Faculty Name:
                    <span class="font-weight-normal m-1">
                        <?= $name;?>
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="h5 font-weight-bold">
                    Course:
                    <span class="font-weight-normal m-1">
                        <?= $course_code;?>
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="h5 font-weight-bold">
                    Subject Code: 
                    <span class="font-weight-normal m-1">
                        <?= substr($subject_code, 7);?>
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="h5 font-weight-bold">
                    Subject Name: 
                    <span class="font-weight-normal m-1">
                        <?= $subject_name;?>
                    </span>
                </p>
            </div>
        </div>
        <div class="float-right mr-5 pr-5">
            <div class="align-items-baseline">
                <p class="h5 font-weight-bold">
                    Section:
                    <span class="font-weight-normal m-1">
                        <?= $section;?> 
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="h5 font-weight-bold">
                    Semester:
                    <span class="font-weight-normal m-1">
                        <?= $subject_semester;?>
                    </span>
                </p>
            </div>
            <div class="align-items-baseline">
                <p class="h5 font-weight-bold">
                    Year:
                    <span class="font-weight-normal m-1">
                        <?= $subject_year;?>
                    </span>
                </p>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Student Number</th>
                <th class="text-center">Student Name</th>
                <th class="text-center">Course</th>
                <th class="text-center">Year</th>
                <th class="text-center">Section</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; ?>
            <?php foreach($data as $row) { ?>
                <tr>
                    <td class="align-middle text-center">
                        <small><?php echo $count++;?></small>
                    </td>
                    <td class="align-middle text-center">
                        <small><?= $row['id_number']?></small>
                    </td>
                    <td class="align-middle text-center">
                        <small><?= $row['name']?></small>
                    </td>
                    <td class="align-middle text-center">
                        <small><?= $row['course_code']?></small>
                    </td>
                    <td class="align-middle text-center">
                        <small><?= $row['year_level']?></small>
                    </td>
                    <td class="align-middle text-center">
                        <small><?= $row['section']?></small>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>