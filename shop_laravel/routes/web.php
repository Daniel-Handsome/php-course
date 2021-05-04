<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});
*/



//首頁
Route::get('/','HomeController@indexPage');

//使用者
Route::group(['prefix' => 'user'], function () {
   //使用者驗證
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/sign-up','UserAuthController@SignUpPage');
        Route::post('/sign-up','UserAuthController@SignUpProcess');
        Route::get('/sign-in','UserAuthController@SignInPage');
        Route::post('/sign-in','UserAuthController@SignUpProcess');
        Route::get('/sign-out','UserAuthController@signOut');
    });
//商品

    Route::group(['prefix' => 'merchandise'], function () {
        //商品清單
        Route::get('/','MerchandiseController@MerchandiseListPage');
        //商品建立
        Route::get('/creat','MerchandiseController@merchandiseCreatProcess')
                ->middleware(['user.auth.admin']);
        //商品清單管理
        Route::get("/manage",'MerchandiseController@MerchandiseManageListPage')
                ->middleware(['user.auth.admin']);
});

    //指定商品(使用者)
    Route::group(['prefix' => '{merchandise_id}'], function () {
        //商品單品檢測
        Route::get('/','MerchandiseController@MerchandiseItemPage');
        //商品購買
        Route::post('/buy','MerchandiseController@MerchandiseItemBuyProcess')
                ->middleware(['user.auth']);
        //商品編輯畫面
        Route::get('/edit','MerchandiseController@merchandiseItemEditPage')
                ->middleware(['user.auth.admin']);
    });

    //指定商品(管理者)
    Route::group(['prefix' => '{merchandise_id}',
                    'middleware ' => 'user.auth.admin'], function () {

    });
});

//交易
Route::get('transaction','TansactionController@transactionPage')
            ->middleware(['user.auth']);
