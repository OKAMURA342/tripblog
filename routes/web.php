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


Auth::routes();
//
Route::post('/add','TripController@create');
//ブラウザに表示させる。
Route::get('/','TripController@index');
//新規投稿
Route::get('/new','TripController@new')->middleware('auth');;
//
Route::get('/blog','TripController@Comment');

//編集
Route::get('/edit','TripController@edit')->middleware('auth');

Route::post('/update','TripController@update');
//個人ページ
Route::get('/mypage','TripController@mypage')->middleware('auth');
//削除
Route::post('/remove','TripController@remove');
//検索
Route::post('/search','TripController@search');
Route::get('/search','TripController@search')->middleware('auth');
//いいね機能
Route::get('/good','TripController@good')->middleware('auth');;
//コメント
Route::post('/articles','TripController@articles');
Route::post('/comments', 'TripController@destroy');
//退会確認画面
Route::get('/users.delete_confirm','TripController@delete_confirm')->middleware('auth');
//退会
Route::post('/users_delete', 'TripController@users_destroy');