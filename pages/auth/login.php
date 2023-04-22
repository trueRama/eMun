<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <img src="appStyle/logo.png" alt="logo" class="my_logo">
                        <h4>Hello! let's get started</h4>
                        <h6 class="fw-light">Login to continue.</h6>
                        <form class="pt-3" method="post" action="<?php echo $BASEURL; ?>?page=login_user">
                            <div class="form-group">
                                <input type="text" name="username"
                                       class="form-control form-control-lg" id="username"
                                       placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password"
                                       class="form-control form-control-lg" id="password"
                                       placeholder="Password" required>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-sm font-weight-medium auth-form-btn my_button">SIGN IN</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input">
                                        Keep me signed in
                                    </label>
                                </div>
                                <a href="#" class="auth-link text-black">Forgot password?</a>
                            </div>
                            <div class="text-center mt-4 fw-light">
                                Don't have an account? <a href="<?php echo $BASEURL; ?>?page=signUp" class="text-primary">Create One</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>