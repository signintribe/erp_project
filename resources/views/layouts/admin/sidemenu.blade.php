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
                    <li class="nav-item"> <a href="{{url('company/company-departments')}}" class="nav-link">Departments</a></li>
                    <li class="nav-item"> <a href="{{url('company/company-calander')}}" class="nav-link">Company Calander</a></li>
                    <li class="nav-item"> <a href="{{url('company/company-shift')}}" class="nav-link">Company Shift</a></li>
                    <li class="nav-item"> <a href="{{url('company/employee-group')}}" class="nav-link">Employee Group</a></li>
                    <li class="nav-item"> <a href="{{url('company/employee-payscale')}}" class="nav-link">Employee Payscale</a></li>
                    <li class="nav-item"> <a href="{{url('company/employee-jd')}}" class="nav-link">Employee JD's</a></li>
                    <li class="nav-item"> <a href="{{url('company/gazzeted-holiday')}}" class="nav-link">Gazzeted Holiday</a></li>
                    <li class="nav-item"> <a href="{{url('company/yearly-leave')}}" class="nav-link">Yearly Leave</a></li>
                    <li class="nav-item"> <a href="{{url('company/pay-allowance-deduction')}}" class="nav-link">Pay, Allowance, Deduction</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Employee-Center" aria-expanded="false" aria-controls="Employee-Center">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">HR</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Employee-Center">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('hr/employee-personal-information')}}" class="nav-link">Employee Information </a></li>
                    <li class="nav-item"> <a href="{{url('hr/employees-addresses')}}" class="nav-link">Employee Address</a></li>
                    <li class="nav-item"> <a href="{{url('hr/spouse-detail')}}" class="nav-link">Spouse Detail</a></li>
                    <li class="nav-item"> <a href="{{url('hr/education-detail')}}" class="nav-link">Education Detail</a></li>
                    <li class="nav-item"> <a href="{{url('hr/certification-detail')}}" class="nav-link">Certification Detail</a></li>
                    <li class="nav-item"> <a href="{{url('hr/experience-detail')}}" class="nav-link">Experience Detail</a></li>
                    <li class="nav-item"> <a href="{{url('hr/organizational-assignment')}}" class="nav-link">Organizational Assignment</a></li>
                    <li class="nav-item"> <a href="{{url('hr/pay-emoluments')}}" class="nav-link">Pay and Emoluments</a></li>
                    <li class="nav-item"> <a href="{{url('hr/employee-bank-detail')}}" class="nav-link">Bank Detail</a></li>
                    <li class="nav-item"> <a href="{{url('hr/job-description')}}" class="nav-link">Job Description</a></li>
                    <li class="nav-item"> <a href="{{url('hr/tasks')}}" class="nav-link">Task</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('employee-leave')}}">Employee Leave</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Vendor-Center" aria-expanded="false" aria-controls="Vendor-Center">
                <i class="fa fa-building menu-icon"></i>
                <span class="menu-title">Vendor Center</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Vendor-Center">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('vendor/vendor-information')}}" class="nav-link">Vendor Information</a></li>
                    <li class="nav-item"> <a href="{{url('vendor/vendor-address')}}" class="nav-link">Vendor Address</a></li>
                    <li class="nav-item"> <a href="{{url('vendor/vendor-contact')}}" class="nav-link">Vendor Contact</a></li>
                    <li class="nav-item"> <a href="{{url('vendor/vendor-person')}}" class="nav-link">Contact Person</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Customer-Center" aria-expanded="false" aria-controls="Customer-Center">
                <i class="fa fa-user menu-icon"></i>
                <span class="menu-title">Customer Center</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Customer-Center">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('customer-information')}}" class="nav-link">Customer Information</a></li>
                    <li class="nav-item"> <a href="{{url('customer-address')}}" class="nav-link">Customer Address</a></li>
                    <li class="nav-item"> <a href="{{url('contact-detail')}}" class="nav-link">Contact Detail</a></li>
                    <li class="nav-item"> <a href="{{url('customer-contact-person')}}" class="nav-link">Contact Person</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Category-Center" aria-expanded="false" aria-controls="Inventory-Center">
                <i class="fa fa-group menu-icon"></i>
                <span class="menu-title">Category Center</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Category-Center">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('categories')}}" class="nav-link">Add Category</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Inventory-Center" aria-expanded="false" aria-controls="Inventory-Center">
                <i class="fa fa-cubes menu-icon"></i>
                <span class="menu-title">Inventory Center</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Inventory-Center">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('add-inventory')}}" class="nav-link">Add Inventory</a></li>
                    <li class="nav-item"> <a href="{{url('view-inventory')}}" class="nav-link">View Inventory</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Purchase-Order" aria-expanded="false" aria-controls="Purchase-Order">
                <i class="fa fa-dollar menu-icon"></i>
                <span class="menu-title">Purchase Order</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Purchase-Order">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('add-purchase-order')}}" class="nav-link">Add Purchase Order</a></li>
                    <li class="nav-item"> <a href="{{url('view-purchase-order')}}" class="nav-link">View Purchase Order</a></li>
                    <li class="nav-item"> <a href="{{url('add-purchase-receive')}}" class="nav-link">Add Purchase Receive</a></li>
                    <li class="nav-item"> <a href="{{url('view-purchase-receive')}}" class="nav-link">View Purchase Receive</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Quotation" aria-expanded="false" aria-controls="Quotation">
                <i class="fa fa-file-pdf-o menu-icon"></i>
                <span class="menu-title">Quotation's</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Quotation">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('add-quotation')}}" class="nav-link">Add Quotation</a></li>
                    <li class="nav-item"> <a href="{{url('view-quotations')}}" class="nav-link">View Quotations</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Sales" aria-expanded="false" aria-controls="Sales">
                <i class="fa fa-cart-plus menu-icon"></i>
                <span class="menu-title">Sales</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Sales">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('add-sales-order')}}" class="nav-link">Add Sales Order</a></li>
                    <li class="nav-item"> <a href="{{url('view-sales-order')}}" class="nav-link">View Sales Order</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#AddLogistics" aria-expanded="false" aria-controls="AddLogistics">
                <i class="fa fa-bus menu-icon"></i>
                <span class="menu-title">Add Logistics</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="AddLogistics">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('freight-forward-det')}}" class="nav-link">Freight Forward Det</a></li>
                    <li class="nav-item"> <a href="{{url('customer-clearance')}}" class="nav-link">Customer Clearance</a></li>
                    <li class="nav-item"> <a href="{{url('carriage-company')}}" class="nav-link">Carriage Company</a></li>
                    <li class="nav-item"> <a href="{{url('viewfreightforwarddet')}}" class="nav-link">View Freight Forward Det</a></li>
                    <li class="nav-item"> <a href="{{url('viewcustomerclearance')}}" class="nav-link">View Customer Clearance</a></li>
                    <li class="nav-item"> <a href="{{url('viewcarriagecompany')}}" class="nav-link">View Carriage Company</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mmform" aria-expanded="false" aria-controls="mmform">
                <i class="fa fa-cube menu-icon"></i>
                <span class="menu-title">MM Forms</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mmform">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('store-requisition')}}" class="nav-link">Store Requisition</a></li>
                    <li class="nav-item"> <a href="{{url('material-issue')}}" class="nav-link">Material Issue</a></li>
                    <li class="nav-item"> <a href="{{url('material-returned')}}" class="nav-link">Material Returned</a></li>
                    <li class="nav-item"> <a href="{{url('view-storerequisition')}}" class="nav-link">View Store Requisition</a></li>
                    <li class="nav-item"> <a href="{{url('view-materialissue')}}" class="nav-link">View Material Issue</a></li>
                    <li class="nav-item"> <a href="{{url('view-materialreturned')}}" class="nav-link">View Material Returned</a></li>
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
