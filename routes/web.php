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
    return view('webapp.webapp');
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

/***-- Nhóm Route phần DOM kết quả thống kê, Chart, Table và các option thống kê, upload Excel --***/
Route::get('statStation', 'Call_stat_station@index');
Route::get('obstylesStat', 'Call_obstyles_stat_option@index');
Route::get('standardStat', 'Call_standard@index');
Route::get('purposeExcel', 'Call_purpose@index');

/***-- Nhóm Route phần DOM Upload Files
Route::get('importExcel', 'Call_import_excel@index'); --***/

/***-- Nhóm Route phần DOM danh sách Vượt Ngưỡng --***/
Route::get('thresholdStation', 'Call_threshold_station@index');

/***-- Nhóm Route phần DOM danh sách Mẫu của các trạm BTD --***/
Route::get('sampleStation', 'Call_data_sampleBTD@index');

/***-- Nhóm Route phần DOM đánh giá chất lượng môi trường AQI/WQI --***/
Route::get('WQI_AQI', 'Call_WQIAQI_result@index');

/***---------------- Routes Admin ----------------***/
Route::get('jsonStandard', 'StandardParameterController@jsonStandard');
Route::get('jsonStandardParameterdb', 'StandardParameterController@jsonStandardParameterdb');
Route::get('jsonStandardParameter', 'StandardParameterController@jsonStandardParameter');
Route::get('jsonStandardWParam', 'StandardParameterController@jsonStandardWParam');
Route::get('jsonParameter', 'StandardParameterController@jsonParameter');
Route::get('jsonPurpose', 'StandardParameterController@jsonPurpose');
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test1', function ($id) {
    return view('admin.master');
});

// Route::get('/master', function () {
//     return view('admin.master');
// })->middleware('auth')->name('master');



//-----Login-----//
Route::get('login', 'Auth\LoginController@getAuthLogin')->name('login');
Route::post('login', 'Auth\LoginController@postAuthLogin')->name('login');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@getLogout'])->name('logout');

Route::get('menu', 'HomeController@index');
Route::get('/master', 'HomeController@show')->name('master');

// Route::middleware(['auth'])->group(function () {

// });

