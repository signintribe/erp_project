<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>APP - @yield('title')</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('public/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- daterange picker -->
        <link rel="stylesheet" href="{{asset('public/plugins/daterangepicker/daterangepicker.css')}}">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="{{asset('public/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{asset('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('public/plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="{{asset('public/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
        <!-- BS Stepper -->
        <link rel="stylesheet" href="{{asset('public/plugins/bs-stepper/css/bs-stepper.min.css')}}">
        <!-- dropzonejs -->
        <link rel="stylesheet" href="{{asset('public/plugins/dropzone/min/dropzone.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('public/dist/css/adminlte.min.css')}}">
        <!-- Sweet Alert -->
        <link href="{{ asset('public/css/sweetalert.css')}}" rel="stylesheet">
        <style>
            .nav-sidebar a{
                font-size: 14px;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{url('creation-tier')}}" class="nav-link">Creation Tier</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{url('task-tier')}}" class="nav-link active">Task Tier</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{url('report-tier')}}" class="nav-link">Report Tier</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{url('user-auth-tier')}}" class="nav-link">User Auth Tier</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">My Profile</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout text-primary"></i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img src="{{asset('public/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">ERP</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{asset('public/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?php echo Auth::user()->name ?></a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="{{url('adminhome')}}" class="nav-link">
                                <i class="nav-icon fa fa-tachometer-alt" aria-hidden="true"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-industry"></i>
                                    <p>
                                        Company
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>
                                        Human Resource
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Recrutments</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Apply Leaves</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Pay Roll</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Promotions</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Training</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Trmination</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Requestion</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-university nav-icon"></i>
                                    <p>
                                        Banking & Finance
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Bank Detail</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Bank Recancelation</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('Add-general-Journal-Entry')}}" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Journal Genral</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Budet</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Taxes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Treiff</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Demand of Funds</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Release of Funds</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Audit</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>IOT</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Receiveable</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Payable</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Asset Management</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Bank 2 Bank Transfer</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Requestion</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-cube nav-icon"></i>
                                    <p>
                                        Matrial Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Store Requestion</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Metrial Issue</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Metrial Return</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-calendar nav-icon"></i>
                                    <p>
                                        Project System
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Projects</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Activities</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Phases</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Task</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Requestion</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-bus nav-icon"></i>
                                    <p>
                                        Scourcing
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Quotation</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Requestion</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Tender</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Logistics</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-chart-line nav-icon"></i>
                                    <p>
                                        Purchases
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Quotation</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Purchase Order</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Receive Inventory</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Invoice</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Payment</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Requestion</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-chart-pie nav-icon"></i>
                                    <p>
                                        Sales
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Quotation</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Sales Order</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Despatch Inventory</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Invoice</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Receipts</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Requestion</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">@yield('pagetitle')</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{url('adminhome')}}">Home</a></li>
                                    <li class="breadcrumb-item active">@yield('breadcrumb')</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="{{asset('public/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- jQuery -->
        <!-- Select2 -->
        <script src="{{asset('public/plugins/select2/js/select2.full.min.js')}}"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="{{asset('public/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
        <!-- InputMask -->
        <script src="{{asset('public/plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('public/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
        <!-- date-range-picker -->
        <script src="{{asset('public/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- bootstrap color picker -->
        <script src="{{asset('public/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{asset('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
        <!-- Bootstrap Switch -->
        <script src="{{asset('public/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
        <!-- BS-Stepper -->
        <script src="{{asset('public/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
        <!-- dropzonejs -->
        <script src="{{asset('public/plugins/dropzone/min/dropzone.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('public/dist/js/demo.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('public/dist/js/adminlte.min.js')}}"></script>
        <script src="https://use.fontawesome.com/9eb69fc173.js"></script>
        <script src="{{ asset('public/js/sweetalert.min.js')}}"></script>
    </body>
</html>
