<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="brand-link">
        <img src="<?= base_url();?>assets/dist/img/logo.png" alt="Book Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <h4 class="brand-text font-weight-light">Admin Panel</h4>
    </div>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">USER LIST</li>
                <li class="nav-item">
                    <a href="<?= base_url();?>" id="default_url" data-id="default_url" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>semester" id="semester" data-id="semester" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Semester</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>section" id="section" data-id="section" class="nav-link">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>Section</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>course" id="course" data-id="course" class="nav-link">
                        <i class="nav-icon fas fa-landmark"></i>
                        <p>Course</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>subject" id="subject" data-id="subject" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Subject</p>
                    </a>
                </li>
                <li id="menu-open-faculty" class="nav-item">
                    <a href="#" id="link-faculty" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Faculty / Instructor
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url();?>faculty" id="faculty" data-id="faculty" class="nav-link">
                                <i class="nav-icon fas fa-caret-right"></i>
                                <p>Faculty</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url();?>faculty-subject" id="faculty-subject" data-id="faculty-subject" class="nav-link">
                                <i class="nav-icon fas fa-caret-right"></i>
                                <p>Faculty Subject</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li id="menu-open-student" class="nav-item">
                    <a href="#" id="link-students" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Students List
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url();?>students" id="students" data-id="students" class="nav-link">
                                <i class="nav-icon fas fa-caret-right"></i>
                                <p>Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url();?>student-subject" id="student-subject" data-id="student-subject" class="nav-link">
                                <i class="nav-icon fas fa-caret-right"></i>
                                <p>Student Subject</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
