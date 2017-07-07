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

Route::get('/', 'HomeController@index');

Route::get('index', array('as'=>'index', 'uses'=>'HomeController@index'));
Route::get('terms', array('as'=>'terms', 'uses'=>'HomeController@terms'));
Route::get('privacy', array('as'=>'privacy', 'uses'=>'HomeController@privacy'));
Route::get('contract', array('as'=>'contract', 'uses'=>'HomeController@contract'));

Route::post('userstore', array('as'=>'userstore', 'uses'=>'HomeController@userstore'));

Route::get('regis', array('as'=>'regis', 'uses'=>'HomeController@regis'));

Route::get('lang/{lang}', function ($lang) {
    session_start();
    $_SESSION['lang'] = $lang;
    return Redirect::back();
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
