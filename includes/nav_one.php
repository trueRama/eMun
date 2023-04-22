<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div>
            <a class="navbar-brand brand-logo" href="?">
                <img src="appStyle/logo.png" alt="logo" style="width: 100%; height: 100px; object-fit: contain"/>
            </a>
            <a class="navbar-brand brand-logo-mini" href="?">
                <img src="appStyle/logo.png" alt="logo" style="width: 100%; height: 100px; object-fit: contain" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-sub-text">Account: <span class="text-black fw-bold"><?php echo $username; ?></span></h1>
                <h3 class="welcome-sub-text">This week on the EMUN Platform</h3>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <form class="search-form" action="#">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown" style="<?php echo $not_er_color; ?>">
                    <i class="icon-mail icon-lg" ></i><?php echo $u_check_not_er+$u_check_not_pr; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item py-3 border-bottom">
                        <p class="mb-0 font-weight-medium float-left">You have <?php echo $u_check_not_er+$u_check_not_pr; ?> new notifications </p>
                    </a>
                    <a class="dropdown-item preview-item py-3" style="<?php echo $not_er_color; ?>">
                        <div class="preview-item-content">
                            <h6 class="preview-subject fw-normal mb-1" style="<?php echo $not_er_color; ?>">Emergency <?php echo $u_check_not_er; ?></h6>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item py-3" style="<?php echo $not_pr_color; ?>">
                        <div class="preview-item-content">
                            <h6 class="preview-subject fw-normal mb-1" style="<?php echo $not_pr_color; ?>">Appointments <?php echo $u_check_not_pr; ?></h6>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="<?php echo $profile_pic; ?>" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" style="width: 25%; object-fit: contain" src="<?php echo $profile_pic; ?>" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold"><?php echo $username; ?></p>
                        <p class="fw-light text-muted mb-0"><?php echo $email; ?></p>
                    </div>
                    <a class="dropdown-item" href="<?php echo $BASEURL; ?>?page=profile"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile
                    </a>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
                    <a class="dropdown-item" href="<?php echo $BASEURL; ?>?page=logout"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>