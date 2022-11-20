<?php
require_once './lib/toolfuctions.php';
header_check();
$user = $_SESSION['user'];
$info = get_user_info();
$floor = $info['floor'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Room Cleaning Records - COMP3335 Hotel</title>
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
        <a href="index.php?home" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Cleaner System</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $user;?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php echo $user;?></h6>
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
            <a class="nav-link" href="index.php?home">
                <i class="bi bi-house"></i>
                <span>Room Cleaning Status</span>
            </a>
        </li><!-- End Room Cleaning Status Nav -->

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
        <h1>Room Cleaning Status</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?home">Home</a></li>
                <li class="breadcrumb-item active">Room Cleaning Status</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10">
                        <h5 class="card-title">Check cleaning status</h5>
                    </div>
                </div>

                <!-- Default Table -->
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Room Number</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Occupied</th>
                        <th scope="col">Cleaned</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include_once "./lib/config.php";
                    include_once "./lib/toolfuctions.php";
                    $config_ = get_config();
                    $user_info = get_user_info();

                    error_reporting(0);
                    mysqli_report(MYSQLI_REPORT_OFF);
                    $conn = mysqli_connect($config_['mysql_info']['host'], $user_info['user'],
                        $user_info['pass'], $config_['mysql_info']['database']);

                    $sql = "SELECT `ROOM_NO`, `ROOM_TYPE`, `IS_CLEAN` FROM `ROOM` WHERE `ROOM_NO` like '".mysqli_real_escape_string($conn, $floor)."%';";
                    $result = mysqli_query($conn, $sql);
                    $room_status = [];
                    $counter = 0;
                    if ($result && mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_assoc($result)){
                            $room_status[$counter++] = $row;
                        }
                    }
                    mysqli_close($conn);

                    usort($room_status, function($a, $b){
                        return intval($a['ROOM_NO']) > intval($b['ROOM_NO']) ? 1:-1;
                    });

                    foreach ($room_status as $status){
                        $room_no = $status['ROOM_NO'];
                        $room_type = $status['ROOM_TYPE'];
                        $cleaned = $status['IS_CLEAN'];

                        $true = "<td>✅</td>";
                        $false = "<td>✖️</td>";

                        $cleaned_status = ($cleaned)? $true:$false;
                        $disable = ($cleaned)? "disabled":"";
                        $bind_func = "
                            <script>
                                document.getElementById(\"btn$room_no\").onclick = function (){
                                    update_clean(\"$room_no\");
                                }
                            </script>
                        ";
                        $bind_func = ($cleaned)? "":$bind_func;

                        echo <<< EOF
                            <tr>
                                <th scope="row">$room_no</th>
                                <td>$room_type</td>
                                $cleaned_status
                                <td>
                                    <div class="my-sm-3">
                                      <button id="btn$room_no" type="submit" class="btn btn-primary" $disable>Cleaned</button>
                                    </div>
                                </td>
                                $bind_func
                            </tr>
                            
                        EOF;

                    }

                    ?>


                    </tbody>
                </table>
                <!-- End Default Table Example -->
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
    function update_clean(room_no){
        $.ajax({
            url: 'index.php?update_clean',
            type : "POST",
            dataType : 'json',
            data : {
                room_no: room_no
            },
            success: function(results) {
                console.log(results);
                if (results.status === 1){
                    window.location.replace("index.php?clean_status");
                }
                else{
                    alert("Please check your Internet Connection.")
                }
            },
            error: function() {
                alert("Oops! Request failed! Please check your Internet Connection.");
            }
        });
        return false;
    }
</script>

</body>

</html>
