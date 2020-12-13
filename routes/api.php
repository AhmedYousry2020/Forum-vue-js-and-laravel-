<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!

|api/v1
api/v1/auth
*/
Route::group(["prefix"=>"v1","namespace"=>"API"],function(){

//user can access without any restrictions it's public
Route::group(["prefix"=>"auth"],function(){
    //register user
Route::post('register','AuthController@register');

//login user
Route::post('login','AuthController@login');

//refresh jwt token
Route::get('refresh','AuthController@register');

});

//user can be authenticated

Route::group(["prefix"=>"auth","middleware"=>"auth:api"],function(){

//logout user from application
Route::post('logout','AuthController@logout');

//get user info
Route::get('user','AuthController@user');

});
Route::apiResource('channels','ChannelController');
Route::apiResource('discussions','DiscussionController');
Route::apiResource('replies','ReplyController');
Route::apiResource('profiles','ProfileController');


});

