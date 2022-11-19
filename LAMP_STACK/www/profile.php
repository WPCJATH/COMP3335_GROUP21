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
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?php $user?></span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php $user?></h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
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

                        </ul>
                        <div class="tab-content pt-2">

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
                                    </div>
                                    <div class="invalid-feedback">Please choose a gender.</div>
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
                                    <button type="submit" class="btn btn-primary needs_validation_" onclick="func(event)">Upload</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>

            </div>

            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile Details</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview">
                                <br>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">Ying Xu</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8">Female</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Age</div>
                                    <div class="col-lg-9 col-md-8">21</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">ID number</div>
                                    <div class="col-lg-9 col-md-8">12345</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">xy@123.com</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">1234 5678</div>
                                </div>
                                <br><br>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="Email1" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email1" value="">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone1" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone1" value="">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

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
    function func(event){
        event.preventDefault();
        event.stopPropagation();

        var form = document.getElementById('add-new-form');
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
</script>

</body>

</html>
