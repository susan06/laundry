<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('panel', 'Auth\LoginController@getPanel')->name('panel');
    Route::get('logout', 'Auth\LoginController@getLogout')->name('auth.logout');
    Route::post('authenticate/client', 'Auth\LoginController@authenticate_client');
    Route::post('authenticate/administration', 'Auth\LoginController@authenticate_administration');
    Route::post('registration', 'Auth\RegisterController@registration');
    Route::get('register/confirmation/{token}', 'Auth\LoginController@confirmEmail')->name('confirm.email');

    Auth::routes();

    Route::get('/home', 'HomeController@index');

    /**
     * Setting of system
    */
    Route::group([
         'prefix' => 'setting'
     ], function () {

        Route::get('/administration',
            'SettingController@administration')
            ->name('setting.administration');

     	Route::get('/conditions_and_privacy',
     		'SettingController@conditions_and_privacy')
    		->name('setting.conditions_and_privacy');

        Route::get('/working_hours',
            'SettingController@working_hours')
            ->name('setting.working.hours');

        Route::post('/working_hours/update',
            'SettingController@working_hours_update')
            ->name('setting.update.working.hours');

        Route::post('/update',
            'SettingController@update')
            ->name('setting.update');

     });

    /**
     * Adminitrations of Users
    */
    Route::get('user/clients', 'UserController@client_index')->name('admin.client.index');
    Route::get('user/drivers', 'UserController@driver_index')->name('admin.driver.index');
    Route::resource('user', 'UserController');

    /**
     *  Adminitrations of Roles
    */
    Route::resource('role', 'RoleController');/**
    
    /**
    *  Profile
    */
    Route::resource('profile', 'ProfileController');

    /**
     * Coupons administrations
    */
    Route::get('coupon/clients', 'CouponController@clients')->name('coupon.clients');
    Route::resource('coupon', 'CouponController');

    /**
     * Branch offices administrations
    */
    Route::resource('admin-branch-office', 'Admin\BranchOfficeController');

    /**
     * Clients administrations
    */
    Route::resource('admin-client', 'Admin\clientController');
    
    /**
     * Branch offices administrations
    */ 
    Route::get('branch-office/{id}/services', 'BranchOfficeController@services')->name('branch-office.services');
    Route::resource('branch-office', 'BranchOfficeController');

    /**
     * Clients
    */
    Route::resource('client', 'ClientController');

    /**
     * Driver
    */
    Route::resource('driver', 'DriverController');

    /**
     * Faqs 
    */
    Route::resource('faq', 'FaqController');

    /**
     * Services
    */
    Route::resource('service', 'ServiceController');

    /**
     * Orders
    */
    Route::resource('orders', 'OrderController');

    /**
     * packages administrations
    */
    Route::get('admin-package/categories', 'Admin\PackageController@categories_index')->name('admin-package.categories.index');
    Route::resource('admin-package', 'Admin\PackageController');

    /**
     * packages
    */
    Route::get('package/show/category', 'PackageController@show_by_category')->name('package.show.category');
    Route::get('package/details', 'PackageController@details')->name('package.get.details');
    Route::resource('package', 'PackageController');

    /************************************rutas que mas adelante se deben eliminar ************/

    /**
     * Request Services
    */
    Route::get('services', [
        'as' => 'client.services',
        'uses' => 'ClientController@requestServices'
    ]);

    /**
     * Terms and Conditions
    */
    Route::get('terms', [
        'as' => 'client.terms',
        'uses' => 'ClientController@termsAndConditions'
    ]);

    /**
     * Client Orders
    */
    Route::get('ordersClient', [
        'as' => 'client.orders',
        'uses' => 'ClientController@myOrders'
    ]);

    /**
     * My Profile
    */
    Route::get('profileClient', [
        'as' => 'client.profile',
        'uses' => 'ClientController@myProfile'
    ]);

    /**
     * Frequent Questions
    */
    Route::get('questions', [
        'as' => 'client.questions',
        'uses' => 'ClientController@frequentQuestions'
    ]);

    /**
     * Privacy Policies
    */
    Route::get('privacy', [
        'as' => 'client.privacy',
        'uses' => 'ClientController@privacyPolicies'
    ]);

    /**
     * Invit a Friend
    */
    Route::get('invite', [
        'as' => 'client.invite',
        'uses' => 'ClientController@inviteFriend'
    ]);

    /**
     * My Itinerary
    */
    Route::get('itinerary', [
        'as' => 'driver.itinerary',
        'uses' => 'DriverController@myItinerary'
    ]);

    /**
     * See Order - Driver
    */
    Route::get('ordersDriver', [
        'as' => 'driver.order',
        'uses' => 'DriverController@seeOrder'
    ]);

    /**
     * See Order - Driver
    */
    
    
