<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title;?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url();?>assets/dist/img/icon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?= base_url();?>css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?= base_url();?>css/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url();?>css/styles.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <div class="preloader justify-content-center align-items-center">
        <div class="spinner-grow text-primary mx-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-primary mx-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-primary mx-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-cog"></i>
                </a>
                <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                    <div class="d-flex align-items-center px-3">
                        <div class="mr-2">
                            <?php if($this->session->avatar != '') { ?>
                                <img src="<?= base_url();?>assets/dist/img/<?= $this->session->avatar;?>" class="img-circle elevation-2" width="46px" alt="User Avatar">
                            <?php } else { ?>
                                <img src="<?= base_url();?>assets/dist/img/default.png" class="img-circle elevation-2" width="46px" alt="User Avatar">
                            <?php } ?>
                        </div>
                        <div class="text-left">
                            <div class="text-body h5 p-0 m-0"><?= $this->session->name;?></div>
                            <div class="text-muted p-0 m-0"><?= $this->session->email;?></div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url()?>profile" class="dropdown-item d-flex justify-content-center">
                        <i class="fas fa-user pr-3"></i>
                        <h3 class="dropdown-item-title text-uppercase">profile</h3>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url()?>logout" id="logout" class="dropdown-item d-flex justify-content-center">
                        <i class="fas fa-sign-out-alt pr-3"></i>
                        <h3 class="dropdown-item-title text-uppercase">logout</h3>
                    </a>
                </div>
            </li>
        </ul>
    </nav>