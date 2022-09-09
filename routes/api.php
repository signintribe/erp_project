<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Auth::routes();
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Auth::routes();

Route::get('get-categories/{category_id}', 'ApiController@get_categories');
Route::get('get-companyies/{category_id}', 'ApiController@get_companies');
Route::post('register_customer', 'ApiController@register_customer');
Route::post('login_customer', 'ApiController@login_customer');
Route::post('customer_query', 'ApiController@customer_query');
Route::post('save_rated', 'ApiController@save_rated');
Route::get('get-company-information/{company_id}', 'ApiController@get_complete_compnay_information');
Route::get('get-company-rateing/{company_id}', 'ApiController@get_company_rateing');
Route::resource('maintain-jd', 'Admin\EmployeeJDController');


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
 * Add Category Attributes
 */