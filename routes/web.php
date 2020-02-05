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

use App\Http\Controllers\AvatarController;

Route::get('/', 'DashboardController@redirect');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    // avatar
    Route::post('avatar', 'AvatarController@changeAvatar')->name('avatar.change');

    // notifications
    Route::get('/notifications', 'NotificationController@getNotification')->name('fetchNotifications');
    Route::post('/notifications', 'NotificationController@updateNotification')->name('updateNotifications');

    // attendance
    Route::resource('attendances', 'AttendanceController', ['except' => ['create','show','edit','update','destroy']]);

    // staff leave
    Route::resource('staff-leave', 'StaffLeaveController');
    Route::get('staff-leave-list', 'StaffLeaveController@list')->name('staff-leave.list');
    Route::get('ajax-data-staff-leave', 'Ajax\AjaxStaffLeaveController@getStaffLeave')->name('Ajax.getStaffLeave');

    // staff claim
    Route::resource('staff-claim', 'StaffClaimController');
    Route::get('ajax-data-staff-claim-all', 'Ajax\AjaxStaffClaimController@getStaffClaimAll')->name('Ajax.getStaffClaimAll');
    Route::get('ajax-data-staff-claim', 'Ajax\AjaxStaffClaimController@getStaffClaim')->name('Ajax.getStaffClaim');

    // staff advance
    Route::resource('staff-advance', 'StaffAdvanceController');

    /*************/
    // SETTINGS //
    /*************/

    // roles
    Route::resource('/roles', 'RolesController');

    // users
    Route::get('/user-request', 'UserController@activateUserPage')->name('user.activatepage');
    Route::patch('/activate-user/{user}', 'UserController@activateUser')->name('user.activate');
    Route::get('ajax-data-user', 'Ajax\AjaxUserController@getalluser')->name('Ajax.getalluser');
    Route::get('ajax-data-inactive-user', 'Ajax\AjaxUserController@getinactiveuser')->name('Ajax.getinactiveuser');

    // staff
    Route::resource('staff', 'StaffController');
    Route::get('ajax-data-staff', 'Ajax\AjaxStaffController@getStaff')->name('Ajax.getStaff');

    // client
    Route::resource('client', 'ClientController');
    Route::get('ajax-data-client', 'Ajax\AjaxClientController@getClient')->name('Ajax.getClient');
    Route::get('/client-list', 'ClientController@getUser')->name('client.user');
    Route::get('/client-user/{client}/edit', 'ClientController@editUser')->name('clientuser.edit');
    Route::put('/client-user/{client}', 'ClientController@updateUser')->name('clientuser.update');
    Route::delete('/client-user/{client}', 'ClientController@destroyUser')->name('clientuser.destroy');
    Route::get('ajax-data-client-user', 'Ajax\AjaxClientUserController@getClientUser')->name('Ajax.getClientUser');

    // company
    Route::resource('company', 'CompanyController');
});