Route::group(['prefix' => 'danhmuc'], function () {
    Route::get('test', function () {
        return "Hàm test";
	});

    //-----ObservationType-----//
    Route::get('ObservationType', 'ObservationTypeController@index')->name('ObservationType');
    Route::get('ObservationTypetk', 'ObservationTypeController@show')->name('ObservationTypetk');
    Route::get('ObservationType.create', 'ObservationTypeController@create')->name('ObservationType.create');
    Route::post('ObservationType.create', 'ObservationTypeController@store')->name('ObservationType.create');
    Route::get('ObservationType.edit/{id}', 'ObservationTypeController@edit')->name('ObservationType.edit');
    Route::post('ObservationType.edit/{id}', 'ObservationTypeController@update')->name('ObservationType.edit');
    Route::post('ObservationType.delete/{id}', 'ObservationTypeController@destroy')->name('ObservationType.delete');

    //-----Parameter-----//
    Route::get('Parameter', 'ParameterController@index')->name('Parameter');
    Route::get('Parametertk', 'ParameterController@show')->name('Parametertk');
    Route::get('Parameter.create', 'ParameterController@create')->name('Parameter.create');
    Route::post('Parameter.create', 'ParameterController@store')->name('Parameter.create');
    Route::get('Parameter.edit/{id}', 'ParameterController@edit')->name('Parameter.edit');
    Route::post('Parameter.edit/{id}', 'ParameterController@update')->name('Parameter.edit');
    Route::post('Parameter.delete/{id}', 'ParameterController@destroy')->name('Parameter.delete');

    //-----Unit-----//
    Route::get('Unit', 'UnitController@index')->name('Unit');
    Route::get('Unittk', 'UnitController@show')->name('Unittk');
    Route::get('Unit.create', 'UnitController@create')->name('Unit.create');
    Route::post('Unit.create', 'UnitController@store')->name('Unit.create');
    Route::get('Unit.edit/{id}', 'UnitController@edit')->name('Unit.edit');
    Route::post('Unit.edit/{id}', 'UnitController@update')->name('Unit.edit');
    Route::post('Unit.delete/{id}', 'UnitController@destroy')->name('Unit.delete');

    //-----Purpose-----//
    Route::get('Purpose', 'PurposeController@index')->name('Purpose');
    Route::get('Purposetk', 'PurposeController@show')->name('Purposetk');
    Route::get('Purpose.create', 'PurposeController@create')->name('Purpose.create');
    Route::post('Purpose.create', 'PurposeController@store')->name('Purpose.create');
    Route::get('Purpose.edit/{id}', 'PurposeController@edit')->name('Purpose.edit');
    Route::post('Purpose.edit/{id}', 'PurposeController@update')->name('Purpose.edit');
    Route::post('Purpose.delete/{id}', 'PurposeController@destroy')->name('Purpose.delete');

    //-----Qualityindex-----//
    Route::get('Qualityindex', 'QualityindexController@index')->name('Qualityindex');
    Route::get('Qualityindextk', 'QualityindexController@show')->name('Qualityindextk');
    Route::get('Qualityindex.create', 'QualityindexController@create')->name('Qualityindex.create');
    Route::post('Qualityindex.create', 'QualityindexController@store')->name('Qualityindex.create');
    Route::get('Qualityindex.edit/{id}', 'QualityindexController@edit')->name('Qualityindex.edit');
    Route::post('Qualityindex.edit/{id}', 'QualityindexController@update')->name('Qualityindex.edit');
    Route::post('Qualityindex.delete/{id}', 'QualityindexController@destroy')->name('Qualityindex.delete');

    //-----Category-----//
    Route::get('Category', 'CategoryController@index')->name('Category');
    Route::get('Categorytk', 'CategoryController@show')->name('Categorytk');
    Route::get('Category.create', 'CategoryController@create')->name('Category.create');
    Route::post('Category.create', 'CategoryController@store')->name('Category.create');
    Route::get('Category.edit/{id}', 'CategoryController@edit')->name('Category.edit');
    Route::post('Category.edit/{id}', 'CategoryController@update')->name('Category.edit');
    Route::post('Category.delete/{id}', 'CategoryController@destroy')->name('Category.delete');

    //-----LocationType-----//
    Route::get('LocationType', 'LocationTypeController@index')->name('LocationType');
    Route::get('LocationTypetk', 'LocationTypeController@show')->name('LocationTypetk');
    Route::get('LocationType.create', 'LocationTypeController@create')->name('LocationType.create');
    Route::post('LocationType.create', 'LocationTypeController@store')->name('LocationType.create');
    Route::get('LocationType.edit/{id}', 'LocationTypeController@edit')->name('LocationType.edit');
    Route::post('LocationType.edit/{id}', 'LocationTypeController@update')->name('LocationType.edit');
    Route::post('LocationType.delete/{id}', 'LocationTypeController@destroy')->name('LocationType.delete');

    //-----Organization-----//
    Route::get('Organization', 'OrganizationController@index')->name('Organization');
    Route::get('Organizationtk', 'OrganizationController@show')->name('Organizationtk');
    Route::get('Organization.create', 'OrganizationController@create')->name('Organization.create');
    Route::post('Organization.create', 'OrganizationController@store')->name('Organization.create');
    Route::get('Organization.edit/{id}', 'OrganizationController@edit')->name('Organization.edit');
    Route::post('Organization.edit/{id}', 'OrganizationController@update')->name('Organization.edit');
    Route::post('Organization.delete/{id}', 'OrganizationController@destroy')->name('Organization.delete');

    //-----Enterprise-----//
    Route::get('Enterprise', 'EnterpriseController@index')->name('Enterprise');
    Route::get('Enterprisetk', 'EnterpriseController@show')->name('Enterprisetk');
    Route::get('Enterprise.create', 'EnterpriseController@create')->name('Enterprise.create');
    Route::post('Enterprise.create', 'EnterpriseController@store')->name('Enterprise.create');
    Route::get('Enterprise.edit/{id}', 'EnterpriseController@edit')->name('Enterprise.edit');
    Route::post('Enterprise.edit/{id}', 'EnterpriseController@update')->name('Enterprise.edit');
    Route::post('Enterprise.delete/{id}', 'EnterpriseController@destroy')->name('Enterprise.delete');

    //-----Standard-----//
    Route::get('Standard', 'StandardController@index')->name('Standard');
    Route::get('Standardtk', 'StandardController@show')->name('Standardtk');
    Route::get('Standard.create', 'StandardController@create')->name('Standard.create');
    Route::post('Standard.create', 'StandardController@store')->name('Standard.create');
    Route::get('Standard.edit/{id}', 'StandardController@edit')->name('Standard.edit');
    Route::post('Standard.edit/{id}', 'StandardController@update')->name('Standard.edit');
    Route::post('Standard.delete/{id}', 'StandardController@destroy')->name('Standard.delete');

     //-----CategoryPost-----//
     Route::get('CatePost', 'CatePostController@index')->name('CatePost');
     Route::get('CatePosttk', 'CatePostController@show')->name('CatePosttk');
     Route::get('CatePost.create', 'CatePostController@create')->name('CatePost.create');
     Route::post('CatePost.create', 'CatePostController@store')->name('CatePost.create');
     Route::get('CatePost.edit/{id}', 'CatePostController@edit')->name('CatePost.edit');
     Route::post('CatePost.edit/{id}', 'CatePostController@update')->name('CatePost.edit');
     Route::post('CatePost.delete/{id}', 'CatePostController@destroy')->name('CatePost.delete');

    //-----Location-----//
    Route::get('Place', 'PlaceController@index')->name('Place');
    Route::get('Placetk', 'PlaceController@show')->name('Placetk');
    Route::get('Place.create', 'PlaceController@create')->name('Place.create');
    Route::post('Place.create', 'PlaceController@store')->name('Place.create');
    Route::get('Place.edit/{id}', 'PlaceController@edit')->name('Place.edit');
    Route::post('Place.edit/{id}', 'PlaceController@update')->name('Place.edit');
    Route::post('Place.delete/{id}', 'PlaceController@destroy')->name('Place.delete');

     //-----Basin-----//
    Route::get('Basin', 'BasinController@index')->name('Basin');
    Route::get('Basintk', 'BasinController@show')->name('Basintk');
    Route::get('Basin.create', 'BasinController@create')->name('Basin.create');
    Route::post('Basin.create', 'BasinController@store')->name('Basin.create');
    Route::get('Basin.edit/{id}', 'BasinController@edit')->name('Basin.edit');
    Route::post('Basin.edit/{id}', 'BasinController@update')->name('Basin.edit');
    Route::post('Basin.delete/{id}', 'BasinController@destroy')->name('Basin.delete');
});

