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
 */\

Route::get('/', function () {
    return view('mainsite');
})->name('loginpage');

Auth::routes();
Route::get('creation-tier', 'TierController@creation_tier');
Route::get('requestion', 'TierController@requestion');
Route::resource('maintain-requestions', 'RequestionController');
Route::get('change-request-status/{request_id}/{status}', 'RequestionController@changeStatus');
Route::get('task-tier', 'TierController@task_tier');
Route::get('report-tier', 'TierController@report_tier');
Route::get('user-auth-tier', 'TierController@user_auth_tier');
Route::resource('manage-registration' , 'Admin\CompanyRegistrationController');
Route::resource('manage-authorities', 'company\AuthoritiesController');

/**
 * Supper Admin Routes
 */

//Route::get('employee-bank-detail', 'EmployeeController@employee_bank_detail')->name('employee-bank-detail');
Route::get('search-companies/{compny_name}', 'ApiController@searchCompany');
Route::get('get-mycompany/{compny_id}', 'ApiController@myCompany');
Route::view('user-rights-privileges', 'admin.user-rights-privileges');

Route::get('employee-leave', 'EmployeeController@employee_leave')->name('employee-leave');
Route::view('open-existing-company','auth.open-company')->name('open-company');
Route::group(['prefix'=>'hr'], function () {
  Route::get('pay-allowance-deduction', 'Admin\PayAllowanceDeductionController@pay_allownce');
  Route::view('employee-trainings', 'employee_center.employee-trainings');
  Route::get('employee-payscale', 'Admin\PayScaleController@employee_payscale');
  Route::get('timing-info', 'HrViewsController@timing_info');
  Route::get('employee-jd', 'Admin\EmployeeJDController@employee_jd');
  Route::get('getEmployees/{company_id}', 'Admin\UsersController@getEmployees')->middleware('is_admin');
  Route::get('employee-personal-information', 'Admin\UsersController@index')->name('users')->middleware('is_admin');
  Route::get('employees-registration', 'Admin\UsersController@employeesRegistration');
  Route::post('SaveUsers', 'Admin\UsersController@SaveUsers')->middleware('is_admin');
  Route::get('editEmployee/{id}', 'Admin\UsersController@editEmployeeInfo');
  Route::get('editContact/{con_id}', 'Admin\UsersController@editContact');
  Route::get('editSocial/{soc_id}', 'Admin\UsersController@editSocial');
  Route::delete('deleteEmployees/{id}', 'Admin\UsersController@deleteEmployeeInfo');
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
  Route::resource('maintain-emp-tasks', 'Admin\EmployeeTaskController');
  Route::get('get-task-assigned-details/{assigned_id}', 'Admin\EmployeeTaskController@taskAssignedDetail');
  Route::get('employee-contact-person', 'EmployeeController@employeeContactPerson');
});


Route::group(['prefix'=>'bank'], function () {
  Route::get('bank-contact-person', 'CompanyProfileController@bankContactPerson');
  Route::get('budget', 'company\CompanyBudgetController@budget');
  Route::post('save-budget', 'company\CompanyBudgetController@saveBudget');
  Route::get('delete-budget/{budget_id}', 'company\CompanyBudgetController@deleteBudget');
  Route::get('get-accounts-budget', 'company\CompanyBudgetController@getAccountBudget');
  Route::get('get-budget-detail', 'company\CompanyBudgetController@getBudgetDetail');
  Route::get('Taxes', 'company\CompanyTaxController@taxesView');
  Route::resource('manage-tax', 'company\CompanyTaxController');
});


