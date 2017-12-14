<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//
//Routes for not logged user
//
Route::get('/home', [
   'uses' => 'BaseController@getHome',
    'as' => 'home'
]);

Route::get('/classes/{classCode?}', [
    'uses' => 'BaseController@getClasses',
    'as' => 'classes'
]);

Route::get('/login', [
   'uses' => 'BaseController@getLogin',
    'as' => 'login'
]);

Route::post('/login', [
   'uses' => 'BaseController@postLogin',
    'as' => 'login'
]);

Route::get('/logout',[
   'uses' => 'BaseController@getLogout',
    'as' => 'logout'
]);

Route::get('/register', [
   'uses' => 'BaseController@getRegister',
    'as' => 'register'
]);

Route::post('/register', [
   'uses' => 'BaseController@postRegister',
    'as' => 'register'
]);

//
//Student routes
//

Route::group(['middleware' => 'App\Http\Middleware\StudentMiddleware'], function () {

    Route::get('/student/home/{classCode?}', [
        'uses' => 'StudentController@getHome',
        'as' => 'student.home'
    ]);

    Route::post('/student/home/{classCode?}', [
        'uses' => 'StudentController@saveChanges',
        'as' => 'student.save'
    ]);

    Route::get('/student/classes', [
       'uses' => 'StudentController@getClasses',
        'as' => 'student.classes'
    ]);

    Route::post('/student/classes', [
       'uses' => 'StudentController@postClasses',
        'as' => 'student.classes'
    ]);
});

//
//Mentor routes
//

Route::group(['middleware' => 'App\Http\Middleware\MentorMiddleware'], function () {

    Route::get('/mentor/home', [
        'uses' => 'MentorController@getHome',
        'as' => 'mentor.home'
    ]);

    Route::get('/mentor/classes/{class?}', [
        'uses' => 'MentorController@getClasses',
        'as' => 'mentor.classes'
    ]);

    Route::post('/mentor/classes/{class?}', [
        'uses' => 'MentorController@postClasses',
        'as' => 'mentor.classes'
    ]);

    Route::get('/mentor/students/{student?}', [
        'uses' => 'MentorController@getStudents',
        'as' => 'mentor.students'
    ]);

    Route::post('/mentor/students/{student?}', [
        'uses' => 'MentorController@postStudents',
        'as' => 'mentor.students'
    ]);

});

//
//Admin routes
//

Route::get('/admin/login', [
    'uses' => 'AdminController@getLogin',
    'as' => 'admin.login'
]);

Route::post('/admin/login', [
    'uses' => 'AdminController@postLogin',
    'as' => 'admin.login'
]);

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function () {

    Route::get('/admin/dashboard', [
        'uses' => 'AdminController@getDashboard',
        'middleware' => 'auth',
        'as' => 'admin.dashboard'
    ]);

    Route::get('/admin/logout', [
        'uses' => 'AdminController@getLogout',
        'as' => 'admin.logout'
    ]);

    Route::post('/admin/dashboard', [
        'uses' => 'AdminController@saveChanges',
        'middleware' => 'auth',
        'as' => 'admin.save'
    ]);
});
