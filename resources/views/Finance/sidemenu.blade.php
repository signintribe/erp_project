<!-- partial:partials/_settings-panel.html -->
<div class="theme-setting-wrapper">
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
<div id="right-sidebar" class="settings-panel">
    <i class="settings-close mdi mdi-close"></i>
    <ul class="nav nav-tabs" id="setting-panel" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
        </li>
    </ul>
    <div class="tab-content" id="setting-content">
        <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
                <form class="form w-100">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                        <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                    </div>
                </form>
            </div>
            <div class="list-wrapper px-3">
                <ul class="d-flex flex-column-reverse todo-list">
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Team review meeting at 3.00 PM
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Prepare for presentation
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Resolve all the low priority tickets due today
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li class="completed">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox" checked>
                                Schedule meeting for next week
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li class="completed">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox" checked>
                                Project review
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                </ul>
            </div>
            <div class="events py-4 border-bottom px-3">
                <div class="wrapper d-flex mb-2">
                    <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                    <span>Feb 11 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                <p class="text-gray mb-0">build a js based app</p>
            </div>
            <div class="events pt-4 px-3">
                <div class="wrapper d-flex mb-2">
                    <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                    <span>Feb 7 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
        </div>
        <!-- To do section tab ends -->
        <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
                <li class="list active">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="online"></span></div>
                    <div class="info">
                        <p>Thomas Douglas</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">19 min</small>
                </li>
                <li class="list">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="offline"></span></div>
                    <div class="info">
                        <div class="wrapper d-flex">
                            <p>Catherine</p>
                        </div>
                        <p>Away</p>
                    </div>
                    <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                    <small class="text-muted my-auto">23 min</small>
                </li>
                <li class="list">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="online"></span></div>
                    <div class="info">
                        <p>Daniel Russell</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">14 min</small>
                </li>
                <li class="list">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="offline"></span></div>
                    <div class="info">
                        <p>James Richardson</p>
                        <p>Away</p>
                    </div>
                    <small class="text-muted my-auto">2 min</small>
                </li>
                <li class="list">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="online"></span></div>
                    <div class="info">
                        <p>Madeline Kennedy</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">5 min</small>
                </li>
                <li class="list">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span class="online"></span></div>
                    <div class="info">
                        <p>Sarah Graves</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">47 min</small>
                </li>
            </ul>
        </div>
        <!-- chat tab ends -->
    </div>
</div>
<!-- partial -->
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('adminhome') }}">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
            </li> 
    
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Organization" aria-expanded="false" aria-controls="Organization">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Organization</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Organization">    
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('Company')}}" class="nav-link">Company</a></li>
                        <li class="nav-item"> <a href="{{url('Departments')}}" class="nav-link">Departments</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{url('Projects')}}">Projects</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{url('Activities')}}">Activities</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="{{url('Phases')}}">Phases</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="{{url('Tasks')}}">Tasks</a></li>
                </ul>
            </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Tenders-Management" aria-expanded="false" aria-controls="Tenders-Management">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Tenders Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Tenders-Management">    
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('Tenders-Management')}}" class="nav-link">Tenders Management</a></li>
                        
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Logistic-Management" aria-expanded="false" aria-controls="Logistic-Management">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Logistic Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Logistic-Management">    
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('Tenders-Management')}}" class="nav-link">Logistic Management</a></li>
                        
                </ul>
            </div>
        </li>

                <li class="nav-item">
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
        <!--<li class="nav-item"> 
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
                    <li class="nav-item"> <a class="nav-link" href="{{url('Add-general-Journal-Entry')}}">General Journal Entries</a></li>
                    <!--<li class="nav-item"> <a class="nav-link" href="{{url('check-student-fee')}}">Check Student Fee</a></li>-->
                </ul>
            </div>
        </li>

                <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Tax-Management" aria-expanded="false" aria-controls="Tax-Management">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Tax Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Tax-Management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('Define-Taxes')}}">Define Taxes</a></li>
                    <li class="nav-item"> <a href="{{url('Tax-Management')}}" class="nav-link">Tax Management</a></li>                    
                </ul>
            </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Organization-report" aria-expanded="false" aria-controls="Organization-report">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Organization Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Organization-report">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('Organization-Report')}}" class="nav-link">Companies Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Department-Reports')}}">Department Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Projects-Reports')}}">Projects Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Activty-Reports')}}">Activity Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Phases-Reports')}}">Phases Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Tasks-Reports')}}">Tasks Reports</a></li>
                    
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#HR-Reports" aria-expanded="false" aria-controls="HR-Reports">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">HR Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="HR-Reports">    
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('Attendance-Report')}}" class="nav-link"> Attendance Report</a></li>
                    <li class="nav-item"> <a href="{{url('Hiring-Report')}}" class="nav-link"> Hiring Report</a></li>
                        <li class="nav-item"> <a href="{{url('Actions-Report')}}" class="nav-link">Actions Report</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{url('Pay-Allowances-Report')}}">Pay & Allowances Report</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{url('Loans-Advances')}}">Loans/Advances Report</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="{{url('Runpayroll')}}">Run Payroll Report</a></li>
                                        
                </ul>
            </div>
        </li> 


        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#financial-report" aria-expanded="false" aria-controls="financial-report">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Financial Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="financial-report">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('Report-Chart-of-account')}}" class="nav-link">Report Chart Account</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-General-Journal')}}">Report General Journal</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-General-Ledger')}}">Report General Ledger</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-Trial-Balance')}}">Report Trial Balance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-Income-Statement')}}">Report Income Statement</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-Balance-Sheet')}}">Report Balance Sheet</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-Cash-Flow')}}">Report Cash Flow</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-Purchases')}}">Report Purchases</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-Sales')}}">Report Sales</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-inventory')}}">Report Inventory</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-Customers')}}">Report Customers Or A/R</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Report-Vendors')}}">Report Vendors Or A/P</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Custom-Report')}}">Custom Report </a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Taxes-report" aria-expanded="false" aria-controls="Taxes-report">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Taxes report</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Taxes-report">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a href="{{url('Taxes-report')}}" class="nav-link">Company Tax Reports </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('Employees-Tax-Reports')}}">Employees Tax Reports</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('users') }}">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
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
         