/**
 * Vendor Center
*/
Route::group(['prefix'=>'vendor'], function () {
  Route::get('getVendors', 'Admin\VendorInformationController@getVendors')->middleware('is_admin');
  Route::resource('save-vendor-information', 'SupplierController');
  Route::get('add-vendor', 'SupplierController@vendorIndex');
  Route::get('edit-vendor/{id}', 'SupplierController@getVendor');
  Route::get('change-vendor-status/{id}/{status}', 'SupplierController@vendorStatus');
  Route::get('view-vendor', 'SupplierController@viewVendor');
  Route::get('vendor-information', 'VendorController@index')->name('organizational-information');
  Route::get('vendor-address', 'VendorController@organization_address')->name('organization-address');
  Route::get('vendor-contact', 'VendorController@organization_contact')->name('organization-contact');
  Route::get('vendor-person', 'VendorController@contact_person')->name('organization-contact-person');
  Route::get('vendor-registration', 'VendorController@vendorRegistration');
  Route::resource('maintain-vendor-information', 'Admin\VendorInformationController');
  Route::get('get-vendor/{ven_id}', 'Admin\VendorInformationController@getVendors');
  Route::get('vendor-bank-detail', 'Admin\VendorInformationController@vendorBankDetail');
  Route::resource('maintain-vendor-contact', 'Vendor\VendorContactController');
  Route::resource('maintain-vendor-address', 'Admin\VendorAddressController');
  
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
Route::group(['middleware' => ['auth:web','is_user'], 'prefix'=>''], function(){
  Route::get('/userdashboard', 'User\UserController@index')->name('userdashboard');
});

/**
 * Customer Dashboard
*/

/**
 * Customer Center
*/
Route::group(['prefix'=>'customer'], function () {
  Route::get('customer-information', 'CustomerController@index')->name('customer-information');
  Route::get('customer-address', 'CustomerController@customer_address')->name('customer-address');
  Route::get('contact-detail', 'CustomerController@contact_detail')->name('contact-detail');
  Route::get('customer-contact-person', 'CustomerController@customer_contact_person')->name('customer-contact-person');
  Route::get('customer-registration', 'CustomerController@customerRegistration');
  Route::resource('maintain-customer-information', 'Customer\CustomerInformationController');
  Route::resource('maintain-customer-address', 'Customer\CustomerAddressController');
  Route::resource('maintain-customer-contacts', 'Customer\CustomerContactsController');
  //Route::resource('maintain-customer-contactperson', 'Customer\CustomerContactPersonController');
  Route::get('get-customer/{cus_id}', 'Customer\CustomerInformationController@getCustomer');
  Route::get('customer-bank-detail', 'CustomerController@customerBankDetail');
});
/**
 * Inventory Center
*/
Route::get('add-inventory', 'InventoryController@index')->name('add-inventory');
Route::get('get-inventory/{offset}/{limit}', 'InventoryController@getInventory');
Route::get('get-inventory-info/{id}', 'InventoryController@editInventory');
Route::delete('delete-inventory/{id}', 'InventoryController@deleteInventory');
Route::get('search-inventory/{barcode}', 'InventoryController@searchInventory');
Route::post('save-inventory', 'InventoryController@saveInventory');
Route::get('view-inventory', 'InventoryController@view_inventory')->name('view-inventory');
Route::get('get-stock/{id}', 'InventoryController@getStock');
Route::get('get-pricing/{id}', 'InventoryController@getPricing');
Route::get('get-account/{id}', 'InventoryController@getAccount');
Route::get('get-vendor/{id}', 'InventoryController@getVendor');
Route::get('get-category/{id}', 'InventoryController@getCategory');
Route::get('get-attribute/{id}', 'InventoryController@getAttribute');
Route::get('get-selected-atts/{id}', 'InventoryController@selectedAttribute');
Route::get('get-seleted-taxes/{id}', 'InventoryController@seletedTaxes');
Route::get('edit-inventory/{id}', 'InventoryController@editAddInventory');

/**
 * Purchase Order Section
*/
Route::group(['prefix'=>'purchases'], function () {
  Route::get('add-purchase-order', 'PurchaseOrderController@index')->name('add-purchase-order');
  Route::post('save-purchase-order', 'PurchaseOrderController@savePurchaseOrder');
  Route::get('get-purchase-order-info', 'PurchaseOrderController@getpurchaseOrder');
  Route::get('edit-purchase-order/{id}', 'PurchaseOrderController@editPurchaseOrder');
  Route::get('edit-purchaseorder/{id}', 'PurchaseOrderController@edit');
  Route::get('edit_pro_info/{po_id}', 'PurchaseOrderController@editProductInfo');
  Route::delete('delete-purchase-order/{id}', 'PurchaseOrderController@destroy');
  Route::get('add-purchase-receive', 'PurchaseOrderController@add_purchase_receive')->name('add-purchase-order');
  Route::get('view-purchase-order', 'PurchaseOrderController@view_purchase_order')->name('view-purchase-order');
  Route::get('view-purchase-receive', 'PurchaseOrderController@view_purchase_receive')->name('view-purchase-receive');
  Route::get('get_pro_info/{pro_id}', 'InventoryController@getProductInfo');
  Route::get('quotation-purchases', 'Purchases\PurchaseQuotationController@index');
  Route::resource('manage-purchase-quotations', 'Purchases\PurchaseQuotationController');
  Route::get('recieve-inventory', function(){
    return view('receive-inventory');
  })->name('Recieve Inventory');

  Route::get('payment-voucher', function(){
    return view('payment-voucher');
  })->name('Payment Voucher Form');
});
/**
 * Quotation Section
*/
Route::get('add-quotation', 'QuotationController@index')->name('add-quotation');
Route::post('save-quotation-information', 'QuotationController@saveQuotation');
Route::get('get-quotation-information', 'QuotationController@getQuotations');
Route::get('edit-quotation/{id}', 'QuotationController@getEditQuotation');
Route::get('edit-quotation-information/{id}', 'QuotationController@getQuotation');
Route::delete('delete-quotation-information/{id}', 'QuotationController@deleteQuotation');
Route::get('view-quotations', 'QuotationController@view_quotations')->name('view-quotations');

/**
 * Sales Section
 */
Route::group(['prefix'=>'sales'], function(){
  Route::get('add-sales-order', 'SalesController@index')->name('add-sales-order');
  Route::get('view-sales-order', 'SalesController@view_sales_order')->name('view-sales-order');

  Route::get('receipt-voucher', function(){
    return view('sales/receipt-voucher');
  })->name('Receipt Voucher Form');

  Route::get('quotation-sale', function(){
    return view('sales/quotation-sale');
  })->name('Quotation For Sale');

  Route::get('sales-invoice',function(){
    return view('sales/sales-invoice');
  })->name('Sales Invoice');
});


/**
 * Logistics Section
 */
Route::group(['prefix'=>'sourcing'], function(){
  Route::get('freight-forward-det', 'LogisticsController@index')->name('freight-forward-det');
  Route::get('add-logistic', 'LogisticsController@index');
  Route::get('sourcing-bank-detail', 'LogisticsController@sourcingBankDetail');
  Route::post('save-logistic', 'LogisticsController@saveLogistic');
  Route::get('get-logistics/{company_id}', 'LogisticsController@getLogistics');
  Route::get('edit-logistic/{id}', 'LogisticsController@viewEdit');
  Route::get('edit-logistic-info/{id}', 'LogisticsController@editLogistic');
  Route::delete('delete-logistic/{id}', 'LogisticsController@destroy');
  Route::get('get-log-address/{address_id}', 'FreightForwardDetController@getAddress');
  Route::get('get-log-contact/{contact_id}', 'FreightForwardDetController@getContact');
  Route::get('get-log-social/{social_id}', 'FreightForwardDetController@getSocial');
  Route::get('view-logistic', 'LogisticsController@viewLogistics');
  Route::get('sourcing-contact-person', 'LogisticsController@sourcingContactPerson');
  Route::get('sourcing-registration', 'LogisticsController@sourcingRegistration');
  /* Route::resource('save-freightforward-det', 'FreightForwardDetController');
  Route::get('edit-ff-det/{id}', 'FreightForwardDetController@editFfdet');
  Route::get('get-ffdet-info/{id}', 'FreightForwardDetController@getFFDetInfo');
  Route::get('get-address/{address_id}', 'FreightForwardDetController@getAddress');
  Route::get('get-contact/{contact_id}', 'FreightForwardDetController@getContact');
  Route::get('get-social/{social_id}', 'FreightForwardDetController@getSocial'); */
});

/* Route::resource('save-cus-clearance', 'CustomerClearanceController');
Route::get('edit-cus-clearance/{id}', 'CustomerClearanceController@editCusClearance');
Route::get('get-cusclearance-info/{id}', 'CustomerClearanceController@getCusClearanceInfo');
Route::get('get-cus-address/{address_id}', 'CustomerClearanceController@getAddress');
Route::get('get-cus-contact/{contact_id}', 'CustomerClearanceController@getContact');
Route::get('get-cus-social/{social_id}', 'CustomerClearanceController@getSocial');

Route::resource('save-car-company', 'CustomerClearanceController');
Route::get('edit-car-company/{id}', 'CustomerClearanceController@editCusClearance');
Route::get('get-cuscompany-info/{id}', 'CustomerClearanceController@getCusClearanceInfo');
Route::get('get-car-address/{address_id}', 'CustomerClearanceController@getAddress');
Route::get('get-car-contact/{contact_id}', 'CustomerClearanceController@getContact');
Route::get('get-car-social/{social_id}', 'CustomerClearanceController@getSocial');
Route::get('customer-clearance', 'LogisticsController@customer_clearance')->name('customer-clearance');
Route::get('carriage-company', 'LogisticsController@carriage_company')->name('carriage-company');
Route::get('viewfreightforwarddet', 'LogisticsController@view_freight_forward_det')->name('view-freight-forward-det');
Route::get('viewcustomerclearance', 'LogisticsController@view_customer_clearance')->name('view-customer-clearance');
Route::get('viewcarriagecompany', 'LogisticsController@view_carriage_company')->name('view-carriage-company'); */

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

Route::group(['middleware' => ['auth:web','is_admin'], 'prefix'=>'admin'], function(){
  
});
Route::get('get-tiers/{user_id}/{tiers}', 'Globall\RegisterAdminController@getUserTires');
Route::get('get-modules-forms/{user_id}/{tiers}', 'Globall\RegisterAdminController@getUserModuleForms');

Route::group(['middleware' => ['auth:web','super_admin'], 'prefix'=>'superadmin'], function(){
  Route::get('superadmin', 'HomeController@superadmin')->name('superadmin');
  Route::get('create-chart-account', 'Admin\FinanceController@defineAccount');
  Route::get('getAccountCategories/{id}', 'Globall\CategoriesController@getAccountCategories');
  //Route::get('create-sidebar-menu', 'Globall\SidebarMenuController@index');
  Route::resource('create-sidebar-menu', 'Globall\SidebarMenuController');
  Route::resource('regiter-admin', 'Globall\RegisterAdminController');
  Route::get('get-sidebar-menu', 'Globall\RegisterAdminController@get_sidebar_menu');  
  Route::get('get-user-sidebar-menus/{user_id}/{menu}', 'Globall\RegisterAdminController@getUserSidebarMenus');
  Route::get('get-users', 'Globall\RegisterAdminController@get_users');
});

Route::get('create-chart-account', 'Admin\FinanceController@defineAccount');
Route::get('getAccountCategories/{id}', 'Globall\CategoriesController@getAccountCategories');
Route::get('get-sidebar-menu-subuser', 'Globall\RegisterAdminController@get_sidebar_menu');




/**
 * Sub Admin Routes
 */
Route::get('categories', 'Admin\CategoryController@index')->name('categories')->middleware('is_admin');
Route::get('get_categories/{category_id}', 'Admin\CategoryController@get_categories')->name('allcategories')->middleware('is_admin');
Route::get('get-categorywithitsparents/{parent_id}', 'Admin\CategoryController@get_categorywithitsparents')->name('get-categorywithitsparents');
Route::get('delete_category/{category_id}', 'Admin\CategoryController@delete_category')->name('deletecategories')->middleware('is_admin');
Route::post('save_category', 'Admin\CategoryController@save_category')->name('savecategories')->middleware('is_admin');
Route::get('product-categories', 'Admin\CategoryController@getCategory');

Route::resource('maintain-attribute-values','Admin\AttributeValuesController');
Route::get('attribute_value','Admin\AttributeValuesController@attributeValueView');

Route::get('attributes', 'Admin\AttributeController@attributesView');
Route::resource('maintain-attributes','Admin\AttributeController');
Route::get('get-attributes/{category_id}','Admin\AttributeController@getAttributes');
Route::get('get-attr-values/{category_id}', 'Admin\AttributeController@getAttrValues');



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
//Route::group(['middleware' => ['auth:web','is_admin'], 'prefix'=>'company'], function () {
Route::group(['prefix'=>'company'], function () {
  Route::resource('designation-form', 'company\DesignationController');
  Route::get('get-employee-group/{dept_id}', 'company\DesignationController@get_employee_group');
  Route::get('company-profile', 'CompanyProfileController@index')->name('companyProfile')->middleware('is_admin');
  Route::get('company-address', 'CompanyProfileController@comAddressView');
  Route::get('authorty-lists', 'CompanyProfileController@authortyLists');
  Route::get('authority-contact-person', 'CompanyProfileController@authorityContactPerson');
  Route::get('company-contact', 'CompanyProfileController@comContactView');
  Route::get('company-bankdetail', 'CompanyProfileController@comBankDetailView');
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
  Route::resource('office-settings' , 'Admin\OfficeController');
  Route::get('getoffice/{company_id}' , 'Admin\OfficeController@getoffice');
  Route::resource('maintain-company', 'Admin\CompanyProfileController');
  Route::resource('maintain-company-address', 'Admin\CompanyAddressController');
  Route::resource('maintain-company-contact', 'Admin\CompanyContactController');
  Route::resource('maintain-company-bankdetail', 'Admin\ComBankDetailController');
  Route::get('company-departments', 'Admin\DepartmentsController@index')->name('departments')->middleware('is_admin');
  Route::post('SaveDepartment', 'Admin\DepartmentsController@SaveDepartment')->name('SaveDepartment')->middleware('is_admin');
  Route::get('getdepartments', 'Admin\DepartmentsController@getdepartments')->name('getdepartments')->middleware('is_admin');
  Route::get('getdeps', 'Admin\DepartmentsController@getDepts');
  Route::get('delete-department/{deptid}', 'Admin\DepartmentsController@delete_department')->name('delete-department')->middleware('is_admin');
  Route::get('getonedept/{deptid}', 'Admin\DepartmentsController@getonedept')->name('delete-department')->middleware('is_admin');
  
  //Company Celander Routes
  Route::get('get-calendar/{dept_id}', 'company\CompanyCalenderController@get_calendar')->middleware('is_admin');
  Route::get('edit-calendar/{dept_id}', 'company\CompanyCalenderController@edit_calendar');
  Route::resource('maintain-calender', 'company\CompanyCalenderController')->middleware('is_admin');
  Route::get('get-departments/{office_id}', 'company\CompanyCalenderController@get_departments')->middleware('is_admin');
  
  Route::get('company-shift', 'Admin\CompanyShiftController@company_shift')->middleware('is_admin');
  Route::get('get-shift/{dept_id}', 'Admin\CompanyShiftController@get_shift')->middleware('is_admin');
  Route::get('edit-shift/{dept_id}', 'Admin\CompanyShiftController@edit_shift');
  Route::resource('maintain-shift', 'Admin\CompanyShiftController');
  Route::get('get-groups/{dep_id}', 'Admin\EmployeeGroupController@getGroups');
  Route::get('gazzeted-holiday', 'Admin\GazzetedHolidayController@gazzeted_holiday');
  Route::get('yearly-leave', 'Admin\YearlyLeaveController@yearly_leave');
  Route::get('company-bank-detail', 'Admin\CompaniesController@bank_detail');
  Route::get('company-contact-person', 'Admin\CompaniesController@companyContactPerson');
  Route::resource('maintain-allowance-deducation', 'Admin\PayAllowanceDeductionController');
  Route::resource('maintain-group', 'Admin\EmployeeGroupController');
  Route::resource('maintain-payscale', 'Admin\PayScaleController');
  Route::resource('maintain-jds', 'Admin\EmployeeJDController');
  Route::resource('maintain-holiday', 'Admin\GazzetedHolidayController');
  Route::resource('maintain-leaves', 'Admin\YearlyLeaveController');
  Route::get('add-company-users', 'Globall\RegisterAdminController@add_company_users');
  Route::post('regiter-subuser', 'Globall\RegisterAdminController@regiter_subuser');
  Route::post('remove-subuser-menu', 'Globall\RegisterAdminController@remove_subuser_menu');
  Route::get('get-subuser-sidebar-menus/{user_id}/{menu}', 'Globall\RegisterAdminController@getUserSidebarMenus');
});


Route::group(['prefix'=>'project-system'], function(){
  Route::resource('create-projects', 'ProjectSystem\CreateProjectsController');
  Route::resource('create-phases', 'ProjectSystem\CreatePhasesController');
  Route::resource('create-tasks', 'ProjectSystem\CreateTasksController');
  Route::resource('create-activities', 'ProjectSystem\CreateActivitiesControllerr');
  Route::resource('assign-task', 'ProjectSystem\AssignTasksController');
  Route::get('view-assigned-task', 'ProjectSystem\AssignTasksController@view_assigned_tasks');
  Route::get('get-department-office/{group_id}', 'ProjectSystem\AssignTasksController@get_department_office');
  Route::get('get-project-activities/{project_id}/{company_id}', 'ProjectSystem\CreateActivitiesControllerr@get_project_activities');
  Route::get('get-activity-phases/{activity_id}/{company_id}', 'ProjectSystem\CreatePhasesController@get_activity_phases');
  Route::get('get-phases-tasks/{task_id}/{company_id}', 'ProjectSystem\CreateTasksController@get_phases_tasks');
});

/**
 * Tender Module Routes
 */
Route::group(['prefix'=>'tender'], function(){
  Route::resource('tender-information', 'Tender\TenderController');
  Route::resource('create-phases', 'ProjectSystem\CreatePhasesController');
  Route::resource('create-tasks', 'ProjectSystem\CreateTasksController');
  Route::resource('create-activities', 'ProjectSystem\CreateActivitiesControllerr');
  Route::resource('assign-task', 'ProjectSystem\AssignTasksController');
  Route::get('view-assigned-task', 'ProjectSystem\AssignTasksController@view_assigned_tasks');
  Route::get('get-department-office/{group_id}', 'ProjectSystem\AssignTasksController@get_department_office');
  Route::get('get-project-activities/{project_id}/{company_id}', 'ProjectSystem\CreateActivitiesControllerr@get_project_activities');
  Route::get('get-activity-phases/{activity_id}/{company_id}', 'ProjectSystem\CreatePhasesController@get_activity_phases');
  Route::get('get-phases-tasks/{task_id}/{company_id}', 'ProjectSystem\CreateTasksController@get_phases_tasks');

  Route::get('add-tender', function(){
    return view('tender/add-tender');
  })->name('Add Tender');

  Route::get('view-tender', function(){
    return view('tender/view-tender');
  })->name('View Tender');

  Route::get('requestion', 'Tender\RequestionController@index')->name('Requestion');
  Route::resource('maintain-requestion', 'Tender\RequestionController');
});

/**
 * Company portfolio
 */
Route::get('company-portfolio', 'CompanyPortfolioController@index')->name('companyportfolio')->middleware('is_vendor');
Route::get('delete_portfolio_image/{image_id}', 'CompanyPortfolioController@delete_portfolio_image')->name('delete_portfolio_image')->middleware('is_vendor');
Route::get('getcompanyportfolio', 'CompanyPortfolioController@getcompanyportfolio')->name('getcompanyportfolio')->middleware('is_vendor');
Route::get('edit_portfolio_image/{portfolio_id}', 'CompanyPortfolioController@edit_portfolio_image')->name('edit_portfolio_image')->middleware('is_vendor');
Route::post('SaveCompanyPortfolio', 'CompanyPortfolioController@SaveCompanyPortfolio')->name('SaveCompanyPortfolio')->middleware('is_vendor');

Route::resource('manage-banks', 'ActorBankController');
Route::get('get-bank-info/{actor}', 'ActorBankController@getBankInfo');

Route::resource('manage-contactperson', 'ActorContactPersonController');
Route::get('get-company-info/{actor}/{company_id}', 'ActorContactPersonController@getCompanyInfo');


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

Route::get('user-chart-account', 'Admin\FinanceController@defineUserAccount');

//Get categories on user chart of account page
Route::get('get-account-categories', 'Globall\CategoriesController@get_account_categories');

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
Route::get('income-statement', 'Admin\FinanceReportController@income_statement');
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

Route::get('aprovalwork-flow', function(){
  return view('aprovalwork-flow');
})->name('Approvalform');

Route::get('approval-authrity-list', function(){
  return view('approval-authrity-list');
})->name('Approval Authrity List');

Route::get('destination-form', function(){
  return view('destination-form');
})->name('Destination Form');

Route::get('quotation-for-purchases', function(){
  return view('quotation-for-purchases');
})->name('Quotation For Purchases');

Route::get('apply-leave-form', function(){
  return view('apply-leave-form');
})->name('Apply Leave Form');