Route::group(['prefix' => 'quanly'], function () {
    //-----Observationstation-----//
    Route::get('Observationstation', 'ObservationstationController@index')->name('Observationstation');
    Route::get('Observationstationtk', 'ObservationstationController@show')->name('Observationstationtk');
    Route::get('Observationstation.create', 'ObservationstationController@create')->name('Observationstation.create');
    Route::post('Observationstation.create', 'ObservationstationController@store')->name('Observationstation.create');
    Route::get('Observationstation.edit/{id}', 'ObservationstationController@edit')->name('Observationstation.edit');
    Route::post('Observationstation.edit/{id}', 'ObservationstationController@update')->name('Observationstation.edit');
    Route::post('Observationstation.delete/{id}', 'ObservationstationController@destroy')->name('Observationstation.delete');

    //-----StandardParameter-----//
    Route::get('StandardParameter', 'StandardParameterController@index')->name('StandardParameter');
    Route::get('StandardParametertk', 'StandardParameterController@show')->name('StandardParametertk');
    Route::get('StandardParameter.create', 'StandardParameterController@create')->name('StandardParameter.create');
    Route::post('StandardParameter.create', 'StandardParameterController@store')->name('StandardParameter.create');
    Route::get('StandardParameter.edit/{id}', 'StandardParameterController@edit')->name('StandardParameter.edit');
    Route::post('StandardParameter.edit/{id}', 'StandardParameterController@update')->name('StandardParameter.edit');
    Route::post('StandardParameter.delete/{id}', 'StandardParameterController@destroy')->name('StandardParameter.delete');

    //-----Camera-----//
    Route::get('Camera', 'CameraController@index')->name('Camera');
    Route::get('Cameratk', 'CameraController@show')->name('Cameratk');
    Route::get('Camera.create', 'CameraController@create')->name('Camera.create');
    Route::post('Camera.create', 'CameraController@store')->name('Camera.create');
    Route::get('Camera.edit/{id}', 'CameraController@edit')->name('Camera.edit');
    Route::post('Camera.edit/{id}', 'CameraController@update')->name('Camera.edit');
    Route::post('Camera.delete/{id}', 'CameraController@destroy')->name('Camera.delete');

    //-----ElectronicBoard-----//
    Route::get('ElectronicBoard', 'ElectronicBoardController@index')->name('ElectronicBoard');
    Route::get('ElectronicBoardtk', 'ElectronicBoardController@show')->name('ElectronicBoardtk');
    Route::get('ElectronicBoard.create', 'ElectronicBoardController@create')->name('ElectronicBoard.create');
    Route::post('ElectronicBoard.create', 'ElectronicBoardController@store')->name('ElectronicBoard.create');
    Route::get('ElectronicBoard.edit/{id}', 'ElectronicBoardController@edit')->name('ElectronicBoard.edit');
    Route::post('ElectronicBoard.edit/{id}', 'ElectronicBoardController@update')->name('ElectronicBoard.edit');
    Route::post('ElectronicBoard.delete/{id}', 'ElectronicBoardController@destroy')->name('ElectronicBoard.delete');

     //-----Posts-----//
   
    Route::get('Post', 'PostController@index')->name('Post');
    Route::get('Posttk', 'PostController@show')->name('Posttk');
    Route::get('Post.create', 'PostController@create')->name('Post.create');
    Route::post('Post.create', 'PostController@store')->name('Post.create');
    Route::get('Post.edit/{id}', 'PostController@edit')->name('Post.edit');
    Route::post('Post.edit/{id}', 'PostController@update')->name('Post.edit');
    Route::post('Post.delete/{id}', 'PostController@destroy')->name('Post.delete');
});

