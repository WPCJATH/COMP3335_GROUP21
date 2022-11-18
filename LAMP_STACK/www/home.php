<?php
require_once './lib/toolfuctions.php';
header_check();
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Accommodation - COMP3335 Hotel</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.4.1
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">COMP3335 Hotel</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $user?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php echo $user?></h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="index.php?logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="#">
                <i class="bi bi-house"></i>
                <span>Accommodation</span>
            </a>
        </li><!-- End Accommodation Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?signin">
                <i class="bi bi-receipt"></i>
                <span>Order</span>
            </a>
        </li><!-- End Order Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?signin">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Accommodation</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Accommodation</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">

            <?php
            $room_info = [
                [
                    'id' => 'Presidential Suite',
                    'price' => 3000,
                    'pic_dir' => 'room_type1.jpg',
                    'capacity' => 4
                ],
                [
                    'id' => 'Royal Suite',
                    'price' => 2000,
                    'pic_dir' => 'room_type2.jpg',
                    'capacity' => 3
                ],
                [
                    'id' => 'Royal Suite',
                    'price' => 1000,
                    'pic_dir' => 'room_type3.jpg',
                    'capacity' => 2
                ]
            ];

            $count = 0;
            while (isset($room_info[$count]) && $room = $room_info[$count]){
                $count++;
                $id = $room['id'];
                $price = $room['price'];
                $pic_dir = $room['pic_dir'];
                $capacity = $room['capacity'];
                echo <<< EOF
                            <div class="col-lg-6">
                                <div class="card">
                                    <img src="assets/img/$pic_dir" class="card-img-top" alt="...">
                                    <div class="card-body pt-3">
                                        <h5 class="card-title pt-2">$id</h5>
                                        <div class="tab-content pt-2">
                                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Price</div>
                                                    <div class="col-lg-9 col-md-8">$$price</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Capacity</div>
                                                    <div class="col-lg-9 col-md-8">$capacity</div>
                                                </div>
                                            </div>
                                        </div><!-- End Bordered Tabs -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Card with an image on top -->
                            <!-----Start of Reservation part------->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Make a Reservation</h5>
                                        <!-- General Form Elements -->
                                        <form>
                                            <div class="row mb-3">
                                                <label for="inputDate1" class="col-sm-2 col-form-label">Check in</label>
                                                <div class="col-sm-10">
                                                    <input id="inputDate1" type="date" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputDate2" class="col-sm-2 col-form-label">Check out</label>
                                                <div class="col-sm-10">
                                                    <input id="inputDate1" type="date" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Room Type</label>
                                              <div class="col-sm-10">
                                                <select class="form-select" aria-label="Default select example" disabled>
                                                  <option selected>$id</option>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"> </label>
                                                <div class="col-sm-10">
                                                    <a  class="btn btn-primary" href="index.php?signup">Register</a>
                                                </div>
                                            </div>
                                        </form><!-- End General Form Elements -->
                                    </div>
                                </div>
                            </div>
                            <!-----End of Reservation----->        
                    EOF;
            }
            ?>



        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>