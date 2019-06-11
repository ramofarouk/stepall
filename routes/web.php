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

Route::match(['get', 'post'], '/', 'UserController@login');
Route::match(['get', 'post'], '/login-user', 'UserController@login');
Route::match(['get', 'post'], '/register-user', 'UserController@register');
Route::match(['get', 'post'], '/forget-pwd', 'UserController@forget-pwd');
Route::match(['get', 'post'], '/verification', 'UserController@verification');
Route::get('/sms-test', 'UserController@smsTest');
Route::get('/logout', 'UserController@logout');
Route::group(['middleware' => ['auth']], function () {
    //Routes for Administrator
    Route::get('/admin','UserController@adminDashboard');
    Route::match(['get', 'post'], '/admin/change-password-admin', 'UserController@changePasswordAdmin');
    Route::match(['get', 'post'], '/admin/footer-message', 'UserController@footerMessage');
    Route::get('/admin/view-users', 'UserController@viewUsers');
    Route::get('/admin/view-messages', 'MessageController@viewAllMessages');

    //Routes for user information
    Route::get('/user', 'UserController@userDashboard');
    Route::match(['get', 'post'], '/user/change-password', 'UserController@changePassword');
    Route::match(['get', 'post'], '/user/my-profile', 'UserController@viewProfile');
    //Routes for contacts
    Route::match(['get', 'post'], '/user/add-contact', 'ContactController@addContact');
    Route::get('/user/view-contacts', 'ContactController@viewContacts');
    Route::match(['get', 'post'], '/user/edit-contact/{id}', 'ContactController@editContact');
    Route::match(['get', 'post'], '/user/delete-contact/{id}', 'ContactController@deleteContact');
    Route::get('/user/view-contacts/{id}', 'ContactController@contactDetails');
    //Routes for messages
    Route::match(['get', 'post'], '/user/send-message', 'MessageController@sendMessage');
    Route::get('/user/view-messages-receive', 'MessageController@viewMessagesReceive');
    Route::get('/user/view-messages-send', 'MessageController@viewMessagesSend');
    Route::get('/user/view-messages-favorite', 'MessageController@viewMessagesFavorite');
});

Auth::routes();
