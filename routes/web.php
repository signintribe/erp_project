<?php
/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('mainsite');
})->name('loginpage');

Auth::routes();

/**
 * Supper Admin Routes
 */

Route::get('employee-bank-detail', 'EmployeeController@employee_bank_detail')->name('employee-bank-detail');

Route::get('employee-leave', 'EmployeeController@employee_leave')->name('employee-leave');

Route::group(['prefix'=>'hr'], function () {
  Route::get('getEmployees', 'Admin\UsersController@getEmployees')->middleware('is_admin');
  Route::get('employee-personal-information', 'Admin\UsersController@index')->name('users')->middleware('is_admin');
  Route::post('SaveUsers', 'Admin\UsersController@SaveUsers')->middleware('is_admin');
  Route::resource('maintain-employee-address', 'Admin\EmployeeAddressController');
  Route::get('employees-addresses', 'EmployeeController@add_employees_addresses');
  Route::get('spouse-detail', 'EmployeeController@spouse_detail')->name('spouse-detail');
  Route::resource('maintain-spouse-detail', 'Admin\SpouseDetailController');
  Route::resource('maintain-employee-education', 'Admin\EmployeeEducationController');
  Route::resource('maintain-employee-certification', 'Admin\EmployeeCertificationController');
  Route::resource('maintain-employee-experience', 'Admin\EmployeeExperienceController');
  Route::resource('maintain-organization-assignment', 'Admin\EmployeeOrganizationAssignmentController');
  Route::resource('maintain-pay-emoluments', 'Admin\EmployeePayEmolumentController');
  Route::resource('maintain-job-description', 'Admin\EmployeeJobDescriptionController');
  Route::get('education-detail', 'EmployeeController@education_detail');
  Route::get('certification-detail', 'EmployeeController@certification_detail')->name('certification-detail');
  Route::get('experience-detail', 'EmployeeController@experience_detail')->name('experience-detail');
  Route::get('organizational-assignment', 'EmployeeController@organizational_assignment')->name('organizational-assignment');
  Route::get('pay-emoluments', 'EmployeeController@pay_emoluments')->name('pay-and-emoluments');
  Route::get('employee-bank-detail', 'EmployeeController@employee_bank_detail')->name('employee-bank-detail');
  Route::resource('maintain-emp-bankdetail', 'Admin\EmployeeBankController');
  Route::get('job-description', 'EmployeeController@job_description')->name('job-description');
  Route::get('tasks', 'EmployeeController@tasks')->name('tasks');
  Route::resource('maintain-emp-tasks', 'Admin\EmployeeBankController');
});

/**
 * Vendor Center
*/
Route::group(['prefix'=>'vendor'], function () {
  Route::get('vendor-information', 'VendorController@index')->name('organizational-information');
  Route::get('vendor-address', 'VendorController@organization_address')->name('organization-address');
  Route::get('vendor-contact', 'VendorController@organization_contact')->name('organization-contact');
  Route::get('vendor-person', 'VendorController@contact_person')->name('organization-contact-person');
});

Route::get('getAddress/{address_id}', 'Admin\EmployeeAddressController@getAddress');
Route::get('getContact/{contact_id}', 'Admin\EmployeeAddressController@getContact');
Route::get('getSocialMedia/{social_id}', 'Admin\EmployeeAddressController@getSocialMedia');

Route::get('view-employees', 'Admin\UsersController@view_employees')->name('view_employees')->middleware('is_admin');
//Route::get('getusers', 'Admin\UsersController@getusers')->middleware('is_admin');
Route::get('approve_user/{user_id}/{status}', 'Admin\UsersController@approve_user')->middleware('is_admin');

/**
 * Employees Routes
*/
Route::get('/home', 'HomeController@index')->name('home')->middleware('is_vendor');

/**
 * User Dashboard
*/
Route::get('/userdashboard', 'User\UserController@index')->name('userdashboard')->middleware('is_user');

/**
 * Customer Dashboard
*/
Route::get('customer-information', 'CustomerController@index')->name('customer-information');
Route::get('customer-address', 'CustomerController@customer_address')->name('customer-address');
Route::get('contact-detail', 'CustomerController@contact_detail')->name('contact-detail');
Route::get('customer-contact-person', 'CustomerController@customer_contact_person')->name('customer-contact-person');

/**
 * Inventory Center
*/
Route::get('add-inventory', 'InventoryController@index')->name('add-inventory');
Route::get('view-inventory', 'InventoryController@view_inventory')->name('view-inventory');

