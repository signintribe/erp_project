<!-- partial:partials/_settings-panel.html -->
<div class="theme-setting-wrapper d-print-none">
    <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
    <div id="theme-settings" class="settings-panel">
        <i class="settings-close mdi mdi-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
        <div class="sidebar-bg-options selected" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-primary border mr-3"></div>Dark</div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles danger"></div>
            <div class="tiles light default"></div>
            <div class="tiles dark"></div>
            <div class="tiles primary"></div>
        </div>
    </div>
</div>
<!-- partial -->
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas d-print-none" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('adminhome') }}">
                <i class="fa fa-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li> 
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Child-Companies" aria-expanded="false" aria-controls="Employee-Center">
                <i class="fa fa-building-o menu-icon"></i>
                <span class="menu-title">Company</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Child-Companies">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('company/company-profile')}}" class="nav-link">Maintain Company</a></li>
                    <li class="nav-item"> <a href="{{url('company/company-registration')}}" class="nav-link">Company Registration</a></li>
                    <li class="nav-item"> <a href="{{url('company/maintain-office')}}" class="nav-link">Maintain Office</a></li>
                    <li class="nav-item"> <a href="{{url('company/view-company')}}" class="nav-link">View Company</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item"> 
            <a href="{{url('company-departments')}}" class="nav-link">
                <i class="fa fa-bars menu-icon"></i>
                Departments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Employee-Center" aria-expanded="false" aria-controls="Employee-Center">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">HR</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Employee-Center">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('employee-personal-information')}}" class="nav-link">Employee Information </a></li>
                    <li class="nav-item"> <a href="{{url('employees-addresses')}}" class="nav-link">Employee Address</a></li>
                    <li class="nav-item"> <a href="{{url('spouse-detail')}}" class="nav-link">Spouse Detail</a></li>
                    <li class="nav-item"> <a href="{{url('education-detail')}}" class="nav-link">Education Detail</a></li>
                    <li class="nav-item"> <a href="{{url('certification-detail')}}" class="nav-link">Certification Detail</a></li>
                    <li class="nav-item"> <a href="{{url('experience-detail')}}" class="nav-link">Experience Detail</a></li>
                    <li class="nav-item"> <a href="{{url('organizational-assignment')}}" class="nav-link">Organizational Assignment</a></li>
                    <li class="nav-item"> <a href="{{url('pay-emoluments')}}" class="nav-link">Pay and Emoluments</a></li>
                    <li class="nav-item"> <a href="{{url('employee-bank-detail')}}" class="nav-link">Bank Detail</a></li>
                    <li class="nav-item"> <a href="{{url('job-description')}}" class="nav-link">Job Description</a></li>
                    <li class="nav-item"> <a href="{{url('tasks')}}" class="nav-link">Task</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('employee-leave')}}">Employee Leave</a></li>
                </ul>
            </div>
        </li>

        <!--<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#HR" aria-expanded="false" aria-controls="HR">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">HR</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="HR">    
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('Attendance-HR')}}" class="nav-link"> Attendance HR</a></li>
                    <li class="nav-item"> <a href="{{url('HR-Hiring')}}" class="nav-link"> HR Hiring</a></li>
                    <li class="nav-item"> <a href="{{url('Actions-On-HR')}}" class="nav-link">Actions on HR</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Pay-&-Allowances')}}">Pay & Allowances</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Loans-Advances')}}">Loans/Advances</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Run-Payroll')}}">Run Payroll</a></li>

                </ul>
            </div>
        </li> 
        <li class="nav-item"> 
            <a class="nav-link" href="companies">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Companies</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('categories') }}">
                <i class="mdi mdi-settings menu-icon"></i>
                <span class="menu-title">Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('queries-reports') }}">
                <i class="mdi mdi-file menu-icon"></i>
                <span class="menu-title">Queries Reports</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('complaints') }}">
                <i class="mdi mdi-comment-alert menu-icon"></i>
                <span class="menu-title">Complaints</span>
            </a>
        </li>-->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#finance" aria-expanded="false" aria-controls="finance">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Finance</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="finance">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('create-chart-account')}}" class="nav-link">Chart of Account</a></li>
                    <li class="nav-item"> <a href="{{url('Add-general-Journal-Entry')}}" class="nav-link">General Journal Entries</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#financeReports" aria-expanded="false" aria-controls="financeReports">
                <i class="mdi mdi-file menu-icon"></i>
                <span class="menu-title">Finance Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="financeReports">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a href="{{url('finance-report')}}" class="nav-link">Report Chart Account</a></li>
                    <li  class="nav-item"><a href="{{url('report-general-journal')}}" class="nav-link">Report General Journal</a></li>
                    <li  class="nav-item"><a href="{{url('getGeneral-ledger-report')}}" class="nav-link">Report General Ledger</a></li>
                    <li  class="nav-item"><a href="{{url('Trial-Balance')}}" class="nav-link">Report Trial Balance </a></li>
                    <!--<li class="nav-item"> <a class="nav-link" href="{{url('balance-sheet')}}">Balance Sheet</a></li>-->
                    <li class="nav-item"> <a class="nav-link" href="{{url('advance-reports')}}">Advance Report</a></li>
                    <!--                    <li class="nav-item"> <a class="nav-link" href="{{url('income-statement')}}">Income Statement</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="{{url('cash-flow')}}">Cash Flow</a></li>-->
                    <li class="nav-item"> <a class="nav-link" href="{{url('fixed-asset')}}">Fixed Asset</a></li>
                </ul>
            </div>
        </li>

        <!--        <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                        <i class="mdi mdi-file menu-icon"></i>
                        <span class="menu-title">Reports</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-advanced">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="queries-reports">Queries Reports</a></li>
                        </ul>
                    </div>
                </li>-->

        </a>
    </ul>
</nav>
</li>
