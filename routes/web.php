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

// トップページ
// Route::get('/', function () {
//     return view('top');
// });

// ユーザー認証
Auth::routes();

Route::get('/{path}', 'HomeController@index')->where( 'path', '([ A-z\d-\/_.]+)?' );

Route::get('/','HomeController@index')->name('top');


// Google認証
Route::get('/accounts.google', 'HomeController@google');

// サイト追加
Route::get('/add-site', 'AddSiteController@index')->name('add-site');
Route::post('/add-site', 'AddSiteController@store');
Route::get('/add-site/display', 'AjaxController@displayConsole');
Route::get('/add-site/plan', 'AddSiteController@plan')->name('add-site-plan');

// 有料プランでの登録
Route::get('/add-site/plan/{addSite}/payment', 'AddSiteController@payment')->name('payment');

//プラン変更
Route::post('/{id}/account/site', 'HomeController@accountFree'); // 無料
Route::get('/{addSite}/payment', 'HomeController@planEdit')->name('payment');
Route::post('/{addSite}/payment', 'HomeController@planEditDone');
Route::get('/{addSite}/payment/done', 'HomeController@planEditFinish')->name('paymentDone');
Route::post('/{addSite}/payment/done', 'HomeController@planEditFinish');

// 解析の表示
Route::get('/{addSite}', 'HomeController@show')->name('show');

// 日付の更新
Route::post('/{addSite}', 'HomeController@updata')->name('updata');

// 新規サイト追加
Route::get('/{id}/site', 'HomeController@addSiteAgain')->name('again');

// アカウント編集
Route::get('/{id}/account', 'HomeController@accountEdit')->name('accountEdit');
Route::get('/{id}/account/profile', 'HomeController@accountProfile')->name('profile');
Route::post('/{id}/account/profile', 'HomeController@accountProfileEdit');

// パスワード変更
Route::get('/{id}/account/password', 'HomeController@accountPassword')->name('password');
Route::post('/{id}/account/password', 'HomeController@accountPasswordEdit');

// アカウント削除
Route::get('/{id}/account/delet', 'HomeController@accountDelet')->name('delet');
Route::post('/{id}/account/delet', 'HomeController@accountDeletDone');

// サイト編集
Route::get('/{addSite}/account/site', 'HomeController@accountSite')->name('site');

// AjaxControllerのルーティング
Route::get('/{addSite}/seo', 'AjaxController@seoDetail');
Route::post('/{addSite}/sitename', 'AjaxController@siteNameChange');
Route::get('/add-site/display', 'AjaxController@displayConsole');
Route::get('/{addSite}/report-seo', 'AjaxController@reportSeoDisplay');
Route::get('/{addSite}/compar-ga-report','AjaxController@comparGaReport');

// Vue
// Route::get('/get', 'HomeController@test');
Route::post('/api/ajax','AxiosController@analyticsAxios');

// Mailの送信テスト
Route::get('/mail', 'MailSendController@send');
