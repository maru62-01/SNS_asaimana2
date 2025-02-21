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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
// ミドルウェア
Route::middleware(['auth'])->group(function () {

    Route::post('/post/create', 'PostsController@postCreate');

    Route::post('/profile/update', 'UsersController@profileUpdate')->name('profile.update');

    Route::get('/post/{id}/delete', 'PostsController@postDelete');


    Route::get('/top', 'PostsController@index');

    // プロフィール編集
    Route::get('/editprofile', 'UsersController@edit');

    Route::get('/profile/update', 'UsersController@profileUpdate');


    // プロフィールページのルートを定義 他ユーザーのプロフィール
    Route::get('/profile/{id}', 'UsersController@profile')->name('profile');
    // {id}がURLパラメーター　



    Route::get('/search', 'UsersController@search');
    Route::post('/unfollow/{id}', 'UsersController@unfollow')->name('unfollow');


    //フォロー・フォロー解除
    Route::post('/follow/{id}', 'UsersController@follow')->name('follow');

    Route::get('/followlist', 'FollowsController@followList');
    Route::get('/followerlist', 'FollowsController@followerList');
});





// ログアウトのルーティング
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