/**
 * Purchase Order Section
*/
Route::get('add-purchase-order', 'PurchaseOrderController@index')->name('add-purchase-order');
Route::get('add-purchase-receive', 'PurchaseOrderController@add_purchase_receive')->name('add-purchase-order');
Route::get('view-purchase-order', 'PurchaseOrderController@view_purchase_order')->name('view-purchase-order');
Route::get('view-purchase-receive', 'PurchaseOrderController@view_purchase_receive')->name('view-purchase-receive');

/**
 * Quotation Section
*/
Route::get('add-quotation', 'QuotationController@index')->name('add-quotation');
Route::get('view-quotations', 'QuotationController@view_quotations')->name('view-quotations');

/**
 * Sales Section
 */
Route::get('add-sales-order', 'SalesController@index')->name('add-sales-order');
Route::get('view-sales-order', 'SalesController@view_sales_order')->name('view-sales-order');


/**
 * Logistics Section
 */
Route::get('freight-forward-det', 'LogisticsController@index')->name('freight-forward-det');
Route::get('customer-clearance', 'LogisticsController@customer_clearance')->name('customer-clearance');
Route::get('carriage-company', 'LogisticsController@carriage_company')->name('carriage-company');
Route::get('viewfreightforwarddet', 'LogisticsController@view_freight_forward_det')->name('view-freight-forward-det');
Route::get('viewcustomerclearance', 'LogisticsController@view_customer_clearance')->name('view-customer-clearance');
Route::get('viewcarriagecompany', 'LogisticsController@view_carriage_company')->name('view-carriage-company');

/**
 * MM Forms
 */
Route::get('store-requisition', 'MMController@index')->name('store-requisition');
Route::get('material-issue', 'MMController@material_issue')->name('material-issue');
Route::get('view-storerequisition', 'MMController@view_storerequisition')->name('view-storerequisition');
Route::get('view-materialissue', 'MMController@view_materialissue')->name('view-materialissue');
Route::get('view-materialreturned', 'MMController@view_materialreturned')->name('view-materialreturned');


Route::get('nostatus-company-queries/{status}', 'HomeController@status_company_queries')->name('status-company-queries')->middleware('is_vendor');
Route::get('get-my-totalrevenue', 'HomeController@get_my_totalrevenue')->name('get-my-totalrevenue')->middleware('is_vendor');


Route::get('adminhome', 'HomeController@adminHome')->name('adminhome')->middleware('is_admin');
Route::get('all-customers', 'HomeController@all_customers')->name('all-customers')->middleware('is_admin');
Route::get('all-queriesinadmin', 'HomeController@all_queriesinadmin')->name('all-queriesinadmin')->middleware('is_admin');
Route::get('all-queriesstatusinadmin', 'HomeController@all_queriesstatusinadmin')->name('all-queriesstatusinadmin')->middleware('is_admin');
Route::get('all-companiesinadmin', 'HomeController@all_companiesinadmin')->name('all-companiesinadmin')->middleware('is_admin');
Route::get('get-all-totalrevenue', 'HomeController@get_all_totalrevenue')->name('get-all-totalrevenue')->middleware('is_admin');





/**
 * Sub Admin Routes
 */
Route::get('categories', 'Admin\CategoryController@index')->name('categories')->middleware('is_admin');
Route::get('get_categories/{category_id}', 'Admin\CategoryController@get_categories')->name('allcategories')->middleware('is_admin');
Route::get('get-categorywithitsparents/{parent_id}', 'Admin\CategoryController@get_categorywithitsparents')->name('get-categorywithitsparents');
Route::get('delete_category/{category_id}', 'Admin\CategoryController@delete_category')->name('deletecategories')->middleware('is_admin');
Route::post('save_category', 'Admin\CategoryController@save_category')->name('savecategories')->middleware('is_admin');

Route::get('queries-reports', 'Admin\QueriesController@index')->name('queries-reports')->middleware('is_admin');
Route::get('all-queries-report', 'Admin\QueriesController@all_queries_report')->name('all-queries-report')->middleware('is_admin');
Route::post('search-queries', 'Admin\QueriesController@search_queries')->name('search-queries')->middleware('is_admin');

Route::get('companies', 'Admin\CompaniesController@index')->name('companies-reports')->middleware('is_admin');
Route::get('get-all-companies', 'Admin\CompaniesController@get_all_companies')->name('get-all-companies')->middleware('is_admin');
Route::get('get-company-portfolio/{company_id}', 'Admin\CompaniesController@get_company_portfolio')->name('get-company-portfolio')->middleware('is_admin');
Route::get('get-company-address/{user_id}', 'Admin\CompaniesController@get_company_address')->name('get-company-address')->middleware('is_admin');
Route::get('get-company-user/{user_id}', 'Admin\CompaniesController@get_company_user')->name('get-company-user')->middleware('is_admin');
Route::get('get-company-socialmedia/{company_id}', 'Admin\CompaniesController@get_company_socialmedia')->name('get-company-socialmedia')->middleware('is_admin');
Route::get('your-company-profile', 'Admin\CompaniesController@your_company_profile')->name('your-company-profile')->middleware('is_admin');


