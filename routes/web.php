<?php

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

Route::get('/', function () {
    return view('welcome');
});

/***---------------- Routes WebApp ----------------***/
Route::get('/webapp', function () {
    return view('webapp.webapp');
});

/***-- Nhóm Route chung --***/
Route::get('districts', 'Call_districts_option@index');
Route::get('categories', 'Call_categories_option@index');
Route::get('standardParam', 'Call_standard_param@index');

/***-- Nhóm Route phần DOM bảng điện tử --***/
Route::get('electricBoard', 'Call_elec_board@index');

/***-- Nhóm Route phần DOM trạm quan trắc, tìm kiếm và các option trong tìm kiếm --***/
Route::get('obserStation', 'Call_obser_station@index');
Route::get('obstyles', 'Call_obstyles_option@index');
Route::get('loctypes', 'Call_loctype_option@index');
Route::get('locations', 'Call_location_option@index');

/***-- Nhóm Route phần DOM kết quả thống kê, Chart, Table và các option thống kê --***/
Route::get('statStation', 'Call_stat_station@index');
Route::get('obstylesStat', 'Call_obstyles_stat_option@index');
Route::get('standardStat', 'Call_standard@index');

/***-- Nhóm Route phần DOM Upload Files
Route::post('/import', 'Call_ImportExcel@import'); --***/

/***-- Nhóm Route phần DOM danh sách Vượt Ngưỡng --***/
Route::get('thresholdStation', 'Call_threshold_station@index');

/***-- Nhóm Route phần DOM danh sách Mẫu của các trạm BTD --***/
Route::get('sampleStation', 'Call_data_sampleBTD@index');

/***-- Nhóm Route phần DOM đánh giá chất lượng môi trường AQI/WQI --***/
Route::get('WQI_AQI', 'Call_WQIAQI_result@index');

/***---------------- Routes Admin ----------------***/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
