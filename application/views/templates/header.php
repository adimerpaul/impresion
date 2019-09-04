
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistema de targetas</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=base_url()?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
<!--    <link rel="stylesheet" href="--><?//=base_url()?><!--assets/vendors/iconfonts/ionicons/css/ionicons.css">-->
<!--    <link rel="stylesheet" href="--><?//=base_url()?><!--assets/vendors/iconfonts/typicons/src/font/typicons.css">-->
<!--    <link rel="stylesheet" href="--><?//=base_url()?><!--assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">-->
<!--    <link rel="stylesheet" href="--><?//=base_url()?><!--assets/vendors/css/vendor.bundle.base.css">-->
<!--    <link rel="stylesheet" href="--><?//=base_url()?><!--assets/vendors/css/vendor.bundle.addons.css">-->
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->


    <link rel="stylesheet" href="<?=base_url()?>node_modules/bootstrap/dist/css/bootstrap.css">


    <link rel="stylesheet" href="<?=base_url()?>assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/demo_1/style.css">
    <link rel="stylesheet" href="<?=base_url()?>node_modules/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?=base_url()?>node_modules/datatables.net-dt/css/jquery.dataTables.css">
    <link rel="stylesheet" href="<?=base_url()?>node_modules/datatables.net-responsive-dt/css/responsive.dataTables.css">

    <link rel="stylesheet" href="<?=base_url()?>node_modules/toastr/build/toastr.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <a class="navbar-brand brand-logo" href="<?=base_url()?>Main">
                <img src="<?=base_url()?>assets/images/logo.svg" alt="logo" /> </a>
            <a class="navbar-brand brand-logo-mini" href="<?=base_url()?>Main">
                <img src="<?=base_url()?>assets/images/logo-mini.svg" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <ul class="navbar-nav">
                <li class="nav-item font-weight-semibold d-none d-lg-block">Help : 2 5265595 </li>

            </ul>
            <!--            <form class="ml-auto search-form d-none d-md-block" action="#">-->
            <!--                <div class="form-group">-->
            <!--                    <input type="search" class="form-control" placeholder="Search Here">-->
            <!--                </div>-->
            <!--            </form>-->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <img class="img-xs rounded-circle" src="<?=base_url()?>assets/images/faces/face8.png" alt="Profile image"> </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-md rounded-circle" src="<?=base_url()?>assets/images/faces/face8.png" alt="Profile image">
                            <p class="mb-1 mt-3 font-weight-semibold"><?=$_SESSION['nombre']?></p>
                            <p class="font-weight-light text-muted mb-0"><?=$_SESSION['tipo']?></p>
                        </div>
                        <a class="dropdown-item" href="<?=base_url()?>Welcome/logout">Salir<i class="dropdown-item-icon ti-power-off"></i></a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