Route::get('complaints', 'Admin\ComplaintsController@index')->name('complaints')->middleware('is_admin');
Route::get('get-all-complaints', 'Admin\ComplaintsController@get_all_complaints')->name('get-all-complaints')->middleware('is_admin');
/**
 * User Company Profile Routes
 */
Route::group(['prefix'=>'company'], function () {
  Route::get('company-profile', 'CompanyProfileController@index')->name('companyProfile')->middleware('is_admin');
  Route::get('check_user_approve', 'CompanyProfileController@check_user_approve')->name('checkuserapprove');
  Route::get('check_company/{company_name}', 'CompanyProfileController@check_company')->name('checkuserapprove');
  Route::get('getcompanyinfo', 'CompanyProfileController@getcompanyinfo')->name('getcompanyinfo');
  Route::get('getcompanysocial/{social_id}', 'CompanyProfileController@getcompanysocial')->name('getcompanysocial');
  Route::get('getcompanyaddress/{address_id}', 'CompanyProfileController@getcompanyaddress')->name('getcompanyaddress');
  Route::get('getcompanycontact/{contact_id}', 'CompanyProfileController@getcompanycontact')->name('getcompanycontact');
  Route::post('SaveCompany', 'CompanyProfileController@SaveCompany')->name('SaveCompany');
  Route::get('view-company', 'CompanyProfileController@view_company')->name('view-company');
  Route::get('company-registration' , 'Admin\CompanyRegistrationController@view_registration');
  Route::get('maintain-office' , 'Admin\OfficeController@maintain_office');
  Route::resource('registration-company' , 'Admin\CompanyRegistrationController');
  Route::resource('office-settings' , 'Admin\OfficeController');
  Route::get('getoffice/{company_id}' , 'Admin\OfficeController@getoffice');
  Route::resource('maintain-company', 'Admin\CompanyProfileController');
  Route::get('company-departments', 'Admin\DepartmentsController@index')->name('departments')->middleware('is_admin');
  Route::post('SaveDepartment', 'Admin\DepartmentsController@SaveDepartment')->name('SaveDepartment')->middleware('is_admin');
  Route::get('getdepartments', 'Admin\DepartmentsController@getdepartments')->name('getdepartments')->middleware('is_admin');
  Route::get('delete-department/{deptid}', 'Admin\DepartmentsController@delete_department')->name('delete-department')->middleware('is_admin');
  Route::get('getonedept/{deptid}', 'Admin\DepartmentsController@getonedept')->name('delete-department')->middleware('is_admin');
  Route::get('company-calander', 'Admin\CompanyCalenderController@company_calander')->name('company_calander')->middleware('is_admin');
  Route::get('get-calendar/{dept_id}', 'Admin\CompanyCalenderController@get_calendar')->middleware('is_admin');
  Route::resource('maintain-calender', 'Admin\CompanyCalenderController')->middleware('is_admin');
  Route::get('get-departments/{office_id}', 'Admin\CompanyCalenderController@get_departments')->middleware('is_admin');
  Route::get('company-shift', 'Admin\CompanyShiftController@company_shift')->middleware('is_admin');
  Route::get('get-shift/{dept_id}', 'Admin\CompanyShiftController@get_shift')->middleware('is_admin');
  Route::resource('maintain-shift', 'Admin\CompanyShiftController');
  Route::get('employee-group', 'Admin\EmployeeGroupController@employee_group');
  Route::get('employee-payscale', 'Admin\PayScaleController@employee_payscale');
  Route::get('employee-jd', 'Admin\EmployeeJDController@employee_jd');
  Route::get('gazzeted-holiday', 'Admin\GazzetedHolidayController@gazzeted_holiday');
  Route::get('yearly-leave', 'Admin\YearlyLeaveController@yearly_leave');
  Route::get('pay-allowance-deduction', 'Admin\PayAllowanceDeductionController@pay_allownce');
  Route::resource('maintain-allowance-deducation', 'Admin\PayAllowanceDeductionController');
  Route::resource('maintain-group', 'Admin\EmployeeGroupController');
  Route::resource('maintain-payscale', 'Admin\PayScaleController');
  Route::resource('maintain-jds', 'Admin\EmployeeJDController');
  Route::resource('maintain-holiday', 'Admin\GazzetedHolidayController');
  Route::resource('maintain-leaves', 'Admin\YearlyLeaveController');

});
/**
 * Company portfolio
 */
