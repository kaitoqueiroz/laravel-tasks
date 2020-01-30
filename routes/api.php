<?php

use Illuminate\Http\Request;
use App\Customer;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('customers', 'CustomersController@index');
Route::get('customers/show/{id}', 'CustomersController@show');
Route::get('orders', 'OrdersController@index');
Route::get('subscriptions', 'SubscriptionsController@index');
Route::get('deliveries', 'DeliveriesController@index');

Route::get('orders/create', 'OrdersController@create');
Route::put('orders/set-to-paid/{orderId}', 'OrdersController@setToPaid');
Route::get('deliveries/export-csv', 'DeliveriesController@exportCsv');

Route::put(
    'subscriptions/set-iteration-frequency',
    'SubscriptionsController@setIterationFrequency'
);
Route::get(
    'customers/last-paid-order',
    'CustomersController@allCustomersWithLastPaidOrder'
);
Route::get(
    'customers/more-than-one-paid-order',
    'CustomersController@allCustomersWithMoreThanOnePaidOrder'
);
Route::get(
    'customers/active-subscription-and-paid-order',
    'CustomersController@allCustomersWithActiveSubscriptionAndPaidOrder'
);
