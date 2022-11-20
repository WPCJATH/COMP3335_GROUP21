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
    <!-- Template Main JS File -->
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
    <script>
        function toDateInputValue(recorded_date){
            let local = new Date();
            if (recorded_date!==""){
                let recorded = new Date(recorded_date);
                if (local <= recorded)
                    local = recorded;
            }
            return local.toJSON().slice(0,10);
        }

        function date_onchange(element){
            let date = new Date(element.value);
            if (date < new Date()){
                element.classList.add("is-invalid");
                return false;
            }
            else{
                element.classList.remove("is-invalid");
            }
            return true;
        }

        function check_box_check(limit, name){
            let checkboxes = document.getElementsByName(name);
            let cur = 0;
            checkboxes.forEach(function (item){
                if (item.checked){
                    cur++;
                    if (cur > limit){
                        item.checked = false;
                        cur--;
                    }
                }
            })
            if (cur >= limit){
                checkboxes.forEach(function (item){
                    if (!item.checked){
                        item.disabled = true;
                    }
                })
            }
            else{
                checkboxes.forEach(function (item){
                    if (item.disabled){
                        item.disabled = false;
                    }
                })
            }
        }

        function get_selected_members(name){
            let checkboxes = document.getElementsByName(name);
            let checked = [];
            checkboxes.forEach(function (item){
                if (item.checked){
                    checked.push(item.value);
                }
            })
            return checked;
        }

    </script>

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
            <a class="nav-link " href="#">
                <i class="bi bi-house"></i>
                <span>Accommodation</span>
            </a>
        </li><!-- End Accommodation Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?order">
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
            include_once "./lib/config.php";
            include_once "./lib/toolfuctions.php";
            $config_ = get_config();
            $user_info = get_user_info();

            error_reporting(0);
            mysqli_report(MYSQLI_REPORT_OFF);
            $conn = mysqli_connect($config_['mysql_info']['host'], $user_info['user'],
                $user_info['pass'], $config_['mysql_info']['database']);

            // Get the room type information
            $sql = "select * from `ROOM_TYPE`;";
            $result = mysqli_query($conn, $sql);
            $count = 0;
            if(!$result){
                header("Location: index.php?404_page_not_found");
                exit;
            }
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    $room_info[$count++] = $row;
                }
            }

            // Get the profile information related to the user
            $sql = "SELECT * FROM `CUSTOMER` WHERE `CUS_ID`='".mysqli_real_escape_string($conn, $user_info['user'])."';";
            $result = mysqli_query($conn, $sql);
            $count1 = 0;
            $user_profiles = [];
            if ($result && mysqli_num_rows($result) > 0)
                $user_profiles[$count1++] = mysqli_fetch_assoc($result);

            foreach ($user_profiles[0] as $key => $value){
                if ($user_profiles[0][$key]===NULL){
                    $user_profiles = [];
                    $count1=0;
                    break;
                }
            }


            $sql = "SELECT `PARTNER_ID` FROM `TRAVEL_PARTNER` 
                    WHERE `HOLDER`='".mysqli_real_escape_string($conn, $user_info['user'])."';";
            $result = mysqli_query($conn, $sql);
            $count2 = 0;
            $partner_ids = [];
            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    $partner_ids[$count2++] = $row['PARTNER_ID'];
                }
            }

            foreach ($partner_ids as $partner_id){
                $sql = "SELECT * FROM `CUSTOMER` WHERE `CUS_ID`='".mysqli_real_escape_string($conn, $partner_id)."';";
                $result = mysqli_query($conn, $sql);
                if(!$result || !mysqli_num_rows($result) > 0){
                    continue;
                }
                $user_profiles[$count1++] = mysqli_fetch_assoc($result);
            }



            mysqli_close($conn);

            usort($room_info, function($a, $b){
                return $a['PRICE'] > $b['PRICE'] ? 1:-1;
            });

            $count = 0;
            while (isset($room_info[$count]) && $room = $room_info[$count]){
                $count++;
                $id = $room['TYPE'];
                $price = $room['PRICE'];
                $pic_dir = $room['IMAGE_DIR'];
                $capacity = $room['CAPACITY'];
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
                                        <form id="reservation-form$count" class="needs-validation" novalidate>
                                            <div class="row mb-3">
                                                <label for="inputDate$count" class="col-sm-2 col-form-label">Check In</label>
                                                <div class="col-sm-10">
                                                    <input id="inputDate$count" type="date" class="form-control" " required>
                                                    <div class="invalid-feedback">You must input date on or after today.</div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="duration" class="col-sm-2 col-form-label" >Occupancy Days</label>
                                                <div class="col-sm-10">
                                                    <input id="duration$count" type="number" class="form-control" min="1" max="20" value="1" required>
                                                    <div class="invalid-feedback">You must set a stay duration.</div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Guest Number</label>
                                                <div class="col-sm-10">
                                                    <select id="member_num$count" class="form-select" aria-label="Default select example" required>
                    EOF;

                echo "<option selected value=$capacity>$capacity</option>";
                for ($i=$capacity-1; $i>0;$i--)
                    echo "<option value=$i>$i</option>";

                echo <<< EOF
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row mb-3" id="insert$count">
                                              <label class="col-sm-2 col-form-label">Guest Members:</label>
                                              <div class="row col-sm-8" id="checkbox$count">
                     EOF;

                $count_ = 0;
                foreach ($user_profiles as $profile){
                    $cus_id = $profile['CUS_ID'];
                    $cus_name = $profile['NAME'];
                    $id_no = $profile['ID_NO'];
                    echo <<< EOF
                        <div class="form-check col-sm-5">
                            <input class="form-check-input" value="$cus_id" name="members$count" type="checkbox"  id="customer-$count-$count_">
                            <label class="form-check-label" for="customer-$count-$count_">$cus_name $id_no</label>
                        </div>
                    EOF;
                    $count_++;
                }


                echo <<< EOF
                                              </div>
                                              <div class="form-check col-sm-2">
                                                   <a class="fs-6 btn btn-info" href="index.php?profile">Add New</a>
                                              </div>
                                              
                                            </div>
                                            <br>
                                            
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"> </label>
                                                <div class="col-sm-10">
                                                    <a  id="submit_btn$count" class="btn btn-primary needs_validation_" type="submit">Register</a>
                                                </div>
                                            </div>
                                        </form><!-- End General Form Elements -->
                                    </div>
                                </div>
                            </div>
                            <script>
                                if (localStorage.getItem("inputDate$count"))
                                     document.getElementById("inputDate$count").value= toDateInputValue(localStorage.getItem("inputDate$count"));
                                else
                                    document.getElementById("inputDate$count").value= toDateInputValue("");
                                
                                document.getElementById("inputDate$count").onchange = function (){
                                    if (date_onchange(document.getElementById("inputDate$count")))
                                        localStorage.setItem("inputDate$count", document.getElementById("inputDate$count").value);
                                }

                                if (localStorage.getItem("duration$count"))
                                    document.getElementById("duration$count").value = localStorage.getItem("duration$count");
                                
                                document.getElementById("duration$count").onchange = function(){
                                    localStorage.setItem("duration$count", document.getElementById("duration$count").value);
                                } 

                                
                                document.getElementsByName("members$count").forEach(function (element){
                                    element.onclick = function (){
                                        check_box_check(parseInt(document.getElementById("member_num$count").value), "members$count");
                                    }
                                })
                                
                                document.getElementById("member_num$count").onchange = function(){
                                    check_box_check(parseInt(document.getElementById("member_num$count").value), "members$count");
                                }
                                
                                document.getElementById("submit_btn$count").onclick = function (){
                                    let check_in = document.getElementById("inputDate$count").value;
                                    let duration = document.getElementById("duration$count").value;
                                    let member_num = document.getElementById("member_num$count").value;
                                    let members = get_selected_members("members$count");
                                    
                                    if (parseInt(member_num)!==members.length){
                                        customAlert("The guest number and selected guests are not match!", "insert$count");
                                        return false;
                                    }
                                    
                                    let json_data = '{' +
                                    '"room_type" : "$id",' +
                                    '"check_in" : "' + check_in + '",' +
                                    '"duration" : "' + duration + '",' +
                                    '"members" : ["' + members.join('","') + '"]' +
                                    '}';
                                    console.log(json_data);
                                    return make_reservation(JSON.parse(json_data), "insert$count");
                                }
                                
                            </script>
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

<script src="assets/jquery/jquery-3.6.0.min.js"></script>
<script>
    function make_reservation(json_data, alert_id){
        $.ajax({
            url: 'index.php?new_reservation',
            type : "POST",
            dataType : 'json',
            data : json_data,
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