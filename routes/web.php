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



Route::get('test', function (){
});

Route::get('/', 'Auth\LoginController@showLoginForm');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

//// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');
//
//// Password Reset Routes...
//$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//$this->post('password/reset', 'Auth\ResetPasswordController@reset');





Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('recharge', 'RechargeController@showRechargePage')->name('recharge');
    Route::post('recharge', 'RechargeController@recharge');
    Route::get('call-back', 'RechargeController@callBack');

    Route::get('account', 'AccountController@showAccountPage')->name('account');
    Route::post('account/count-money', 'AccountController@getTotalCountAndTotalBorrowMoney');
    Route::get('debt', 'DebtController@showDebtPage')->name('debt');
    Route::get('debt/{id}', 'DebtController@detail');
    Route::get('debt/plan/{id}', 'DebtController@plan');
});
