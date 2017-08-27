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
Route::get('surveys/{id}/survey', 'SurveysController@survey');
Route::get('surveys/surveyFinish', 'SurveysController@surveyFinish');
Route::get('surveys/{id}/shared', array('as' => 'shared', 'uses' => 'SurveysController@shared') );
Route::resource('answers', 'AnswersController');

Route::post('userstore', array('as'=>'userstore', 'uses'=>'HomeController@userstore'));

Route::get('regis', array('as'=>'regis', 'uses'=>'HomeController@regis'));
Route::get('logi', array('as'=>'logi', 'uses'=>'HomeController@login'));

Route::post('saveuser', array('as'=>'saveuser', 'uses'=>'HomeController@saveuser'));
Route::get('getDone', ['as'=>'getDone','uses'=>'HomeController@getDone']);
Route::get('getCancel', ['as'=>'getCancel','uses'=>'HomeController@getCancel']);

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
        Route::get('admin', array('as'=>'admin', 'uses'=>'HomeController@admin'));
        Route::resource('user', 'UserController');
        Route::get('user/{id}/profile', array('as'=>'profile', 'uses'=>'UserController@profile'));
        Route::get('user/{id}/editpass', array('as'=>'editpass', 'uses'=>'UserController@editpass'));
        Route::get('user/{id}/updatepass', array('as'=>'updatepass', 'uses'=>'UserController@updatepass'));

        Route::resource('questions', 'QuestionsController');
        Route::resource('surveys', 'SurveysController');
        Route::resource('surveys_questions', 'Surveys_QuestionsController');
        Route::resource('answersdetails', 'AnswersDetailsController');
        Route::resource('socialnetworks', 'SocialNetworksController');
       

        Route::get('surveys/{id}/questions', array('as'=>'surques', 'uses'=>'SurveysController@questions'));
        Route::get('surveys/{id}/links', array('as'=>'links', 'uses'=>'SurveysController@links'));
        Route::get('surveys/{id}/answers', array('as'=>'suranswers', 'uses'=>'SurveysController@suranswers'));
        Route::get('surveys/{id}/fliers', array('as'=>'fliers', 'uses'=>'SurveysController@fliers'));
        Route::get('surveys/{id}/flierpdf', array('as'=>'flierpdf', 'uses'=>'SurveysController@flierpdf'));

        Route::get('surveys/{id}/graphpdf', array('as'=>'graphpdf', 'uses'=>'SurveysController@graphsQuestionsPDF'));
        
        //Estadisticas
        Route::get('surveys/{id}/pregraphs', array('as'=>'pregraphs', 'uses'=>'SurveysController@pregraphs'));
        Route::get('surveys/{id}/graphsQuestions', array('as'=>'graphsQuestions', 'uses'=>'SurveysController@graphsQuestions'));
        Route::get('surveys/{id}/graphsSatisfaction', array('as'=>'graphsSatisfaction', 'uses'=>'SurveysController@graphsSatisfaction'));
        Route::put('surveys/{id}/graphsDateQuestions', array('as'=>'graphsDateQuestions', 'uses'=>'SurveysController@graphsDateQuestions'));
        Route::put('surveys/{id}/graphsDateSatisfaction', array('as'=>'graphsDateSatisfaction', 'uses'=>'SurveysController@graphsDateSatisfaction'));
        Route::get('surveys/{id}/pretrends', array('as'=>'pretrends', 'uses'=>'SurveysController@pretrends'));
        Route::get('surveys/{id}/trendsQuestions', array('as'=>'trendsQuestions', 'uses'=>'SurveysController@trendsQuestions'));
        Route::get('surveys/{id}/trendsSatisfaction', array('as'=>'trendsSatisfaction', 'uses'=>'SurveysController@trendsSatisfaction'));
        Route::put('surveys/{id}/trendsDateQuestions', array('as'=>'trendsDateQuestions', 'uses'=>'SurveysController@trendsDateQuestions'));
        Route::put('surveys/{id}/trendsDateSatisfaction', array('as'=>'trendsDateSatisfaction', 'uses'=>'SurveysController@trendsDateSatisfaction'));

        Route::get('surveys/{id}/up', array('as'=>'up', 'uses'=>'Surveys_QuestionsController@up'));
        Route::get('surveys/{id}/down', array('as'=>'down', 'uses'=>'Surveys_QuestionsController@down'));

        Route::get('surveys/{id}/fullUp', array('as'=>'fullUp', 'uses'=>'Surveys_QuestionsController@fullUp'));
        Route::get('surveys/{id}/fullDown', array('as'=>'fullDown', 'uses'=>'Surveys_QuestionsController@fullDown'));

        Route::get('questions/{id}/enable', array('as'=>'enable', 'uses'=>'QuestionsController@enable'));
        Route::get('questions/{id}/disable', array('as'=>'disable', 'uses'=>'QuestionsController@disable'));

        Route::get('renew', array('as'=>'renew', 'uses'=>'UserController@renew'));
        Route::post('renewpaypal', array('as'=>'renewpaypal', 'uses'=>'UserController@renewpaypal'));
        Route::get('renewmoney', array('as'=>'renewmoney', 'uses'=>'UserController@renewmoney'));
        Route::get('getDoneR', ['as'=>'getDoneR','uses'=>'UserController@getDoneR']);
        Route::get('getCancelR', ['as'=>'getCancelR','uses'=>'UserController@getCancelR']);

        Route::get('back', array('as'=>'back', 'uses'=>'SurveysController@back'));

        Route::get('logout', function()
        {
            Auth::logout();
            Session::flush();
            return Redirect::to('/');
        });

    });

    Route::group(['middleware' => ['role:Administrador']], function() {
        Route::resource('users', 'UserController');
        Route::get('users/{id}/validate', array('as'=>'uservalidate', 'uses'=>'UserController@validateu'));
        Route::put('users/{id}/active', array('as'=>'useractive', 'uses'=>'UserController@active'));
    });


