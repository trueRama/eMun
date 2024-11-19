<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $BASEURL; ?>">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <?php if($account_type == "admin"){ ?>
        <li class="nav-item nav-category">Admin Panel</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo $BASEURL; ?>?page=emunDoctors">Manage Doctors</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo $BASEURL; ?>?page=stories">Manage Stories</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo $BASEURL; ?>?page=liveSessions">Manage Broadcasts</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo $BASEURL; ?>?page=health_hub">Manage Health Hub</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo $BASEURL; ?>?page=centers">Manage Monthly Checks</a></li>
                </ul>
            </div>
        </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#er" aria-expanded="false" aria-controls="er">
                <i class="menu-icon mdi mdi-card-text-outline" style="<?php echo $not_er_color; ?>"></i>
                <span class="menu-title" style="<?php echo $not_er_color; ?>">
                <?php if($account_type == "user"){ ?>My <?php } ?> Emergency Room</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="er">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $BASEURL; ?>?page=unassigned_ers" style="<?php echo $not_er_color; ?>">
                            Emergency Pending <?php echo $u_check_not_er; ?>
                        </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo $BASEURL; ?>?page=assigned_ers">Emergency Complete</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#pr" aria-expanded="false" aria-controls="er">
                <i class="menu-icon mdi mdi-card-text-outline" style="<?php echo $not_pr_color; ?>"></i>
                <span class="menu-title" style="<?php echo $not_pr_color; ?>">Appointment Room</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="pr">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $BASEURL; ?>?page=appointments" style="<?php echo $not_pr_color; ?>">
                            Appointments Pending <?php echo $u_check_not_pr; ?>
                        </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo $BASEURL; ?>?page=completed">Appointments Complete</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">User Panel</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">Account</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="<?php echo $BASEURL; ?>?page=profile">Edit Profile</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">help</li>
        <li class="nav-item">
            <a class="nav-link" href="https://emun.keberaorganics.com/" target="_blank">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">About Us</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="<?php echo $BASEURL; ?>?page=logout" >
                <i class="menu-icon mdi mdi-layers-outline"></i>
                <span class="menu-title">Logout</span>
            </a>
        </li>
    </ul>
</nav>