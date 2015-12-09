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

Route::controllers(
    [
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]
);

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(
    [

        'prefix' => '/'

    ],
    function()
    {

        Route::get( '/', 'WelcomeController@index' );

        Route::get( '/home', 'HomeController@index' );

        Route::resource( 'anime', 'AnimeController' );

        Route::get(
            'anime/{anime}/watch',
            [
                'as' => 'anime.watch',
                'uses' => 'AnimeController@watch'
            ]
        );

        Route::get(
            'user/{user}/changePassword',
            [
                'as' => 'user.changePassword',
                'uses' => 'UserController@changePassword'
            ]
        );

        Route::patch(
            'user/{user}/changePassword',
            [
                'as' => 'user.updatePassword',
                'uses' => 'UserController@updatePassword'
            ]
        );

        Route::get(
            //This is the url.  It would be localhost:8080/user/{the user whose page you are on}/follow
            'user/{user}/follow',
            [
                'as' => 'user.follow',
                'uses' => 'UserController@follow'
            ]
        );

        Route::get(
            'user/{user}/unfollow',
            [
                'as' => 'user.unfollow',
                'uses' => 'UserController@unfollow'
            ]
        );

        Route::get(
            'user/{user}/followAnimes',
            [
                'as' => 'user.followAnimes',
                'uses' => 'UserController@followAnimes'
            ]
        );

        Route::get(
            'user/{user}/unfollowAnimes',
            [
                'as' => 'user.unfollowAnimes',
                'uses' => 'UserController@unfollowAnimes'
            ]
        );

        Route::resource('user', 'UserController');

    }

);