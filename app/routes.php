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
| Pages
|------------------------
*/

Route::get('/about', array(
    'as' => 'about',
    'uses' => 'HomeController@about'
));

Route::get('/feedback', array(
    'as' => 'feedback',
    'uses' => 'HomeController@feedback'
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

Route::get('/country/{country}', array(
        'as' => 'country',
        'uses' => 'CountriesController@country'
));



/*
|------------------------
| Quizz
|------------------------
*/

Route::get('/quiz', array(
        'as' => 'quizz',
        'uses' => 'QuizController@getQuiz'
));

Route::post('/quiz', array(
        'as' => 'quizz-post',
        'uses' => 'QuizController@postQuiz'
));

Route::get('/quiz/new/{number_of_questions}', array(
        'as' => 'quizz-new',
        'uses' => 'QuizController@generateQuiz'
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

        /*
        | Send feedback (POST)
        */
        Route::post('/feedback', array(
            'as' => 'feedback-post', 
            'uses' => 'HomeController@postFeedback'
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

    /*
    | Quiz History (GET)
    */
    Route::get('/account/quizz-history', array(
        'as' => 'quizz-history',
        'uses' => 'QuizController@getQuizzHistory'
    ));

});