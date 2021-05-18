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

Route::get('get-categories/{category_id}', 'ApiController@get_categories');
Route::get('get-companyies/{category_id}', 'ApiController@get_companies');
Route::post('register_customer', 'ApiController@register_customer');
Route::post('login_customer', 'ApiController@login_customer');
Route::post('customer_query', 'ApiController@customer_query');
Route::post('save_rated', 'ApiController@save_rated');
Route::get('get-company-information/{company_id}', 'ApiController@get_complete_compnay_information');
Route::get('get-company-rateing/{company_id}', 'ApiController@get_company_rateing');

/**
 * Add Category Attributes
 */
Route::resource('maintain-attributes', 'Admin\AttributeController');
Route::resource('maintain-attribute-values', 'Admin\AttributeValuesController');
Route::get('product-categories', 'Admin\AttributeController@getCategory');
