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
/**
 * Client Zone
 */

Route::group(['namespace'=>'Client'], function() {
    Route::get('/gioi-thieu','HomeController@about');
    Route::get('gio-hang','CartController@index');
    Route::get('/gio-hang/thanh-toan','CartController@checkout');
    Route::get('/gio-hang/thanh-cong','CartController@complete');  
    Route::get('/lien-he','HomeController@contact');
    Route::get('/sanpham/{id}','ProductController@detail');
    Route::get('/','HomeController@index');
    Route::get('/san-pham','ProductController@shop');
});

/**
 * Admin Zone
 */
Route::group(['prefix' => 'admin','namespace'=>'Admin'], function () {

    
    Route::group(['middleware'=>'guest'], function() {
        Route::get('login','LoginController@showLoginForm');
        Route::post('login','LoginController@login');
       

    });
    
    Route::group(['middleware'=>'auth'], function() {
        Route::post('logout','LoginController@logout')->name('admin.logout');
        Route::get('/','DashboardController@index');
        Route::group(['prefix' => 'products'], function () {
            Route::get('/create','ProductController@create');
            Route::get('/','ProductController@index');
            Route::get('/{product}/edit','ProductController@edit');
         });
    
        // Admin User
        Route::group(['prefix' => 'users'], function() {
            Route::get('/create','UserController@create');
            Route::get('/{user}/edit','UserController@edit');
            Route::get('/','UserController@index');
        });
    
        // Admin Categories
        Route::group(['prefix' => 'categories'], function() {
            Route::get('/','CategoryController@index');
            Route::get('/{category}/edit','CategoryController@edit');
        });
      
        // Admin Order
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/','OrderController@index');
            Route::get('/{order}/edit','OrderController@edit');
            Route::get('/processed','OrderController@processed');
        });
    });
    
    
  
   

    // Admin Product
    

});
