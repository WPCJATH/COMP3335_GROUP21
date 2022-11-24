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
            <span class="d-none d-lg-block">Manager System</span>
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
            <a class="nav-link collapsed" href="index.php?order">
                <i class="bi bi-house"></i>
                <span>Reservations</span>
            </a>
        </li><!-- End Room Cleaning Status Nav -->

        <li class="nav-item">
            <a class="nav-link " href="index.php?profile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Staff Profile Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?home">Home</a></li>
                <li class="breadcrumb-item active">Staff Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">

            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Create New Staff Profile</button>
                            </li>
                            <li class="nav-item"></li>
                        </ul>
                        <div class="tab-content pt-2">
                            <br>
                            <!-- Profile Edit Form -->
                            <form id="add-new-form" class="needs-validation" novalidate>

                                <div class="row mb-3">
                                    <label for="name_new" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="text" class="form-control" id="name_new" required>
                                        <div class="invalid-feedback">Please enter the staff name.</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="position_new" class="col-md-4 col-lg-3 col-form-label">Position</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select id="position_new" class="form-select" required aria-label="select example">
                                            <option value="">--select position--</option>
                                            <option value="CL">Cleaner</option>
                                            <option value="FD">Front-Desk</option>
                                            <option value="MA">Manager</option>
                                        </select>
                                        <div class="invalid-feedback">Please choose a position.</div>
                                    </div>
                                </div>

                                <div class="row mb-3 invisible" id="floor_input">
                                    <label for="floor_new" class="col-md-4 col-lg-3 col-form-label">Response Floor</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="number" class="form-control" id="floor_new" min="1" max="8">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="pass_new" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="text" class="form-control" id="pass_new" required>
                                        <div class="invalid-feedback">Please enter the staff name.</div>
                                    </div>
                                </div>

                                <div class="row mb-3" id="insert"></div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary needs_validation_" onclick="upload_new_profile(event)">Create</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>

            </div>

            <?php
            include_once "./lib/config.php";
            include_once "./lib/toolfuctions.php";
            $config_ = get_config();
            $user_info = get_user_info();

            # error_reporting(0);
            # mysqli_report(MYSQLI_REPORT_OFF);
            $conn = mysqli_connect($config_['mysql_info']['host'], $user_info['user'],
                $user_info['pass'], $config_['mysql_info']['database']);

            $sql = "SELECT * FROM `STAFF`;";
            $result = mysqli_query($conn, $sql);
            $count1 = 0;
            $staff_profiles = [];
            if ($result && mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    $staff_profiles[$count1++] = $row;
                }
            }
            mysqli_close($conn);

            $count=0;
            while (isset($staff_profiles[$count]) && $user_profile = $staff_profiles[$count]){
                $count++;
                $staff_id = $user_profile['STAFF_ID'];
                $position = $user_profile['POSITION'];
                $floor = $user_profile['RESPONSIBLE_FLOOR'];
                $floor_ = (!$floor || $floor==-1)? "N/A": $floor;

                $select = '
                                                    <option '.($position==='CL'? "selected": "").' value="CL">Cleaner</option>
                                                    <option '.($position==='FD'? "selected": "").' value="FD">Front-Desk</option>
                                                    <option '.($position==='MA'? "selected": "").' value="MA">Manager</option>
';
                $invisible = ($position==='CL')? "":"invisible";

                $position = ($position==="CL")? "Cleaner": $position;
                $position = ($position==="FD")? "Front-Desk": $position;
                $position = ($position==="MA")? "Manager": $position;

                $disable = ($user===$staff_id)? "Disabled": "";

                echo <<< EOF
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview$count">Profile Details</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit$count">Edit Profile</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview$count">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Staff Name</div>
                                        <div class="col-lg-9 col-md-8">$staff_id</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Position</div>
                                        <div class="col-lg-9 col-md-8">$position</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Response Floor</div>
                                        <div class="col-lg-9 col-md-8">$floor_</div>
                                    </div>

                                    <br><br>
                                    <div class="text-center">
                                        <button id="delete_btn$count" class="btn btn-outline-danger" $disable>Delete</button>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit$count">

                                    <!-- Profile Edit Form -->
                                    <form id="update_form$count">

                                        <div class="row mb-3">
                                            <label for="name_new" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control" id="name_new" value="$staff_id" disabled>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="position_update$count" class="col-md-4 col-lg-3 col-form-label">Position</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select id="position_update$count" class="form-select" required aria-label="select example" $disable>
                                                      $select
                                                </select>
                                            </div>
                                            <div class="invalid-feedback">Please choose a position.</div>
                                        </div>

                                        <div class="row mb-3 $invisible" id="floor_input$count">
                                            <label for="floor_update$count" class="col-md-4 col-lg-3 col-form-label">Floor</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="number" class="form-control" id="floor_update$count" min="1" max="8" value="$floor" $disable>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3" id="insert_view_$count"></div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary needs_validation_" id="upload_btn$count" $disable>Update</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
                <script>
                
                    document.getElementById("position_update$count").onchange = function (){
                        selector_onchange(document.getElementById("position_update$count"), document.getElementById("floor_update$count"), document.getElementById("floor_input$count"));
                    }
                
                    document.querySelector("#upload_btn$count").onclick = function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        
                        let position = document.getElementById("position_update$count").value;
                        let floor;
                        if (position!=="CL")
                            floor = -1;
                        else
                            floor = document.getElementById("floor_update$count").value;
                         
                        let json_data = '{' +
                                    '"staff_name" : "$staff_id",' +
                                    '"position" : "' + position + '",' +
                                    '"floor" : "' + floor + '"' +
                                '}';
                        console.log(json_data);
                        return update_profile(JSON.parse(json_data), "insert_view_$count");
                    }
                    
                    document.querySelector("#delete_btn$count").onclick = function(){
                       delete_profile("$staff_id", "insert_view_$count");
                    }
                </script>
                
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
<script src="assets/js/tool_functions.js"></script>
<script src="assets/jquery/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById("position_new").onchange = function (){
        selector_onchange(document.getElementById("position_new"), document.getElementById("floor_new"), document.getElementById("floor_input"));
    }

    function selector_onchange(selector, floor_input, floor_div){
        if (selector.value==="CL") {
            floor_input.value = "";
            floor_div.classList.remove("invisible");
        }
        else {
            floor_div.classList.add("invisible");
            floor_input.value = -1;
        }
    }

    function upload_new_profile(event){
        event.preventDefault();
        event.stopPropagation();

        let staff_name = document.getElementById("name_new").value;
        let position = document.getElementById("position_new").value;
        let pass = document.getElementById("pass_new").value;
        let floor;

        if (position!=="CL")
            floor = -1;
        else
            floor = document.getElementById("floor_new").value;

        $.ajax({
            url: 'index.php?new_profile',
            type : "POST",
            dataType : 'json',
            data : {
                staff_name: staff_name,
                position: position,
                floor: floor,
                pass: pass
            },
            success: function(results) {
                console.log(results);
                if (results.status === 1){
                    customAlert("New staff created successfully!");
                    window.location.replace("index.php?profile");
                }
                else{
                    customAlert(results.msg);
                }
            },
            error: function() {
                customAlert("Oops! Request failed! Please check your Internet Connection.");
            }
        });
        return false;
    }

    function update_profile(json_data, alert_id){
        $.ajax({
            url: 'index.php?new_profile',
            type : "POST",
            dataType : 'json',
            data : json_data,
            success: function(results) {
                console.log(results);
                if (results.status === 1){
                    customAlert("Profile updated successfully!", alert_id);
                    window.location.replace("index.php?profile");
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

    function delete_profile(staff_name, alert_id){
        $.ajax({
            url: 'index.php?del_staff',
            type : "POST",
            dataType : 'json',
            data : {
                staff_name : staff_name
            },
            success: function(results) {
                console.log(results);
                if (results.status === 1){
                    window.location.replace("index.php?profile");
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
