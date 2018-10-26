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

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('auth', 'UserController@authenticate');
Route::post('role', 'UserController@createRole');
Route::post('permission', 'UserController@createPermission');
Route::post('assign-role', 'UserController@assignRole');
Route::post('attach-permission', 'UserController@attachPermission');

Route::middleware('jwt.verify')->group(function () {
//    Route::get('users', ['uses' => 'UserController@getShowAll', 'as' => 'user.show-all-user']);
    Route::resource('users', 'UserController');
    Route::resource('post','PostsController');

});
//Route::group(['prefix' => 'api', 'middleware' => ['jwt.verify']], function() {
//    Route::get('users', ['middleware' => ['permission:user.show-all'], 'uses' => 'UserController@getShowAll', 'as' => 'user.show-all-user']);
//});

