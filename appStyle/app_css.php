<!-- plugins:css -->
<link rel="stylesheet" href="appStyle/vendors/feather/feather.css">
<link rel="stylesheet" href="appStyle/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="appStyle/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="appStyle/vendors/typicons/typicons.css">
<link rel="stylesheet" href="appStyle/vendors/simple-line-icons/css/simple-line-icons.css">
<link rel="stylesheet" href="appStyle/vendors/css/vendor.bundle.base.css">
<!-- endinject -->
<!-- Plugin css for this page -->
<link rel="stylesheet" href="appStyle/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="appStyle/js/select.dataTables.min.css">
<link rel="stylesheet" href="appStyle/vendors/select2/select2.min.css">
<link rel="stylesheet" href="appStyle/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="appStyle/css/vertical-layout-light/style.css">
<style>
    /* sign_up Form     css */
    .my_logo{
        width: 100%;
        height: 250px;
        object-fit: contain
    }
    .my_logo_2{
        width: 100%;
        object-fit: contain
    }
    .my_charts{
        /*width: 100%; rgba(154, 205, 50, 0.5)*/
        background-color: rgba(154, 205, 50, 0.1);
        border-radius: 45px 10px 50px 10px;
    }
    .slick{
        border-bottom: solid 2px goldenrod;
        border-radius: 0px 0px  15px 15px;
    }
    .form-control, .asColorPicker-input, .dataTables_wrapper select, .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--single .select2-search__field, .typeahead, .tt-query, .tt-hint {
        height: 2.8rem;
    }
    .auth form .form-group .form-control, .auth form .form-group .asColorPicker-input, .auth form .form-group .dataTables_wrapper select, .dataTables_wrapper .auth form .form-group select, .auth form .form-group .select2-container--default .select2-selection--single, .select2-container--default .auth form .form-group .select2-selection--single, .auth form .form-group .select2-container--default .select2-selection--single .select2-search__field, .select2-container--default .select2-selection--single .auth form .form-group .select2-search__field, .auth form .form-group .typeahead, .auth form .form-group .tt-query, .auth form .form-group .tt-hint {
        background: transparent;
        border-radius: 10px;
        font-size: .9375rem;
        border-color: lightskyblue;
    }
    .auth form .form-group .form-control:hover, .auth form .form-group .asColorPicker-input:hover, .auth form .form-group .dataTables_wrapper select:hover,
    .dataTables_wrapper .auth form .form-group select:hover,
    .auth form .form-group .select2-container--default .select2-selection--single:hover,
    .select2-container--default .auth form .form-group .select2-selection--single:hover,
    .auth form .form-group .select2-container--default .select2-selection--single .select2-search__field:hover,
    .select2-container--default .select2-selection--single .auth form .form-group .select2-search__field:hover,
    .auth form .form-group .typeahead:hover, .auth form .form-group .tt-query:hover, .auth form .form-group .tt-hint:hover {
        border-color: saddlebrown;
    }
    .form-check-label{
        /*color: red;*/
        font-family: Georgia;
        font-weight: bold;
    }
    .my_button{
        background-color: lightskyblue
    }
    .my_button:hover{
        background-color: orange;
    }
    .navbar .navbar-brand-wrapper {
        background-color: rgba(255, 255, 255, 0.0);
    }

    .navbar .navbar-menu-wrapper {
        background-color: rgba(255, 255, 255, 0.0);
    }
    .navbar {
        background-color: rgba(264, 245, 247, 0.9);
        box-shadow: brown;
        margin: 0px 0px 0px 10px;
        border-radius:0px 0px 0px 20px;
        border-bottom: solid 2px rgba(0, 191, 255, 0.9);
    }
    .sidebar {
        background-color: rgba(0, 191, 255, 0.9);
        margin: 10px;
        border-radius: 20px;
    }
    .page-body-wrapper {
        background: #F4F5F7;
    }
    .mmShow{
         display: none;
     }
    @media (max-width: 991px){
        .my_card_button{
            margin: 10px;
        }
        .my-text{
            font-size: 10px;
        }
        .page-item{
            line-height: 0.85;
        }
        .mmHide{
            display: none;
        }
        .mmShow{
            display: block;
        }
        .navbar .navbar-menu-wrapper {
            background-color: rgba(0, 191, 255, 0.9);
            /*background-image: linear-gradient(to right, rgba(255,255,255,0.5), rgba(0, 255, 100, 0.5));*/
            border-radius: 10px 0px 0px 10px;
            border-bottom: 2px solid #590D07;
        }
        .navbar .navbar-brand-wrapper {
            border-radius: 25px 25px 25px 25px;
        }
        .navbar .navbar-brand-wrapper {
             width: 110px;
        }
        .navbar .navbar-menu-wrapper {
            width: calc(70% - 5px);
            padding-top: 12px;
            padding-left: 15px;
            padding-right: 11px;
            height: auto;
        }
        .navbar {
            border-bottom: solid 2px rgba(0, 191, 255, 0.9);
            border-radius: 0px 0px 10px 10px;
            margin: 0px 0px 0px 0px;
            /*background-color: lightskyblue;*/
            /*background-image: url("appStyle/bg3.png");*/
            /*background-repeat: repeat;*/
        }
    }
    @media only screen and (max-width: 720px){
        .my_logo{
            height: 150px;
        }
    }
    @media (max-width: 480px){
        .navbar .navbar-brand-wrapper {
             width: 100px;
        }
    }
</style>