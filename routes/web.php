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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/', function () {
//    return date('Y-m-d H:i:s');
//});

Route::any('push', 'PushController@push');

Auth::routes();
Route::get('/home/', 'HomeController@index')->name('home');
Route::get('article/{id}', 'ArticleController@index')->where('id', '[0-9]+');
Route::post('comment', 'CommentController@store');
//Route::get('/article/{id}', '');
Route::resource('photo', 'PhotoController');
Route::group([
    'middleware' => 'auth',//auth中间件验证登录
    'namespace' => 'Admin', //Controller的命名空间后加上Admin
    'prefix' => 'admin'], //路由前缀，为admin
    function() {
    Route::get(
        '/',//在前缀路由后加入的路由
        'HomeController@index'
    );
    Route::resource('articles', 'ArticleController');
//    Route::any('article', 'ArticleController@index');
//    Route::resource('camera', 'CameraController');
});