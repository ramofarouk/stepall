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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('update', 'API\UserController@update');
Route::post('change-pwd', 'API\UserController@changePassword');
Route::post('verify', 'API\UserController@verify');
Route::post('add-contact', 'API\ContactController@addContact');
Route::post('list-contacts', 'API\ContactController@listContacts');
Route::post('view-contacts', 'API\ContactController@viewContacts');
Route::post('view-messages', 'API\MessageController@viewMessages');
Route::post('add-contact-email', 'API\ContactController@addContactEmail');
Route::post('add-contact-phone', 'API\ContactController@addContactPhone');
Route::post('send-message', 'API\MessageController@sendMessage');
Route::post('send-message-old', 'API\MessageController@sendMessageOld');
Route::post('send-message-other', 'API\MessageController@sendMessageOther');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\UserController@details');
});
