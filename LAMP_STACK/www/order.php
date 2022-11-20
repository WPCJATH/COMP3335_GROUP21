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

    <title>Order - COMP3335 Hotel</title>
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
    <script src="assets/QRCode/qrcode.js"></script>

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
        <a href="index.html" class="logo d-flex align-items-center">
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
                        <a class="dropdown-item d-flex align-items-center" href="index.php?profile">
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
            <a class="nav-link collapsed" href="index.php?home">
                <i class="bi bi-house"></i>
                <span>Accommodation</span>
            </a>
        </li><!-- End Order Nav -->

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-receipt"></i>
                <span>Order</span>
            </a>
        </li><!-- End Order Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?profile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?home">Home</a></li>
                <li class="breadcrumb-item active">Order</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <!--      <h5 class="card-title">Choose an order to view</h5>   --->

                        <!-- Accordion without outline borders -->
                        <div class="accordion accordion-flush" id="accordionFlushExample">


                            <div class="accordion-item">

                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Presidential Suite
                                        <!------TODO: change 'Presidential Suite' according to the room type in the order----->
                                    </button>
                                </h2>

                                <div id="flush-collapseOne" class="accordion-collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="row">
                                        <div class="col-lg">
                                            <div class="card">
                                                <div class="card-body pt-3">
                                                    <!-- Bordered Tabs -->
                                                    <ul class="nav nav-tabs nav-tabs-bordered">

                                                        <li class="nav-item">
                                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#order-details1">Order Details</button>
                                                            <!--- TODO: change the if of this button: "#order-details1"---->
                                                        </li>

                                                        <li class="nav-item">
                                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#order-edit1">Edit Order</button>
                                                            <!--- TODO: change the if of this button: "#order-edit1"---->
                                                        </li>

                                                    </ul>
                                                    <div class="tab-content pt-2">

                                                        <div class="tab-pane fade show active profile-overview" id="order-details1">
                                                            <!--- TODO: change the if of this div: "#order-details1"---->
                                                            <div class="row pt-3 ps-3">
                                                                <div class="col-lg-3 ps-5" id="qrcode_container">
                                                                    <h5 class="card-title">QR Code:</h5>
                                                                    <script>
                                                                        new QRCode(document.getElementById("qrcode_container"), "428377272847372");
                                                                    </script>
                                                                </div>
                                                                <div class="col-lg-9 ps-5">
                                                                    <h5 class="card-title">Order Details:</h5>
                                                                    <!------TODO: change 'Presidential suite' according to the room tye in the order----->

                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-4 label ">Check-in Date</div>
                                                                        <div class="col-lg-9 col-md-8">some day</div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-4 label">Duration</div>
                                                                        <div class="col-lg-9 col-md-8">10 days</div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-4 label">Amount</div>
                                                                        <div class="col-lg-9 col-md-8">998</div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-4 label">Status</div>
                                                                        <div class="col-lg-9 col-md-8">Booked</div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-4 label">Guest Members</div>
                                                                        <div class="col-lg-9 col-md-8">
                                                                            <div class="col-lg-9 col-md-8">Booked</div>
                                                                            <div class="col-lg-9 col-md-8">Booked</div>
                                                                            <div class="col-lg-9 col-md-8">Booked</div>
                                                                            <div class="col-lg-9 col-md-8">Booked</div>
                                                                        </div>
                                                                    </div>

                                                                    <br>
                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-2 col-form-label"> </label>
                                                                        <div class="col-sm-10">
                                                                            <button type="submit" class="btn btn-outline-danger">Cancel</button>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="tab-pane fade profile-edit pt-3 ps-3" id="order-edit1">
                                                            <!--- TODO: change the if of this div: "#order-details1"---->

                                                            <!-----Start of Reservation part------->
                                                            <div class="col-lg">

                                                                <!-- General Form Elements -->
                                                                <form>
                                                                    <div class="row mb-3">
                                                                        <label for="inputDate" class="col-sm-2 col-form-label">Check in</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="date" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="inputDate" class="col-sm-2 col-form-label">Check out</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="date" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-2 col-form-label">Room Type</label>
                                                                        <div class="col-sm-10">
                                                                            <select class="form-select" aria-label="Default select example">
                                                                                <option selected>Select room type</option>
                                                                                <option value="1">Presidential Suite</option>
                                                                                <option value="2">Royal Suite</option>
                                                                                <option value="3">Deluxe Suite</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-2 col-form-label"> </label>
                                                                        <div class="col-sm-10">
                                                                            <button type="submit" class="btn btn-primary">Confirm modification</button>
                                                                        </div>
                                                                    </div>

                                                                </form><!-- End General Form Elements -->

                                                            </div>
                                                            <!-----End of Reservation----->

                                                        </div>

                                                    </div><!-- End Bordered Tabs -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Order 2
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="row">
                                        <div class="col-lg">
                                            <div class="card">
                                                <div class="card-body pt-3">
                                                    <!-- Bordered Tabs -->
                                                    <ul class="nav nav-tabs nav-tabs-bordered">

                                                        <li class="nav-item">
                                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#order-details2">Order Details</button>
                                                        </li>

                                                        <li class="nav-item">
                                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#order-edit2">Edit Order</button>
                                                        </li>

                                                    </ul>
                                                    <div class="tab-content pt-2">

                                                        <div class="tab-pane fade show active profile-overview" id="order-details2">
                                                            <div class="row pt-3 ps-3">
                                                                <div class="col-lg-3 pt-3">
                                                                    <img src="assets/img/card.jpg" class="card-img-top" alt="...">
                                                                </div>
                                                                <div class="col-lg-9 ps-5">
                                                                    <h5 class="card-title">Presidential Suite</h5>
                                                                    <!------TODO: change 'Presidential suite' according to the room tye in the order----->

                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-4 label ">Check in date</div>
                                                                        <div class="col-lg-9 col-md-8">some day</div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-4 label">Check out date</div>
                                                                        <div class="col-lg-9 col-md-8">some day</div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-4 label">Amount</div>
                                                                        <div class="col-lg-9 col-md-8">998</div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-4 label">Status</div>
                                                                        <div class="col-lg-9 col-md-8">Booked</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="tab-pane fade profile-edit pt-3 ps-3" id="order-edit2">

                                                            <!-----Start of Reservation part------->
                                                            <div class="col-lg">

                                                                <!-- General Form Elements -->
                                                                <form>
                                                                    <div class="row mb-3">
                                                                        <label for="inputDate" class="col-sm-2 col-form-label">Check in</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="date" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="inputDate" class="col-sm-2 col-form-label">Check out</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="date" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-2 col-form-label">Room Type</label>
                                                                        <div class="col-sm-10">
                                                                            <select class="form-select" aria-label="Default select example">
                                                                                <option selected>Select room type</option>
                                                                                <option value="1">Presidential Suite</option>
                                                                                <option value="2">Royal Suite</option>
                                                                                <option value="3">Deluxe Suite</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-2 col-form-label"> </label>
                                                                        <div class="col-sm-10">
                                                                            <button type="submit" class="btn btn-primary">Confirm modification</button>
                                                                        </div>
                                                                    </div>

                                                                </form><!-- End General Form Elements -->

                                                            </div>
                                                            <!-----End of Reservation----->

                                                        </div>

                                                    </div><!-- End Bordered Tabs -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                    </div>
                </div>
            </div>


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
