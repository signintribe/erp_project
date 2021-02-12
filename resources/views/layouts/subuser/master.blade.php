<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>APP - @yield('title')</title>

        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('public/dashboard/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/vendors/css/vendor.bundle.base.css')}}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/vendors/css/vendor.bundle.addons.css')}}">
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('public/dashboard/vendors/iconfonts/font-awesome/css/font-awesome.min.css')}}">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/vertical-layout-light/style.css')}}">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{ asset('public/dashboard/images/favicon.png')}}" />
        <!-- Sweet Alert -->
        <link href="{{ asset('public/css/sweetalert.css')}}" rel="stylesheet">
    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
                    <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
                        <li class="nav-item nav-toggler-item">
                            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
                                <span class="mdi mdi-menu"></span>
                            </button>
                        </li>
                        <li class="nav-item nav-search d-none d-lg-flex">
                            
                        </li>
                    </ul>
                    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo companyname" href="{{ url('home')}}"></a>
                        <a class="navbar-brand brand-logo-mini companyname" href="{{ url('home')}}">ERP APP</a>
                    </div>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline mx-0"></i>
                                <span class="count"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                <a class="dropdown-item">
                                    <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                                    </p>
                                    <span class="badge badge-pill badge-warning float-right">View all</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-success">
                                            <i class="mdi mdi-information mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-medium">Application Error</h6>
                                        <p class="font-weight-light small-text mb-0">
                                            Just now
                                        </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-settings mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-medium">Settings</h6>
                                        <p class="font-weight-light small-text mb-0">
                                            Private message
                                        </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-info">
                                            <i class="mdi mdi-account-box mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-medium">New user registration</h6>
                                        <p class="font-weight-light small-text mb-0">
                                            2 days ago
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                <img id="profile_pic" alt="profile"/>
                                <span class="nav-profile-name"><?php echo Auth::user()->name; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item">
                                    <i class="mdi mdi-settings text-primary"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout text-primary"></i>
                                    {{ __('Logout')}}
                                </a>
                                <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                @include('layouts.subuser.sidemenu')
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y'); ?> <a href="https://www.app.com/" target="_blank">APP</a>. All rights reserved.</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Signin Tribe <i class="mdi mdi-heart text-danger"></i></span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
        </div>
        <!-- endinject -->
        <!-- End custom js for this page-->

        <script src="{{ asset('public/dashboard/vendors/js/vendor.bundle.base.js')}}"></script>
        <script src="{{ asset('public/dashboard/vendors/js/vendor.bundle.addons.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{ asset('public/dashboard/js/off-canvas.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/hoverable-collapse.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/template.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/settings.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/todolist.js')}}"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="{{ asset('public/dashboard/js/modal-demo.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/formpickers.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/form-addons.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/x-editable.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/dropify.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/dropzone.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/jquery-file-upload.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/formpickers.js')}}"></script>
        <script src="{{ asset('public/dashboard/js/form-repeater.js')}}"></script>
        <script src="{{ asset('public/js/sweetalert.min.js')}}">
        </script>
        <script>
            $(function () {
                $.ajax({
                    type: 'GET',
                    url: 'getcompanyinfo',
                    contentType: 'json',
                    beforeSend: function () {
                        $("#status_personal").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
                    },
                    success: function (data) {
                        if (data) {
                            $(".companyname").html(data.company_name);
                            $("#profile_pic").attr('src', 'public/company_logs/' + data.company_logo);
                        } else {
                            $("#profile_pic").hide();
                            $(".companyname").html("Profile is not added");
                        }
                    }
                });
            });
        </script>
        <!-- End custom js for this page-->
    </body>
</html>