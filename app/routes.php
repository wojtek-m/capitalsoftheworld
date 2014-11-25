<?php

/*
|------------------------
| Home
|------------------------
*/

Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@home'
));

/*
|------------------------
| User profiles
|------------------------
*/

Route::get('/user/{username}', array(
    'as' => 'profile-user',
    'uses' => 'ProfileController@user'
));

/*
|------------------------
| Countries data display
|------------------------
*/


Route::get('countries/{continent}', array(
        'as' => 'countries-list',
        'uses' => 'CountriesController@continent'
));


/*
|------------------------
| Quizz
|------------------------
*/

Route::get('/quizz', array(
        'as' => 'quizz',
        'uses' => 'QuizzController@getQuizz'
));

Route::post('/quizz', array(
        'as' => 'quizz-post',
        'uses' => 'QuizzController@postQuizz'
));

Route::get('/quizz/new', array(
        'as' => 'quizz-new',
        'uses' => 'QuizzController@generateQuizz'
));

/*
|------------------------
| Unauthenticated group
|------------------------
*/
Route::group(array('before' => 'guest'), function() {

    /*
    | CSRF protection group
    */
    Route::group(array('before' => 'csrf'), function() {

        /*
        | Create account (POST)
        */
        Route::post('/account/create', array(
            'as' => 'account-create-post', 
            'uses' => 'AccountController@postCreate'
        ));

        /*
        | Sign in (POST)
        */
        Route::post('/account/sign-in', array(
            'as' => 'account-sign-in-post',
            'uses' => 'AccountController@postSignIn'
        ));

        /*
        | Forgot password (POST)
        */
        Route::post('/account/forgot-password', array(
            'as' => 'account-forgot-password-post',
            'uses' => 'AccountController@postForgotPassword'
        ));


    });

    /*
    | Forgot password (GET)
    */
    Route::get('/account/forgot-password', array(
        'as' => 'account-forgot-password',
        'uses' => 'AccountController@getForgotPassword'
    ));

    Route::get('/account/recover/{code}', array(
        'as' => 'account-recover',
        'uses' => 'AccountController@getRecover'
    ));


    /*
    | Create account (GET)
    */
    Route::get('/account/create', array(
        'as' => 'account-create', 
        'uses' => 'AccountController@getCreate'
    ));

    /*
    | Sign in (GET)
    */
    Route::get('/account/sign-in', array(
        'as' => 'account-sign-in',
        'uses' => 'AccountController@getSignIn'
    ));

    /*
    | Activate account
    */
    Route::get('/account/activate/{code}', array(
        'as' => 'account-activate',
        'uses' => 'AccountController@getActivate'
    ));

});


/*
|------------------------
| Authenticated group
|------------------------
*/

Route::group(array('before' => 'auth'), function() {

    /*
    | CSRF protection group
    */
    Route::group(array('before' => 'csrf'), function() {

        /*
        | Change password (POST)
        */
        Route::post('/account/change-password', array(
            'as' => 'account-change-password-post',
            'uses' => 'AccountController@postChangePassword'
        ));
    });

    /*
    | Change password (GET)
    */
    Route::get('/account/change-password', array(
        'as' => 'account-change-password',
        'uses' => 'AccountController@getChangePassword'
    ));

    /*
    | Sign out (GET)
    */
    Route::get('/account/sign-out', array(
        'as' => 'account-sign-out',
        'uses' => 'AccountController@getSignOut'
    ));

});