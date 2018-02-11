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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api'], 'prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    Route::patch('posts/{post}/groups/{group}/score', 'PostScoresController@update')->name('admin.score.update');
    Route::get('posts/{post}/groups/{group}/score', 'PostScoresController@show')->name('admin.score.show');
    Route::get('posts/{post}/groups/{group}/time', 'PostTimeController@show')->name('admin.times.show');
    Route::patch('posts/{post}/groups/{group}/departure', 'PostTimeController@departure')->name('admin.times.update.departure');
    Route::patch('posts/{post}/groups/{group}/arrival', 'PostTimeController@arrival')->name('admin.times.update.arrival');
    Route::resource('posts', 'PostsController', ['except' => ['create', 'edit']]);
    Route::resource('groups', 'GroupController', ['except' => ['create', 'edit']]);
});

//'middleware' => 'auth:api',
Route::group(['middleware' => ['role:Admin', 'auth:api'], 'prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

    /**
     * Scores
     */


    Route::get('hints/{group}', 'HintsController@show');
    Route::patch('hints/{group}', 'HintsController@update');

    Route::get('emergencies/{group}', 'EmergencyController@show');
    Route::patch('emergencies/{group}', 'EmergencyController@update');

    Route::get('questions/{group}', 'QuestionController@show');
    Route::patch('questions/{group}', 'QuestionController@update');


    /**
     * CRUDS
     */
    Route::resource('routes', 'RouteController', ['except' => ['create', 'edit']]);

    Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);

    Route::resource('roles', 'RolesController', ['except' => ['create', 'edit']]);
    Route::resource('permissions', 'PermissionsController', ['except' => ['create', 'edit']]);

    /**
     * Config
     */
    Route::get('settings/{path}', 'SettingsController@show');
    Route::patch('settings/value/{path}', 'SettingsController@updateValue');

    /**
     * Results and charts
     */
    Route::get('results', 'ScoreController@results');
    Route::get('old-results', 'ScoreController@oldResults');
});
