<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::get('/handle-payment', 'App\Http\Controllers\PaypalPaymentController@handlePayment')->name('make.payment');
Route::get('cancel-payment', 'App\Http\Controllers\PaypalPaymentController@paymentCancel')->name('cancel.payment');
Route::get('payment-success', 'App\Http\Controllers\PaypalPaymentController@paymentSuccess')->name('success.payment');