Route::group(['prefix' => 'quantri'], function () {
    // Route::get('test', function () {
    //     return "Hàm test";
    // })->middleware('auth');

    //-----Menu-----//
    Route::get('menu', 'MenuController@index')->name('menu');
    Route::get('menu.create', 'MenuController@create')->name('menu.create');
    Route::post('menu.create', 'MenuController@store')->name('menu.create');
    Route::get('menu.edit/{id}', 'MenuController@edit')->name('menu.edit');
    Route::post('menu.edit/{id}', 'MenuController@update')->name('menu.edit');
    Route::post('menu.delete/{id}', 'MenuController@destroy')->name('menu.delete');

    //-----Permission-----//
    // Route::get('/permission', [
    //     'as' => 'permission',
    //     'uses' => 'PermissionController@index',
    //     'middleware' => 'checkmiddleware:permission',
    // ])->name('permission');
    Route::get('permission', 'PermissionController@index')->name('permission');
    Route::get('permission.create', 'PermissionController@create')->name('permission.create');
    Route::post('permission.create', 'PermissionController@store')->name('permission.create');
    Route::get('permission.edit/{id}', 'PermissionController@edit')->name('permission.edit');
    Route::post('permission.edit/{id}', 'PermissionController@update')->name('permission.edit');
    Route::post('permission.delete/{id}', 'PermissionController@destroy')->name('permission.delete');
});
