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

    <title>User Profile - COMP3335 Hotel</title>
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
        </li><!-- End Accommodation Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?order">
                <i class="bi bi-receipt"></i>
                <span>Order</span>
            </a>
        </li><!-- End Order Page Nav -->

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?home">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
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
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Add New Profile</button>
                            </li>
                            <li class="nav-item"></li>
                        </ul>
                        <div class="tab-content pt-2">
                            <br>
                            <!-- Profile Edit Form -->
                            <form id="add-new-form" class="needs-validation" novalidate>

                                <div class="row mb-3">
                                    <label for="name_new" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="text" class="form-control" id="name_new" required>
                                        <div class="invalid-feedback">Please enter full name.</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="gender_new" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select id="gender_new" class="form-select" required aria-label="select example">
                                            <option value="">--select gender--</option>
                                            <option value="0">Female</option>
                                            <option value="1">Male</option>
                                        </select>
                                        <div class="invalid-feedback">Please choose a gender.</div>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="age_new" class="col-md-4 col-lg-3 col-form-label">Age</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="number" class="form-control" id="age_new" min="0" required>
                                        <div class="invalid-feedback">Please enter the name.</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="id_new" class="col-md-4 col-lg-3 col-form-label">ID Number</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="text" class="form-control" id="id_new"  required>
                                        <div class="invalid-feedback">Please enter the ID number.</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email_new" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="email" class="form-control" id="email_new"  required>
                                        <div class="invalid-feedback">Please enter the email.</div>
                                    </div>
                                </div>

                                <div class="row mb-3" id="insert">
                                    <label for="phone_new" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="text" class="form-control" id="phone_new"  required>
                                        <div class="invalid-feedback">Please enter the phone number.</div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary needs_validation_" onclick="upload_new_profile(event)">Upload</button>
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

            error_reporting(0);
            mysqli_report(MYSQLI_REPORT_OFF);
            $conn = mysqli_connect($config_['mysql_info']['host'], $user_info['user'],
                $user_info['pass'], $config_['mysql_info']['database']);

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

            $count=0;
            while (isset($user_profiles[$count]) && $user_profile = $user_profiles[$count]){
                $count++;
                $cus_id = $user_profile['CUS_ID'];
                $cus_name = $user_profile['NAME'];
                $gender = $user_profile['GENDER'];
                $age = $user_profile['AGE'];
                $id_no = $user_profile['ID_NO'];
                $email = $user_profile['EMAIL'];
                $phone = $user_profile['PHONE_NO'];

                $select = '
                                                    <option '.($gender===''? "selected": "").' value="">--select gender--</option>
                                                    <option '.($gender==='Female'? "selected": "").' value="0">Female</option>
                                                    <option '.($gender==='Male'? "selected": "").' value="1">Male</option>
';

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
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">$cus_name</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Gender</div>
                                        <div class="col-lg-9 col-md-8">$gender</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Age</div>
                                        <div class="col-lg-9 col-md-8">$age</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">ID number</div>
                                        <div class="col-lg-9 col-md-8">$id_no</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">$email</div>
                                    </div>

                                    <div class="row" id="insert_view_$count">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">$phone</div>
                                    </div>
                                    <br><br>
                                    <div class="text-center">
                                        <button id="delete_btn$count" class="btn btn-outline-danger">Delete</button>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit$count">

                                    <!-- Profile Edit Form -->
                                    <form id="update_form$count">

                                        <div class="row mb-3">
                                            <label for="name_update$count" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control" id="name_update$count" value="$cus_name" required>
                                                <div class="invalid-feedback">Please enter full name.</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="gender_update$count" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select id="gender_update$count" class="form-select" required aria-label="select example">
                                                      $select
                                                </select>
                                                <div class="invalid-feedback">Please choose a gender.</div>
                                            </div>
                                            
                                        </div>

                                        <div class="row mb-3">
                                            <label for="age_update$count" class="col-md-4 col-lg-3 col-form-label">Age</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="number" class="form-control" id="age_update$count" min="0" value="$age" required>
                                                <div class="invalid-feedback">Please enter the age.</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="id_update$count" class="col-md-4 col-lg-3 col-form-label">ID Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control" id="id_update$count" value="$id_no" required>
                                                <div class="invalid-feedback">Please enter the ID number.</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email_update$count" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="email" class="form-control" id="email_update$count" value="$email" required>
                                                <div class="invalid-feedback">Please enter the email.</div>
                                            </div>
                                        </div>

                                        <div class="row mb-3" id="insert$count">
                                            <label for="phone_update$count" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control" id="phone_update$count" value="$phone"  required>
                                                <div class="invalid-feedback">Please enter the phone number.</div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary needs_validation_" id="upload_btn$count">Upload</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
                <script>
                
                    document.querySelector("#upload_btn$count").onclick = function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                
                        let form = document.getElementById('update_form$count');
                        if (!form.checkValidity()){
                            form.classList.add('was-validated');
                            return false;
                        }
                        
                        let full_name = document.getElementById("name_update$count").value;
                        let gender = document.getElementById("gender_update$count").value;
                        let age = document.getElementById("age_update$count").value;
                        let id = document.getElementById("id_update$count").value;
                        let phone = document.getElementById("phone_update$count").value;
                        let email = document.getElementById("email_update$count").value;
                        
                        let json_data = '{' +
                                    '"cus_id" : "$cus_id",' +
                                    '"full_name" : "' + full_name + '",' +
                                    '"gender" : "' + gender + '",' +
                                    '"age" : "' + age + '",' +
                                    '"id" : "' + id + '",' +
                                    '"phone" : "' + phone + '",' +
                                    '"email" : "' + email + '"' +
                                '}';
                        console.log(json_data);
                        return update_profile(JSON.parse(json_data), "insert$count");
                    }
                    
                    document.querySelector("#delete_btn$count").onclick = function(){
                       delete_profile("$cus_id", "insert_view_$count");
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
    function upload_new_profile(event){
        event.preventDefault();
        event.stopPropagation();

        let form = document.getElementById('add-new-form');
        if (!form.checkValidity()){
            form.classList.add('was-validated');
            return false;
        }

        let full_name = document.getElementById("name_new").value;
        let gender = document.getElementById("gender_new").value;
        let age = document.getElementById("age_new").value;
        let id = document.getElementById("id_new").value;
        let phone = document.getElementById("phone_new").value;
        let email = document.getElementById("email_new").value;

        $.ajax({
            url: 'index.php?new_profile',
            type : "POST",
            dataType : 'json',
            data : {
                full_name: full_name,
                gender: gender,
                age: age,
                id: id,
                phone: phone,
                email: email
            },
            success: function(results) {
                console.log(results);
                if (results.status === 1){
                    customAlert("New profile updated successfully!");
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

    function delete_profile(cus_id, alert_id){
        $.ajax({
            url: 'index.php?delete_profile',
            type : "POST",
            dataType : 'json',
            data : {
                cus_id : cus_id
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
