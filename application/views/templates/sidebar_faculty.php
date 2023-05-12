<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="brand-link">
        <img src="<?= base_url();?>assets/dist/img/logo.png" alt="Book Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <h4 class="brand-text font-weight-light">Faculty Panel</h4>
    </div>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">USER LIST</li>
                <li class="nav-item">
                    <a href="<?= base_url();?>grade-criteria" id="default_url" data-id="default_url" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Set Grade Criteria</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>grades" id="set-grade" data-id="set-grade" class="nav-link">
                        <i class="nav-icon fas fa-list-ol"></i>
                        <p>Set Grade</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>student-list" id="student-list" data-id="student-list" class="nav-link">
                        <i class="nav-icon fas fa-print"></i>
                        
                        <p>Print Student List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url();?>student-grade" id="student-grade" data-id="student-grade" class="nav-link">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>Print Student Grade</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
