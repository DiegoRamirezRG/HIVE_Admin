<?php
    if(isset($_SESSION['logged_user'])){
        header('Location: /');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="src/public/theme/assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    
    <title>HIVE - Register</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="src/assets/img/hive/favicon.svg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/src/public/theme/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/src/public/theme/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/src/public/theme/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/src/public/theme/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/src/public/theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/src/public/theme/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="/src/public/theme/assets/vendor/css/pages/page-auth.css" />
    <link href="/src/public/libraries/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="/src/assets/css/jquery-validator-custom.css" rel="stylesheet">
    <link href="/src/assets/css/preloader.css" rel="stylesheet">
    <link href="/src/assets/css/loading.css" rel="stylesheet">

    <!-- Helpers -->
    <script src="/src/public/theme/assets/vendor/js/helpers.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/src/public/theme/assets/js/config.js"></script>
</head>
<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="/src/assets/img/hive/favicon.svg" alt="" width="30">
                                </span>
                                <span class="app-brand-logo demo mt-1">
                                    <img src="/src/assets/img/hive/text-logo.svg" alt="" height="30">
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Adventure starts here 🚀</h4>
                        <p class="mb-4">Make your project management easy and fun!</p>

                        <form id="formSingUp" class="mb-3">
                            <div class="mb-3">
                                <label for="username" class="form-label">Name</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your name"/>
                            </div>
                            <div class="mb-3">
                                <label for="userlastname" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="userlastname" name="userlastname" placeholder="Enter your last name"/>
                            </div>
                            <div class="mb-3">
                                <label for="userextraname" class="form-label">Second last name (optional)</label>
                                <input type="text" class="form-control" id="userextraname" name="userextraname" placeholder="Enter your second last name"/>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="confirmPassword">Confirm password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="confirmPassword" class="form-control" name="confirmPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <button class="btn btn-primary d-grid w-100">Sign up</button>
                        </form>

                        <p class="text-center">
                            <span>Already have an account?</span>
                                <a href="/">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- /Preloader -->

    <!-- Loading -->
    <div class="loading" id="loading">
        <div class="loadingCard">
            <div class="spinner-border text-dark" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <span class="fs-3 text-dark">Loading...</span>
        </div>
    </div>
    <!-- /Loading -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/src/public/theme/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/src/public/theme/assets/vendor/libs/popper/popper.js"></script>
    <script src="/src/public/theme/assets/vendor/js/bootstrap.js"></script>
    <script src="/src/public/theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/src/public/theme/assets/vendor/js/menu.js"></script>

    <!-- Vendors JS -->
    <script src="/src/public/theme/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="/src/public/theme/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/src/public/theme/assets/js/dashboards-analytics.js"></script>
    <script src="/src/assets/js/register.js"></script>
    <script src="/src/public/libraries/jquery-validator/jquery.validate.min.js"></script>
    <script src="/src/public/libraries/jquery-cookie/jquery-cookie.js"></script>
    <script src="/src/public/libraries/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Preloader fade -->
    <script>
        $("#loading").hide();
        $(".preloader").fadeOut();
    </script>
</body>
</html>