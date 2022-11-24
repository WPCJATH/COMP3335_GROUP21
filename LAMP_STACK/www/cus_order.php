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
        <a href="index.php?home" class="logo d-flex align-items-center">
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
                        <div class="accordion" id="accordionFlushExample">
                            <?php

                            include_once "./lib/config.php";
                            include_once "./lib/toolfuctions.php";
                            $config_ = get_config();
                            $user_info = get_user_info();

                            error_reporting(0);
                            mysqli_report(MYSQLI_REPORT_OFF);
                            $conn = mysqli_connect($config_['mysql_info']['host'], $user_info['user'],
                                $user_info['pass'], $config_['mysql_info']['database']);

                            $sql = "SELECT `RES_ID`, `CHECKIN_DATE`, `DURATION`, `ROOM_TYPE`, `AMT`, `CANCELLED`, `IS_ORDER`
                                    FROM `RESERVATION` WHERE `CUS_ID`='".mysqli_real_escape_string($conn, $user_info['user'])."';";

                            $result = mysqli_query($conn, $sql);
                            $count1 = 0;
                            $reservations = [];
                            if ($result && mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_assoc($result)){
                                    $reservations[$count1++] = $row;
                                }
                            }
                            else{
                                echo "<p class=\"text-center\">You do not have any order or reservation yet. Click <a href=\"index.php?home\">here</a> to place an reservation.</p>";
                            }

                            while ($count1 > 0){
                                $count1--;
                                $reservation = $reservations[$count1];
                                $res_id = $reservation['RES_ID'];
                                $check_in = $reservation['CHECKIN_DATE'];
                                $duration = $reservation['DURATION'];
                                $amt = $reservation['AMT'];
                                $room_type = $reservation['ROOM_TYPE'];
                                $is_cancelled = $reservation['CANCELLED'];
                                $is_order = $reservation['IS_ORDER'];

                                $sql = "SELECT `PARTNER_ID` FROM `TRAVEL_PARTNER_INORDER` WHERE `RES_ID`='".mysqli_real_escape_string($conn, $res_id)."';";
                                $result = mysqli_query($conn, $sql);
                                $count2 = 0;
                                $partner_ids = [];
                                if ($result && mysqli_num_rows($result) > 0){
                                    while ($row = mysqli_fetch_assoc($result)){
                                        $partner_ids[$count2++] = $row['PARTNER_ID'];
                                    }
                                }

                                $count3 = 0;
                                $partners_info = [];
                                foreach ($partner_ids as $partner_id){
                                    $sql = "SELECT `NAME`, `ID_NO` FROM `CUSTOMER` WHERE `CUS_ID`='".mysqli_real_escape_string($conn, $partner_id)."';";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result && mysqli_num_rows($result) > 0)
                                        $partners_info[$count3++] = mysqli_fetch_assoc($result);
                                }

                                $show = ($is_cancelled)? "":"show";
                                $cancelled = ($is_cancelled)? "(Cancelled)":"";
                                $disabled = ($is_order || $is_cancelled)? "disabled":"";
                                $expanded = ($is_cancelled);

                                $guests_member = "";

                                foreach ($partners_info as $partner_info){
                                    $name = $partner_info['NAME'];
                                    $id_no = $partner_info['ID_NO'];
                                    $guests_member = $guests_member."<div class=\"col-lg-9 col-md-8\">$name $id_no</div>\n";
                                }

                                $sql= "SELECT `IMAGE_DIR` FROM `ROOM_TYPE` WHERE `TYPE`='".mysqli_real_escape_string($conn, $room_type)."';";
                                $result = mysqli_query($conn, $sql);
                                $pic_file = 'logo.png';
                                if ($result && mysqli_num_rows($result) > 0){
                                    $pic_file = mysqli_fetch_assoc($result)['IMAGE_DIR'];
                                }

                                echo <<< EOF
                                    <div class="accordion-item">
                                          
                                          <h2 class="accordion-header" id="flush-heading$count1">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse$count1"  aria-controls="flush-collapse$count1">
                                              Order ID: $res_id $cancelled
                                            </button>
                                          </h2>
                                          
                                          <div id="flush-collapse$count1" class="accordion-collapse collapse $show" aria-labelledby="flush-heading$count1">
                                            <div class="row accordion-body">
                                                <div class="col-lg">
                                                      <div class=" fade show active profile-overview" id="order-details1">

                                                        <div class="row pt-3 ps-3">
                                                            <br>
                                                          <div class="col-lg-3 pt-3">
                                                              <img src="assets/img/$pic_file" class="card-img-top" alt="...">
                                                          </div>

                                                          <div class="col-lg-5 ps-5">
                                                            <h5 class="card-title">Order Details:</h5>
                                                            
                                                            <div class="row">
                                                              <div class="col-lg-3 col-md-4 label ">Room Type</div>
                                                              <div class="col-lg-9 col-md-8">$room_type</div>
                                                            </div>

                                                            <div class="row">
                                                              <div class="col-lg-3 col-md-4 label ">Check in date</div>
                                                              <div class="col-lg-9 col-md-8">$check_in</div>
                                                            </div>

                                                            <div class="row">
                                                              <div class="col-lg-3 col-md-4 label">Occupancy Days</div>
                                                              <div class="col-lg-9 col-md-8">$duration</div>
                                                            </div>

                                                            <div class="row">
                                                              <div class="col-lg-3 col-md-4 label">Amount</div>
                                                              <div class="col-lg-9 col-md-8">$$amt</div>
                                                            </div>

                                                            <div class="row">
                                                              <div class="col-lg-3 col-md-4 label">Guests Members</div>
                                                              <div class="col-lg-9 col-md-8">
                                                                    $guests_member
                                                              </div>
                                                            </div>

                                                            
                                                            <br>
                                                            <div id="insert$count1"></div>
                                                            

                                                          </div>
                                                          
                                                          <div class="col-lg-3 ps-5" id="qrcode_container$count1">
                                                                <br>
                                                                <script>
                                                                    new QRCode(document.getElementById("qrcode_container$count1"), "$res_id");
                                                                </script>
                                                          </div>
                                                         
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label class="col-sm-5 col-form-label"> </label>
                                                            <div class="col-sm-2">
                                                                 <button id="cancel_btn$count1" class="btn btn-outline-danger" $disabled>Cancel</button>
                                                            </div>
                                                            <label class="col-sm-5 col-form-label"> </label>
                                                        </div>
                                                        
                                                        <script>
                                                            document.getElementById("cancel_btn$count1").onclick = function () {
                                                                return cancel_order("$res_id", "insert$count1");
                                                            }
                                                        </script>
                                                </div>  
                                            </div>
                                          </div>
                                        </div>
                                EOF;
                            }
                            mysqli_close($conn);

                                ?>


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
<script src="assets/js/tool_functions.js"></script>
<script src="assets/jquery/jquery-3.6.0.min.js"></script>
<script>
    function cancel_order(order_id, alert_id){
        $.ajax({
            url: 'index.php?del_order',
            type : "POST",
            dataType : 'json',
            data : {
                res_id: order_id
            },
            success: function(results) {
                console.log(results);
                if (results.status === 1){
                    window.location.replace("index.php?order");
                }
                else{
                    customAlert(results.msg, alert_id);
                }
            },
            error: function() {
                customAlert("Oops! Request failed! Please check your Internet Connection.", alert_id);
            }
        });
        return false;
    }
</script>

</body>

</html>