Route::get('company-portfolio', 'CompanyPortfolioController@index')->name('companyportfolio')->middleware('is_vendor');
Route::get('delete_portfolio_image/{image_id}', 'CompanyPortfolioController@delete_portfolio_image')->name('delete_portfolio_image')->middleware('is_vendor');
Route::get('getcompanyportfolio', 'CompanyPortfolioController@getcompanyportfolio')->name('getcompanyportfolio')->middleware('is_vendor');
Route::get('edit_portfolio_image/{portfolio_id}', 'CompanyPortfolioController@edit_portfolio_image')->name('edit_portfolio_image')->middleware('is_vendor');
Route::post('SaveCompanyPortfolio', 'CompanyPortfolioController@SaveCompanyPortfolio')->name('SaveCompanyPortfolio')->middleware('is_vendor');

/**
 * Customer Queries
 */
Route::get('queries', 'CustomerQueriesController@index')->name('queries')->middleware('is_vendor');
Route::get('all-company-queries', 'CustomerQueriesController@all_company_queries')->name('allcompanyqueries');
Route::get('specific-query/{query_id}', 'CustomerQueriesController@specific_query')->name('allcompanyqueries');
Route::get('schedule-query/{query_id}', 'CustomerQueriesController@schedule_query')->name('schedule-query');
Route::get('get-query-followup/{query_id}', 'CustomerQueriesController@get_query_followup')->name('get-query-followup');
Route::get('get-selected-category/{category_id}', 'CustomerQueriesController@get_selected_category')->name('get-selected-category');
Route::post('save-query-status', 'CustomerQueriesController@save_query_status')->name('save-query-status');
Route::post('save-query-followup', 'CustomerQueriesController@save_query_followup')->name('save-query-followup');

Route::get('feedback', 'CustomerFeedbackController@index')->name('feedbak')->middleware('is_vendor');
Route::get('all-company-feedback', 'CustomerFeedbackController@all_company_feedback')->name('all-company-feedback')->middleware('is_vendor');

Route::get('select-category', 'SelectCategoryController@index')->name('all-company-feedback')->middleware('is_vendor');
Route::post('save-selected-categories', 'SelectCategoryController@save_selected_categories')->name('save-selected-categories')->middleware('is_vendor');
Route::get('get-company-categories/{company_id}', 'SelectCategoryController@get_company_categories')->middleware('is_vendor');
Route::get('delete-selectedcategory/{category_id}', 'SelectCategoryController@delete_selectedcategory')->middleware('is_vendor');


Route::get('/redirect', 'FacebookLoginController@redirect');
Route::get('/callback', 'FacebookLoginController@callback');

Route::get('create-chart-account', 'Admin\FinanceController@defineAccount');
Route::get('getAccountCategories/{id}', 'Globall\CategoriesController@getAccountCategories');
Route::post('save-account', 'Admin\FinanceController@save_category');
Route::get('delete-account-category/{id}','Admin\FinanceController@delete_category');
Route::get('Add-general-Journal-Entry', 'Admin\FinanceController@generalJournalEntry');
Route::get('AllchartofAccount', 'Admin\FinanceController@AllchartofAccount');
Route::post('Save-General-Entries', 'Admin\FinanceController@SaveGeneralEntries');

Route::get('finance-report', 'Admin\FinanceReportController@finance_report');
Route::get('report-general-journal', 'Admin\FinanceReportController@report_general_journal');
Route::post('getGeneral-journal-report', 'Admin\FinanceReportController@GeneraljournalreportData');
Route::get('getGeneral-ledger-report', 'Admin\FinanceReportController@report_general_ledger');
Route::post('get-General-ledger-report', 'Admin\FinanceReportController@GeneraljournalLedgerreportData');
Route::get('Trial-Balance', 'Admin\FinanceReportController@TrialBalance');
Route::post('TrialBalance-report', 'Admin\FinanceReportController@TrialBalanceReportData');
Route::get('balance-sheet', 'Admin\FinanceReportController@BalanceSheet');
//Route::get('income-statement', 'Admin\FinanceReportController@income_statement');
//Route::get('cash-flow', 'Admin\FinanceReportController@cash_flow');
Route::get('advance-reports', 'Admin\FinanceReportController@advance_reports');
Route::get('fixed-asset', 'Admin\FinanceReportController@fixed_asset');
Route::post('BalanceSheet-report', 'Admin\FinanceReportController@BalanceSheetReportData');
Route::post('incomeStatement-report', 'Admin\FinanceReportController@incomeStatementReportData');

Route::get('user-types', 'Admin\PrivilegesController@types')->name('Types Data');
//Route::get('/userhome', 'User\UserController@index');

/**
  Accounts Module
 * */
Route::get('sub-menu', function () {
    return view('admin.sub_menu');
})->name('loginpage');
