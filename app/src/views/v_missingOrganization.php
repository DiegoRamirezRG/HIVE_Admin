<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="src/public/theme/assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    
    <title>Missing organization</title>

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
<body style="overflow: hidden;">
    <div class="container-xxl py-3">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
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
                        <h4 class="mb-2">Let's work!</h4>
                        <p class="mb-2">We appreciate that you have registered, for the moment you have been registered without any organization</p>
                        <p class="mb-4">Let's create or join an organization to get started</p>

                        <div class="nav-align-top">
                            <ul class="nav nav-pills mb-3 d-flex justify-content-center gap-4" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">Create</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">Join</button>
                                </li>
                            </ul>
                            <div class="tab-content shadow-none p-0 mt-3">
                                <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                                    <form id="createAnOrganizationForm" class="mb-3">
                                        <div class="mb-5">
                                            <label for="org_name" class="form-label">Organization name</label>
                                            <input type="text" class="form-control" id="org_name" name="org_name" placeholder="Enter a organization name" />
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary d-grid w-100" type="submit">Create</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                                    <form id="joinAnOrganizationForm" class="mb-3">
                                        <div class="mb-5">
                                            <label for="org_code" class="form-label">Organization code</label>
                                            <input type="text" class="form-control" id="org_code" name="org_code" placeholder="Enter a organization code" />
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary d-grid w-100" type="submit">Join</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <script src="/src/assets/js/missing_org.js"></script>
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