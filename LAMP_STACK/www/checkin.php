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

    <title>Reservation Check in - COMP3335 Hotel</title>
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

<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php?home" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Front Desk System</span>
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
            <a class="nav-link collapsed" href="index.php?home">
                <i class="bi bi-receipt"></i>
                <span>Room Occupancy</span>
            </a>
        </li><!-- End Room Cleaning Status Nav -->

        <li class="nav-item">
            <a class="nav-link " href="index.php?checkin">
                <i class="bi bi-house"></i>
                <span>Check-In</span>
            </a>
        </li><!-- End Room Cleaning Status Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?checkout">
                <i class="bi bi-house"></i>
                <span>Check-Out</span>
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
        <h1>Reservations</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Reservations</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="row mb-3">

            <div class="col text-center">
                <button class="btn btn-primary" onclick="qrcode_scan()">Scan QRCode</button>
            </div>
            <div class="col row">
                <label for="search_id" class="col-3 col-form-label">Reservation ID:</label>
                <div class="col-6">
                    <input type="text" class="form-control" id="search_id">
                </div>
                <div class="col-3 text-center">
                    <button type="submit" class="btn btn-primary" onclick="search()" >Search</button>
                </div>
            </div>


        </div>


        <?php
        include_once "./lib/config.php";
        include_once "./lib/toolfuctions.php";
        $config_ = get_config();
        $user_info = get_user_info();

        error_reporting(0);
        mysqli_report(MYSQLI_REPORT_OFF);
        $conn = mysqli_connect($config_['mysql_info']['host'], $user_info['user'],
            $user_info['pass'], $config_['mysql_info']['database']);

        $sql = "SELECT `RES_ID`, `CUS_ID`, `CHECKIN_DATE`, `DURATION`, `ROOM_TYPE`, `AMT` 
                FROM `RESERVATION` WHERE `CANCELLED`=false AND `IS_ORDER`=false
                AND TO_DAYS(now()) - `CHECKIN_DATE` <= 0;";
        $result = mysqli_query($conn, $sql);
        $reservations = [];
        $counter = 0;
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $reservations[$counter++] = $row;
            }
        }


        usort($room_status, function($a, $b){
            return intval(substr($a['RES_ID'], 0, 14)) > intval(substr($b['RES_ID'], 0, 14)) ? 1:-1;
        });

        $conn_computer = mysqli_connect($config_['mysql_info']['host'], $config_['mysql_info']['computer_user'],
            $config_['mysql_info']['computer_pass'], $config_['mysql_info']['database']);

        foreach ($reservations as $reservation){
            $res_id = $reservation['RES_ID'];
            $cus_id = $reservation['CUS_ID'];
            $checkin = $reservation['CHECKIN_DATE'];
            $duration = $reservation['DURATION'];
            $room_type = $reservation['ROOM_TYPE'];
            $amt = $reservation['AMT'];

            $sql = "SELECT * FROM `TRAVEL_PARTNER_INORDER` 
            WHERE RES_ID='".mysqli_real_escape_string($conn, $res_id)."';";

            $result = mysqli_query($conn_computer, $sql);
            $cus_num = mysqli_num_rows($result);

            $sql = "SELECT `ROOM_NO` FROM `ROOM` WHERE `ROOM_TYPE`='".mysqli_real_escape_string($conn, $room_type)."' 
                    AND `OCCUPIED`=false AND `IS_CLEAN`=true;";
            $room_list = [];
            $counter1 = 0;
            $result = mysqli_query($conn, $sql);
            if (!$result || !mysqli_num_rows($result)>0)
                continue;
            while ($row = mysqli_fetch_assoc($result)['ROOM_NO'])
                $room_list[$counter1++] = $row;

            echo <<< EOF
             <div class="card">
                <div class="card-body pt-3" id="$res_id">
                <form class="row">
                    <div class="col-lg-6 profile-edit profile-overview pt-3">
                        <!-- General Form Elements -->
                        <div class="row">
                            <div class="col-lg-4 col-md-4 label ">Reservation ID</div>
                            <div class="col-lg-6 col-md-8">$res_id</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 label ">Customer Username</div>
                            <div class="col-lg-6 col-md-8">$cus_id</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 label ">Room Type</div>
                            <div class="col-lg-6 col-md-8">$room_type</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 label ">Check-In date</div>
                            <div class="col-lg-6 col-md-8">$checkin</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 label">Duration</div>
                            <div class="col-lg-6 col-md-8">$duration days</div>
                        </div>
                    </div>

                    <div class="col-lg-6 profile-edit profile-overview pt-3">

                        <div class="row">
                            <div class="col-lg-4 col-md-4 label">Amount</div>
                            <div class="col-lg-6 col-md-8">$amt</div>
                        </div>
                        
                        <div class="row" id="insert$res_id">
                            <div class="col-lg-4 col-md-4 label">Guest Number</div>
                            <div class="col-lg-6 col-md-8">$cus_num</div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Select Room</label>
                            <div class="col-sm-8">
                                <select id="select$res_id" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Select a available room</option>
                                    
            EOF;

            $counter2 = 0;
            while($room_list[$counter2]){
                echo "<option value=\"$room_list[$counter2]\">$room_list[$counter2]</option>";
                $counter2++;
            }

            echo <<< EOF
                                    
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button class="btn btn-primary" id="confirm_btn$res_id" type="submit">Confirm</button>
                            </div>
                        </div>
                        <script>
                            document.getElementById("confirm_btn$res_id").onclick = function(){
                                let room_no = document.getElementById("select$res_id").value;
                                
                                if (!room_no){
                                    customAlert("Please select a room", "insert$res_id");
                                }
                                let json_data = '{' +
                                    '"res_id" : "$res_id",' +
                                    '"room_no" : "' + room_no + '"' +
                                '}';
                                return update_checkin(JSON.parse(json_data), "insert$res_id");
                            }
                        
                        </script>

                    </div>
                </form>
            </div>
            </div>
            EOF;

        }

        mysqli_close($conn);
        mysqli_close($conn_computer);
        ?>


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
    function qrcode_scan() {
        let name=prompt("Since time is  limited, we just do a demo here. You still need to enter the reservation ID:","");
        jump_to(name);
    }

    function search(){
        let name = document.getElementById("search_id").value;
        if (name!=="")
            jump_to(name)
        document.getElementById("search_id").value = "";
    }

    function jump_to(element_id){
        let element = document.getElementById(element_id);
        if (element) {
            element.scrollIntoView(true);
        }
        else {
            alert("The reservation "+ element_id + " doesn't exits.");
        }
    }

    function update_checkin(json_data, alert_id){
        alert("In the real scenarios, the front-desk should scan the ID card of the customer to ensure the identity, here we skip this step.");
        $.ajax({
            url: 'index.php?update_checkin',
            type : "POST",
            dataType : 'json',
            data : json_data,
            success: function(results) {
                console.log(results);
                if (results.status === 1){
                    customAlert("Profile updated successfully!", alert_id);
                    window.location.replace("index.php?checkin");
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

