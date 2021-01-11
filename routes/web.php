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

/***-- Nhóm Route phần DOM Điểm xả thải --***/
Route::get('dischargePoint', 'Call_discharge_point@index');

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
/* Route::get('/home', 'HomeController@index')->name('home'); */

Route::get('/test1', function ($id) {
    return view('admin.master');
});

/* Route::get('/master', function () {
    return view('admin.master');
})->middleware('auth')->name('master'); */

/***-- Login --***/
Route::get('login', 'Auth\LoginController@getAuthLogin')->name('login');
Route::post('login', 'Auth\LoginController@postAuthLogin')->name('login');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@getLogout'])->name('logout');

Route::get('menu', 'HomeController@index');


// /* Route::middleware(['auth'])->group(function () {}); */
Route::middleware(['auth'])->group(function () {
    Route::get('/master', 'HomeController@show')->name('master');
    Route::group(['prefix' => 'danhmuc'], function () {
        // Route::get('test', function () {
        //     return "Hàm test";
        // });

        /***-- ObservationType --***/
        // Route::get('ObservationType', 'ObservationTypeController@index')->name('ObservationType');
        // Route::get('ObservationTypetk', 'ObservationTypeController@show')->name('ObservationTypetk');
        // Route::get('ObservationType.create', 'ObservationTypeController@create')->name('ObservationType.create');
        // Route::post('ObservationType.create', 'ObservationTypeController@store')->name('ObservationType.create');
        // Route::get('ObservationType.edit/{id}', 'ObservationTypeController@edit')->name('ObservationType.edit');
        // Route::post('ObservationType.edit/{id}', 'ObservationTypeController@update')->name('ObservationType.edit');
        // Route::post('ObservationType.delete/{id}', 'ObservationTypeController@destroy')->name('ObservationType.delete');

        //-----ObservationType-----//
        //Route::get('ObservationType', 'ObservationTypeController@index')->name('ObservationType');
        Route::get('/ObservationType', [
            'uses' => 'ObservationTypeController@index',
            'middleware' => 'checkmiddleware:ObservationType',
        ])->name('ObservationType');
        Route::get('ObservationTypetk', 'ObservationTypeController@show')->name('ObservationTypetk');

        //Route::get('ObservationType.create', 'ObservationTypeController@create')->name('ObservationType.create');
        Route::get('/ObservationType.create', [
            'uses' => 'ObservationTypeController@create',
            'middleware' => 'checkmiddleware:ObservationType.create',
        ])->name('ObservationType.create');
        Route::post('ObservationType.create', 'ObservationTypeController@store')->name('ObservationType.create');

        //Route::get('ObservationType.edit/{id}', 'ObservationTypeController@edit')->name('ObservationType.edit');
        Route::get('/ObservationType.edit/{id}', [
            'uses' => 'ObservationTypeController@edit',
            'middleware' => 'checkmiddleware:ObservationType.edit',
        ])->name('ObservationType.edit');
        Route::post('ObservationType.edit/{id}', 'ObservationTypeController@update')->name('ObservationType.edit');

        //Route::post('ObservationType.delete/{id}', 'ObservationTypeController@destroy')->name('ObservationType.delete');
        Route::post('/ObservationType.delete/{id}', [
            'uses' => 'ObservationTypeController@destroy',
            'middleware' => 'checkmiddleware:ObservationType.delete',
        ])->name('ObservationType.delete');


        /***-- Parameter --***/
        // Route::get('Parameter', 'ParameterController@index')->name('Parameter');
        // Route::get('Parametertk', 'ParameterController@show')->name('Parametertk');
        // Route::get('Parameter.create', 'ParameterController@create')->name('Parameter.create');
        // Route::post('Parameter.create', 'ParameterController@store')->name('Parameter.create');
        // Route::get('Parameter.edit/{id}', 'ParameterController@edit')->name('Parameter.edit');
        // Route::post('Parameter.edit/{id}', 'ParameterController@update')->name('Parameter.edit');
        // Route::post('Parameter.delete/{id}', 'ParameterController@destroy')->name('Parameter.delete');

        //Route::get('Parameter', 'ParameterController@index')->name('Parameter');
        Route::get('/Parameter', [
            'uses' => 'ParameterController@index',
            'middleware' => 'checkmiddleware:Parameter',
        ])->name('Parameter');
        Route::get('Parametertk', 'ParameterController@show')->name('Parametertk');

        //Route::get('Parameter.create', 'ParameterController@create')->name('Parameter.create');
        Route::post('Parameter.create', 'ParameterController@store')->name('Parameter.create');
        Route::get('/Parameter.create', [
            'uses' => 'ParameterController@create',
            'middleware' => 'checkmiddleware:Parameter.create',
        ])->name('Parameter.create');

        //Route::get('Parameter.edit/{id}', 'ParameterController@edit')->name('Parameter.edit');
        Route::post('Parameter.edit/{id}', 'ParameterController@update')->name('Parameter.edit');
        Route::get('/Parameter.edit/{id}', [
            'uses' => 'ParameterController@edit',
            'middleware' => 'checkmiddleware:Parameter.edit',
        ])->name('Parameter.edit');

        //Route::post('Parameter.delete/{id}', 'ParameterController@destroy')->name('Parameter.delete');
        Route::post('/Parameter.delete/{id}', [
            'uses' => 'ParameterController@destroy',
            'middleware' => 'checkmiddleware:Parameter.delete',
        ])->name('Parameter.delete');


        /***-- Unit --***/
        // Route::get('Unit', 'UnitController@index')->name('Unit');
        // Route::get('Unittk', 'UnitController@show')->name('Unittk');
        // Route::get('Unit.create', 'UnitController@create')->name('Unit.create');
        // Route::post('Unit.create', 'UnitController@store')->name('Unit.create');
        // Route::get('Unit.edit/{id}', 'UnitController@edit')->name('Unit.edit');
        // Route::post('Unit.edit/{id}', 'UnitController@update')->name('Unit.edit');
        // Route::post('Unit.delete/{id}', 'UnitController@destroy')->name('Unit.delete');

        //Route::get('Unit', 'UnitController@index')->name('Unit');
        Route::get('/Unit', [
            'uses' => 'UnitController@index',
            'middleware' => 'checkmiddleware:Unit',
        ])->name('Unit');
        Route::get('Unittk', 'UnitController@show')->name('Unittk');

        //Route::get('Unit.create', 'UnitController@create')->name('Unit.create');
        Route::get('/Unit.create', [
            'uses' => 'UnitController@create',
            'middleware' => 'checkmiddleware:Unit.create',
        ])->name('Unit.create');
        Route::post('Unit.create', 'UnitController@store')->name('Unit.create');

        //Route::get('Unit.edit/{id}', 'UnitController@edit')->name('Unit.edit');
        Route::get('/Unit.edit/{id}', [
            'uses' => 'UnitController@edit',
            'middleware' => 'checkmiddleware:Unit.edit',
        ])->name('Unit.edit');
        Route::post('Unit.edit/{id}', 'UnitController@update')->name('Unit.edit');

        //Route::post('Unit.delete/{id}', 'UnitController@destroy')->name('Unit.delete');
        Route::post('/Unit.delete/{id}', [
            'uses' => 'UnitController@destroy',
            'middleware' => 'checkmiddleware:Unit.delete',
        ])->name('Unit.delete');


        /***-- Purpose --***/
        // Route::get('Purpose', 'PurposeController@index')->name('Purpose');
        // Route::get('Purposetk', 'PurposeController@show')->name('Purposetk');
        // Route::get('Purpose.create', 'PurposeController@create')->name('Purpose.create');
        // Route::post('Purpose.create', 'PurposeController@store')->name('Purpose.create');
        // Route::get('Purpose.edit/{id}', 'PurposeController@edit')->name('Purpose.edit');
        // Route::post('Purpose.edit/{id}', 'PurposeController@update')->name('Purpose.edit');
        // Route::post('Purpose.delete/{id}', 'PurposeController@destroy')->name('Purpose.delete');
        //Route::get('Purpose', 'PurposeController@index')->name('Purpose');
        Route::get('/Purpose', [
            'uses' => 'PurposeController@index',
            'middleware' => 'checkmiddleware:Purpose',
        ])->name('Purpose');
        Route::get('Purposetk', 'PurposeController@show')->name('Purposetk');

        //Route::get('Purpose.create', 'PurposeController@create')->name('Purpose.create');
        Route::get('/Purpose.create', [
            'uses' => 'PurposeController@create',
            'middleware' => 'checkmiddleware:Purpose.create',
        ])->name('Purpose.create');
        Route::post('Purpose.create', 'PurposeController@store')->name('Purpose.create');

        //Route::get('Purpose.edit/{id}', 'PurposeController@edit')->name('Purpose.edit');
        Route::get('/Purpose.edit/{id}', [
            'uses' => 'PurposeController@edit',
            'middleware' => 'checkmiddleware:Purpose.edit',
        ])->name('Purpose.edit');
        Route::post('Purpose.edit/{id}', 'PurposeController@update')->name('Purpose.edit');

        //Route::post('Purpose.delete/{id}', 'PurposeController@destroy')->name('Purpose.delete');
        Route::post('/Purpose.delete/{id}', [
            'uses' => 'PurposeController@destroy',
            'middleware' => 'checkmiddleware:Purpose.delete',
        ])->name('Purpose.delete');

        /***-- Qualityindex --***/
        // Route::get('Qualityindex', 'QualityindexController@index')->name('Qualityindex');
        // Route::get('Qualityindextk', 'QualityindexController@show')->name('Qualityindextk');
        // Route::get('Qualityindex.create', 'QualityindexController@create')->name('Qualityindex.create');
        // Route::post('Qualityindex.create', 'QualityindexController@store')->name('Qualityindex.create');
        // Route::get('Qualityindex.edit/{id}', 'QualityindexController@edit')->name('Qualityindex.edit');
        // Route::post('Qualityindex.edit/{id}', 'QualityindexController@update')->name('Qualityindex.edit');
        // Route::post('Qualityindex.delete/{id}', 'QualityindexController@destroy')->name('Qualityindex.delete');

        //Route::get('Qualityindex', 'QualityindexController@index')->name('Qualityindex');
        Route::get('/Qualityindex', [
            'uses' => 'QualityindexController@index',
            'middleware' => 'checkmiddleware:Qualityindex',
        ])->name('Qualityindex');
        Route::get('Qualityindextk', 'QualityindexController@show')->name('Qualityindextk');

        //Route::get('Qualityindex.create', 'QualityindexController@create')->name('Qualityindex.create');
        Route::get('/Qualityindex.create', [
            'uses' => 'QualityindexController@create',
            'middleware' => 'checkmiddleware:Qualityindex.create',
        ])->name('Qualityindex.create');
        Route::post('Qualityindex.create', 'QualityindexController@store')->name('Qualityindex.create');

        //Route::get('Qualityindex.edit/{id}', 'QualityindexController@edit')->name('Qualityindex.edit');
        Route::get('/Qualityindex.edit/{id}', [
            'uses' => 'QualityindexController@edit',
            'middleware' => 'checkmiddleware:Qualityindex.edit',
        ])->name('Qualityindex.edit');
        Route::post('Qualityindex.edit/{id}', 'QualityindexController@update')->name('Qualityindex.edit');

        //Route::post('Qualityindex.delete/{id}', 'QualityindexController@destroy')->name('Qualityindex.delete');
        Route::post('/Qualityindex.delete/{id}', [
            'uses' => 'QualityindexController@destroy',
            'middleware' => 'checkmiddleware:Qualityindex.delete',
        ])->name('Qualityindex.delete');


        /***-- Category --***/
        // Route::get('Category', 'CategoryController@index')->name('Category');
        // Route::get('Categorytk', 'CategoryController@show')->name('Categorytk');
        // Route::get('Category.create', 'CategoryController@create')->name('Category.create');
        // Route::post('Category.create', 'CategoryController@store')->name('Category.create');
        // Route::get('Category.edit/{id}', 'CategoryController@edit')->name('Category.edit');
        // Route::post('Category.edit/{id}', 'CategoryController@update')->name('Category.edit');
        // Route::post('Category.delete/{id}', 'CategoryController@destroy')->name('Category.delete');

        //Route::get('Category', 'CategoryController@index')->name('Category');
        Route::get('/Category', [
            'uses' => 'CategoryController@index',
            'middleware' => 'checkmiddleware:Category',
        ])->name('Category');
        Route::get('Categorytk', 'CategoryController@show')->name('Categorytk');

        //Route::get('Category.create', 'CategoryController@create')->name('Category.create');
        Route::get('/Category.create', [
            'uses' => 'CategoryController@create',
            'middleware' => 'checkmiddleware:Category.create',
        ])->name('Category.create');
        Route::post('Category.create', 'CategoryController@store')->name('Category.create');

        //Route::get('Category.edit/{id}', 'CategoryController@edit')->name('Category.edit');
        Route::get('/Category.edit/{id}', [
            'uses' => 'CategoryController@edit',
            'middleware' => 'checkmiddleware:Category.edit',
        ])->name('Category.edit');
        Route::post('Category.edit/{id}', 'CategoryController@update')->name('Category.edit');

        //Route::post('Category.delete/{id}', 'CategoryController@destroy')->name('Category.delete');
        Route::post('/Category.delete/{id}', [
            'uses' => 'CategoryController@destroy',
            'middleware' => 'checkmiddleware:Category.delete',
        ])->name('Category.delete');


        /***-- LocationType --***/
        // Route::get('LocationType', 'LocationTypeController@index')->name('LocationType');
        // Route::get('LocationTypetk', 'LocationTypeController@show')->name('LocationTypetk');
        // Route::get('LocationType.create', 'LocationTypeController@create')->name('LocationType.create');
        // Route::post('LocationType.create', 'LocationTypeController@store')->name('LocationType.create');
        // Route::get('LocationType.edit/{id}', 'LocationTypeController@edit')->name('LocationType.edit');
        // Route::post('LocationType.edit/{id}', 'LocationTypeController@update')->name('LocationType.edit');
        // Route::post('LocationType.delete/{id}', 'LocationTypeController@destroy')->name('LocationType.delete');
        //Route::get('LocationType', 'LocationTypeController@index')->name('LocationType');
        Route::get('/LocationType', [
            'uses' => 'LocationTypeController@index',
            'middleware' => 'checkmiddleware:LocationType',
        ])->name('LocationType');
        Route::get('LocationTypetk', 'LocationTypeController@show')->name('LocationTypetk');

        //Route::get('LocationType.create', 'LocationTypeController@create')->name('LocationType.create');
        Route::get('/LocationType.create', [
            'uses' => 'LocationTypeController@create',
            'middleware' => 'checkmiddleware:LocationType.create',
        ])->name('LocationType.create');
        Route::post('LocationType.create', 'LocationTypeController@store')->name('LocationType.create');

        //Route::get('LocationType.edit/{id}', 'LocationTypeController@edit')->name('LocationType.edit');
        Route::get('/LocationType.edit/{id}', [
            'uses' => 'LocationTypeController@edit',
            'middleware' => 'checkmiddleware:LocationType.edit',
        ])->name('LocationType.edit');
        Route::post('LocationType.edit/{id}', 'LocationTypeController@update')->name('LocationType.edit');

        //Route::post('LocationType.delete/{id}', 'LocationTypeController@destroy')->name('LocationType.delete');
        Route::post('/LocationType.delete/{id}', [
            'uses' => 'LocationTypeController@destroy',
            'middleware' => 'checkmiddleware:LocationType.delete',
        ])->name('LocationType.delete');

        /***-- Organization --***/
        // Route::get('Organization', 'OrganizationController@index')->name('Organization');
        // Route::get('Organizationtk', 'OrganizationController@show')->name('Organizationtk');
        // Route::get('Organization.create', 'OrganizationController@create')->name('Organization.create');
        // Route::post('Organization.create', 'OrganizationController@store')->name('Organization.create');
        // Route::get('Organization.edit/{id}', 'OrganizationController@edit')->name('Organization.edit');
        // Route::post('Organization.edit/{id}', 'OrganizationController@update')->name('Organization.edit');
        // Route::post('Organization.delete/{id}', 'OrganizationController@destroy')->name('Organization.delete');

        //Route::get('Organization', 'OrganizationController@index')->name('Organization');
        Route::get('/Organization', [
            'uses' => 'OrganizationController@index',
            'middleware' => 'checkmiddleware:Organization',
        ])->name('Organization');
        Route::get('Organizationtk', 'OrganizationController@show')->name('Organizationtk');

        //Route::get('Organization.create', 'OrganizationController@create')->name('Organization.create');
        Route::get('/Organization.create', [
            'uses' => 'OrganizationController@create',
            'middleware' => 'checkmiddleware:Organization.create',
        ])->name('Organization.create');
        Route::post('Organization.create', 'OrganizationController@store')->name('Organization.create');

        //Route::get('Organization.edit/{id}', 'OrganizationController@edit')->name('Organization.edit');
        Route::get('/Organization.edit/{id}', [
            'uses' => 'OrganizationController@edit',
            'middleware' => 'checkmiddleware:Organization.edit',
        ])->name('Organization.edit');
        Route::post('Organization.edit/{id}', 'OrganizationController@update')->name('Organization.edit');

        //Route::post('Organization.delete/{id}', 'OrganizationController@destroy')->name('Organization.delete');
        Route::post('/Organization.delete/{id}', [
            'uses' => 'OrganizationController@destroy',
            'middleware' => 'checkmiddleware:Organization.delete',
        ])->name('Organization.delete');

        /***-- Enterprise --***/
        // Route::get('Enterprise', 'EnterpriseController@index')->name('Enterprise');
        // Route::get('Enterprisetk', 'EnterpriseController@show')->name('Enterprisetk');
        // Route::get('Enterprise.create', 'EnterpriseController@create')->name('Enterprise.create');
        // Route::post('Enterprise.create', 'EnterpriseController@store')->name('Enterprise.create');
        // Route::get('Enterprise.edit/{id}', 'EnterpriseController@edit')->name('Enterprise.edit');
        // Route::post('Enterprise.edit/{id}', 'EnterpriseController@update')->name('Enterprise.edit');
        // Route::post('Enterprise.delete/{id}', 'EnterpriseController@destroy')->name('Enterprise.delete');

        //Route::get('Enterprise', 'EnterpriseController@index')->name('Enterprise');
        Route::get('/Enterprise', [
            'uses' => 'EnterpriseController@index',
            'middleware' => 'checkmiddleware:Enterprise',
        ])->name('Enterprise');
        Route::get('Enterprisetk', 'EnterpriseController@show')->name('Enterprisetk');

        //Route::get('Enterprise.create', 'EnterpriseController@create')->name('Enterprise.create');
        Route::get('/Enterprise.create', [
            'uses' => 'EnterpriseController@create',
            'middleware' => 'checkmiddleware:Enterprise.create',
        ])->name('Enterprise.create');
        Route::post('Enterprise.create', 'EnterpriseController@store')->name('Enterprise.create');

        //Route::get('Enterprise.edit/{id}', 'EnterpriseController@edit')->name('Enterprise.edit');
        Route::get('/Enterprise.edit/{id}', [
            'uses' => 'EnterpriseController@edit',
            'middleware' => 'checkmiddleware:Enterprise.edit',
        ])->name('Enterprise.edit');
        Route::post('Enterprise.edit/{id}', 'EnterpriseController@update')->name('Enterprise.edit');

        //Route::post('Enterprise.delete/{id}', 'EnterpriseController@destroy')->name('Enterprise.delete');
        Route::post('/Enterprise.delete/{id}', [
            'uses' => 'EnterpriseController@destroy',
            'middleware' => 'checkmiddleware:Enterprise.delete',
        ])->name('Enterprise.delete');

        /***-- Standard --***/
        // Route::get('Standard', 'StandardController@index')->name('Standard');
        // Route::get('Standardtk', 'StandardController@show')->name('Standardtk');
        // Route::get('Standard.create', 'StandardController@create')->name('Standard.create');
        // Route::post('Standard.create', 'StandardController@store')->name('Standard.create');
        // Route::get('Standard.edit/{id}', 'StandardController@edit')->name('Standard.edit');
        // Route::post('Standard.edit/{id}', 'StandardController@update')->name('Standard.edit');
        // Route::post('Standard.delete/{id}', 'StandardController@destroy')->name('Standard.delete');

        //Route::get('Standard', 'StandardController@index')->name('Standard');
        Route::get('/Standard', [
            'uses' => 'StandardController@index',
            'middleware' => 'checkmiddleware:Standard',
        ])->name('Standard');
        Route::get('Standardtk', 'StandardController@show')->name('Standardtk');

        //Route::get('Standard.create', 'StandardController@create')->name('Standard.create');
        Route::get('/Standard.create', [
            'uses' => 'StandardController@create',
            'middleware' => 'checkmiddleware:Standard.create',
        ])->name('Standard.create');
        Route::post('Standard.create', 'StandardController@store')->name('Standard.create');

        //Route::get('Standard.edit/{id}', 'StandardController@edit')->name('Standard.edit');
        Route::get('/Standard.edit/{id}', [
            'uses' => 'StandardController@edit',
            'middleware' => 'checkmiddleware:Standard.edit',
        ])->name('Standard.edit');
        Route::post('Standard.edit/{id}', 'StandardController@update')->name('Standard.edit');

        //Route::post('Standard.delete/{id}', 'StandardController@destroy')->name('Standard.delete');
        Route::post('/Standard.delete/{id}', [
            'uses' => 'StandardController@destroy',
            'middleware' => 'checkmiddleware:Standard.delete',
        ])->name('Standard.delete');


        /***-- CategoryPost --***/
        //Route::get('CatePost', 'CatePostController@index')->name('CatePost');
        Route::get('/CatePost', [
            'uses' => 'CatePostController@index',
            'middleware' => 'checkmiddleware:CatePost',
        ])->name('CatePost');
        Route::get('CatePosttk', 'CatePostController@show')->name('CatePosttk');

        //Route::get('CatePost.create', 'CatePostController@create')->name('CatePost.create');
        Route::get('/CatePost.create', [
            'uses' => 'CatePostController@create',
            'middleware' => 'checkmiddleware:CatePost.create',
        ])->name('CatePost.create');
        Route::post('CatePost.create', 'CatePostController@store')->name('CatePost.create');

        //Route::get('CatePost.edit/{id}', 'CatePostController@edit')->name('CatePost.edit');
        Route::get('/CatePost.edit/{id}', [
            'uses' => 'CatePostController@edit',
            'middleware' => 'checkmiddleware:CatePost.edit',
        ])->name('CatePost.edit');
        Route::post('CatePost.edit/{id}', 'CatePostController@update')->name('CatePost.edit');

        //Route::post('CatePost.delete/{id}', 'CatePostController@destroy')->name('CatePost.delete');
        Route::post('/CatePost.delete/{id}', [
            'uses' => 'CatePostController@destroy',
            'middleware' => 'checkmiddleware:CatePost.delete',
        ])->name('CatePost.delete');


        /***-- Location --***/
        //Route::get('Place', 'PlaceController@index')->name('Place');
        Route::get('/Place', [
            'uses' => 'PlaceController@index',
            'middleware' => 'checkmiddleware:Place',
        ])->name('Place');
        Route::get('Placetk', 'PlaceController@show')->name('Placetk');

        //Route::get('Place.create', 'PlaceController@create')->name('Place.create');
        Route::get('/Place.create', [
            'uses' => 'PlaceController@create',
            'middleware' => 'checkmiddleware:Place.create',
        ])->name('CPlaceatePost.create');
        Route::post('Place.create', 'PlaceController@store')->name('Place.create');

        //Route::get('Place.edit/{id}', 'PlaceController@edit')->name('Place.edit');
        Route::get('/Place.edit/{id}', [
            'uses' => 'PlaceController@edit',
            'middleware' => 'checkmiddleware:Place.edit',
        ])->name('Place.edit');
        Route::post('Place.edit/{id}', 'PlaceController@update')->name('Place.edit');

        //Route::post('Place.delete/{id}', 'PlaceController@destroy')->name('Place.delete');
        Route::post('/Place.delete/{id}', [
            'uses' => 'PlaceController@destroy',
            'middleware' => 'checkmiddleware:Place.delete',
        ])->name('Place.delete');

         /***-- Basin --***/
        //Route::get('Basin', 'BasinController@index')->name('Basin');
        Route::get('/Basin', [
            'uses' => 'BasinController@index',
            'middleware' => 'checkmiddleware:Basin',
        ])->name('Basin');
        Route::get('Basintk', 'BasinController@show')->name('Basintk');

        //Route::get('Basin.create', 'BasinController@create')->name('Basin.create');
        Route::get('/Basin.create', [
            'uses' => 'BasinController@create',
            'middleware' => 'checkmiddleware:Basin.create',
        ])->name('Basin.create');
        Route::post('Basin.create', 'BasinController@store')->name('Basin.create');

        //Route::get('Basin.edit/{id}', 'BasinController@edit')->name('Basin.edit');
        Route::get('/Basin.edit/{id}', [
            'uses' => 'BasinController@edit',
            'middleware' => 'checkmiddleware:Basin.edit',
        ])->name('Basin.edit');
        Route::post('Basin.edit/{id}', 'BasinController@update')->name('Basin.edit');

        //Route::post('Basin.delete/{id}', 'BasinController@destroy')->name('Basin.delete');
        Route::post('/Basin.delete/{id}', [
            'uses' => 'BasinController@destroy',
            'middleware' => 'checkmiddleware:Basin.delete',
        ])->name('Basin.delete');
    });

    Route::group(['prefix' => 'quanly'], function () {
        /***-- Observationstation --***/
        // Route::get('Observationstation', 'ObservationstationController@index')->name('Observationstation');
        // Route::get('Observationstationtk', 'ObservationstationController@show')->name('Observationstationtk');
        // Route::get('Observationstation.create', 'ObservationstationController@create')->name('Observationstation.create');
        // Route::post('Observationstation.create', 'ObservationstationController@store')->name('Observationstation.create');
        // Route::get('Observationstation.edit/{id}', 'ObservationstationController@edit')->name('Observationstation.edit');
        // Route::post('Observationstation.edit/{id}', 'ObservationstationController@update')->name('Observationstation.edit');
        // Route::post('Observationstation.delete/{id}', 'ObservationstationController@destroy')->name('Observationstation.delete');
        //Route::get('Observationstation', 'ObservationstationController@index')->name('Observationstation');
        Route::get('/Observationstation', [
            'uses' => 'ObservationstationController@index',
            'middleware' => 'checkmiddleware:Observationstation',
        ])->name('Observationstation');
        Route::get('Observationstationtk', 'ObservationstationController@show')->name('Observationstationtk');

        //Route::get('Observationstation.create', 'ObservationstationController@create')->name('Observationstation.create');
        Route::get('/Observationstation.create', [
            'uses' => 'ObservationstationController@create',
            'middleware' => 'checkmiddleware:Observationstation.create',
        ])->name('Observationstation.create');
        Route::post('Observationstation.create', 'ObservationstationController@store')->name('Observationstation.create');

        //Route::get('Observationstation.edit/{id}', 'ObservationstationController@edit')->name('Observationstation.edit');
        Route::get('/Observationstation.edit/{id}', [
            'uses' => 'ObservationstationController@edit',
            'middleware' => 'checkmiddleware:Observationstation.edit',
        ])->name('Observationstation.edit');
        Route::post('Observationstation.edit/{id}', 'ObservationstationController@update')->name('Observationstation.edit');

        //Route::post('Observationstation.delete/{id}', 'ObservationstationController@destroy')->name('Observationstation.delete');
        Route::post('/Observationstation.delete/{id}', [
            'uses' => 'ObservationstationController@destroy',
            'middleware' => 'checkmiddleware:Observationstation.delete',
        ])->name('Observationstation.delete');


        /***-- StandardParameter --***/
        // Route::get('StandardParameter', 'StandardParameterController@index')->name('StandardParameter');
        // Route::get('StandardParametertk', 'StandardParameterController@show')->name('StandardParametertk');
        // Route::get('StandardParameter.create', 'StandardParameterController@create')->name('StandardParameter.create');
        // Route::post('StandardParameter.create', 'StandardParameterController@store')->name('StandardParameter.create');
        // Route::get('StandardParameter.edit/{id}', 'StandardParameterController@edit')->name('StandardParameter.edit');
        // Route::post('StandardParameter.edit/{id}', 'StandardParameterController@update')->name('StandardParameter.edit');
        // Route::post('StandardParameter.delete/{id}', 'StandardParameterController@destroy')->name('StandardParameter.delete');
        //Route::get('StandardParameter', 'StandardParameterController@index')->name('StandardParameter');
        Route::get('/StandardParameter', [
            'uses' => 'StandardParameterController@index',
            'middleware' => 'checkmiddleware:StandardParameter',
        ])->name('StandardParameter');
        Route::get('StandardParametertk', 'StandardParameterController@show')->name('StandardParametertk');

        //Route::get('StandardParameter.create', 'StandardParameterController@create')->name('StandardParameter.create');
        Route::get('/StandardParameter.create', [
            'uses' => 'StandardParameterController@create',
            'middleware' => 'checkmiddleware:StandardParameter.create',
        ])->name('StandardParameter.create');
        Route::post('StandardParameter.create', 'StandardParameterController@store')->name('StandardParameter.create');

        //Route::get('StandardParameter.edit/{id}', 'StandardParameterController@edit')->name('StandardParameter.edit');
        Route::get('/StandardParameter.edit/{id}', [
            'uses' => 'StandardParameterController@edit',
            'middleware' => 'checkmiddleware:StandardParameter.edit',
        ])->name('StandardParameter.edit');
        Route::post('StandardParameter.edit/{id}', 'StandardParameterController@update')->name('StandardParameter.edit');

        //Route::post('StandardParameter.delete/{id}', 'StandardParameterController@destroy')->name('StandardParameter.delete');
        Route::post('/StandardParameter.delete/{id}', [
            'uses' => 'StandardParameterController@destroy',
            'middleware' => 'checkmiddleware:StandardParameter.delete',
        ])->name('StandardParameter.delete');

        /***-- Camera --***/
        // Route::get('Camera', 'CameraController@index')->name('Camera');
        // Route::get('Cameratk', 'CameraController@show')->name('Cameratk');
        // Route::get('Camera.create', 'CameraController@create')->name('Camera.create');
        // Route::post('Camera.create', 'CameraController@store')->name('Camera.create');
        // Route::get('Camera.edit/{id}', 'CameraController@edit')->name('Camera.edit');
        // Route::post('Camera.edit/{id}', 'CameraController@update')->name('Camera.edit');
        // Route::post('Camera.delete/{id}', 'CameraController@destroy')->name('Camera.delete');
        //Route::get('Camera', 'CameraController@index')->name('Camera');
        Route::get('/Camera', [
            'uses' => 'CameraController@index',
            'middleware' => 'checkmiddleware:Camera',
        ])->name('Camera');
        Route::get('Cameratk', 'CameraController@show')->name('Cameratk');

        //Route::get('Camera.create', 'CameraController@create')->name('Camera.create');
        Route::get('/Camera.create', [
            'uses' => 'CameraController@create',
            'middleware' => 'checkmiddleware:Camera.create',
        ])->name('Camera.create');
        Route::post('Camera.create', 'CameraController@store')->name('Camera.create');

        //Route::get('Camera.edit/{id}', 'CameraController@edit')->name('Camera.edit');
        Route::get('/Camera.edit/{id}', [
            'uses' => 'CameraController@edit',
            'middleware' => 'checkmiddleware:Camera.edit',
        ])->name('Camera.edit');
        Route::post('Camera.edit/{id}', 'CameraController@update')->name('Camera.edit');

        //Route::post('Camera.delete/{id}', 'CameraController@destroy')->name('Camera.delete');
        Route::post('/Camera.delete/{id}', [
            'uses' => 'CameraController@destroy',
            'middleware' => 'checkmiddleware:Camera.delete',
        ])->name('Camera.delete');

        /***-- ElectronicBoard --***/
        // Route::get('ElectronicBoard', 'ElectronicBoardController@index')->name('ElectronicBoard');
        // Route::get('ElectronicBoardtk', 'ElectronicBoardController@show')->name('ElectronicBoardtk');
        // Route::get('ElectronicBoard.create', 'ElectronicBoardController@create')->name('ElectronicBoard.create');
        // Route::post('ElectronicBoard.create', 'ElectronicBoardController@store')->name('ElectronicBoard.create');
        // Route::get('ElectronicBoard.edit/{id}', 'ElectronicBoardController@edit')->name('ElectronicBoard.edit');
        // Route::post('ElectronicBoard.edit/{id}', 'ElectronicBoardController@update')->name('ElectronicBoard.edit');
        // Route::post('ElectronicBoard.delete/{id}', 'ElectronicBoardController@destroy')->name('ElectronicBoard.delete');
        //Route::get('ElectronicBoard', 'ElectronicBoardController@index')->name('ElectronicBoard');
        Route::get('/ElectronicBoard', [
            'uses' => 'ElectronicBoardController@index',
            'middleware' => 'checkmiddleware:ElectronicBoard',
        ])->name('ElectronicBoard');
        Route::get('ElectronicBoardtk', 'ElectronicBoardController@show')->name('ElectronicBoardtk');

        //Route::get('ElectronicBoard.create', 'ElectronicBoardController@create')->name('ElectronicBoard.create');
        Route::get('/ElectronicBoard.create', [
            'uses' => 'ElectronicBoardController@create',
            'middleware' => 'checkmiddleware:ElectronicBoard.create',
        ])->name('ElectronicBoard.create');
        Route::post('ElectronicBoard.create', 'ElectronicBoardController@store')->name('ElectronicBoard.create');

        //Route::get('ElectronicBoard.edit/{id}', 'ElectronicBoardController@edit')->name('ElectronicBoard.edit');
        Route::get('/ElectronicBoard.edit/{id}', [
            'uses' => 'ElectronicBoardController@edit',
            'middleware' => 'checkmiddleware:ElectronicBoard.edit',
        ])->name('ElectronicBoard.edit');
        Route::post('ElectronicBoard.edit/{id}', 'ElectronicBoardController@update')->name('ElectronicBoard.edit');

        //Route::post('ElectronicBoard.delete/{id}', 'ElectronicBoardController@destroy')->name('ElectronicBoard.delete');
        Route::post('/ElectronicBoard.delete/{id}', [
            'uses' => 'ElectronicBoardController@destroy',
            'middleware' => 'checkmiddleware:ElectronicBoard.delete',
        ])->name('ElectronicBoard.delete');


         /***-- DischargePoint --***/

        //Route::get('DischargePoint', 'DischargePointController@index')->name('DischargePoint');
        Route::get('/DischargePoint', [
            'uses' => 'DischargePointController@index',
            'middleware' => 'checkmiddleware:DischargePoint',
        ])->name('DischargePoint');
        Route::get('DischargePointtk', 'DischargePointController@show')->name('DischargePointtk');

        //Route::get('DischargePoint.create', 'DischargePointController@create')->name('DischargePoint.create');
        Route::get('/DischargePoint.create', [
            'uses' => 'DischargePointController@create',
            'middleware' => 'checkmiddleware:DischargePoint.create',
        ])->name('DischargePoint.create');
        Route::post('DischargePoint.create', 'DischargePointController@store')->name('DischargePoint.create');

        //Route::get('DischargePoint.edit/{id}', 'DischargePointController@edit')->name('DischargePoint.edit');
        Route::get('/DischargePoint.edit/{id}', [
            'uses' => 'DischargePointController@edit',
            'middleware' => 'checkmiddleware:DischargePoint.edit',
        ])->name('DischargePoint.edit');
        Route::post('DischargePoint.edit/{id}', 'DischargePointController@update')->name('DischargePoint.edit');

        //Route::post('DischargePoint.delete/{id}', 'DischargePointController@destroy')->name('DischargePoint.delete');
        Route::post('/DischargePoint.delete/{id}', [
            'uses' => 'DischargePointController@destroy',
            'middleware' => 'checkmiddleware:DischargePoint.delete',
        ])->name('DischargePoint.delete');

         /***-- Posts --***/

        //Route::get('Post', 'PostController@index')->name('Post');
        Route::get('/Post', [
            'uses' => 'PostController@index',
            'middleware' => 'checkmiddleware:Post',
        ])->name('Post');
        Route::get('Posttk', 'PostController@show')->name('Posttk');

        //Route::get('Post.create', 'PostController@create')->name('Post.create');
        Route::get('/Post.create', [
            'uses' => 'PostController@create',
            'middleware' => 'checkmiddleware:Post.create',
        ])->name('Post.create');
        Route::post('Post.create', 'PostController@store')->name('Post.create');

        //Route::get('Post.edit/{id}', 'PostController@edit')->name('Post.edit');
        Route::get('/Post.edit/{id}', [
            'uses' => 'PostController@edit',
            'middleware' => 'checkmiddleware:Post.edit',
        ])->name('Post.edit');
        Route::post('Post.edit/{id}', 'PostController@update')->name('Post.edit');

        //Route::post('Post.delete/{id}', 'PostController@destroy')->name('Post.delete');
        Route::post('/Post.delete/{id}', [
            'uses' => 'PostController@destroy',
            'middleware' => 'checkmiddleware:Post.delete',
        ])->name('Post.delete');
    });

    Route::group(['prefix' => 'quantri'], function () {
        // Route::get('test', function () {
        //     return "Hàm test";
        // })->middleware('auth');

        //-----Menu-----//
        //Route::get('menu', 'MenuController@index')->name('menu');
        Route::get('/menu', [
            'uses' => 'MenuController@index',
            'middleware' => 'checkmiddleware:menu',
        ])->name('menu');

        Route::get('menutk', 'MenuController@show')->name('menutk');

        //Route::get('menu.create', 'MenuController@create')->name('menu.create');
        Route::get('/menu.create', [
            'uses' => 'MenuController@create',
            'middleware' => 'checkmiddleware:menu.create',
        ])->name('menu.create');
        Route::post('menu.create', 'MenuController@store')->name('menu.create');


        //Route::get('menu.edit/{id}', 'MenuController@edit')->name('menu.edit');
        Route::get('/menu.edit/{id}', [
            'uses' => 'MenuController@edit',
            'middleware' => 'checkmiddleware:menu.edit',
        ])->name('menu.edit');
        Route::post('menu.edit/{id}', 'MenuController@update')->name('menu.edit');


        //Route::post('menu.delete/{id}', 'MenuController@destroy')->name('menu.delete');
        Route::post('/menu.delete/{id}', [
            'uses' => 'MenuController@destroy',
            'middleware' => 'checkmiddleware:menu.delete',
        ])->name('menu.delete');

        //-----Permission-----//
        // Route::get('/permission', [
        //     'as' => 'permission',
        //     'uses' => 'PermissionController@index',
        //     'middleware' => 'checkmiddleware:permission',
        // ])->name('permission');


        // //Route::get('permission', 'PermissionController@index')->name('permission');
        // Route::get('/permission', [
        //     'uses' => 'PermissionController@index',
        //     'middleware' => 'checkmiddleware:permission',
        // ])->name('permission');

        // //Route::get('permission.create', 'PermissionController@create')->name('permission.create');
        // Route::get('/permission.create', [
        //     'uses' => 'PermissionController@create',
        //     'middleware' => 'checkmiddleware:permission.create',
        // ])->name('permission.create');
        // Route::post('permission.create', 'PermissionController@store')->name('permission.create');

        // //Route::get('permission.edit/{id}', 'PermissionController@edit')->name('permission.edit');
        // Route::get('/permission.edit/{id}', [
        //     'uses' => 'PermissionController@edit',
        //     'middleware' => 'checkmiddleware:permission.edit',
        // ])->name('permission.edit');
        // Route::post('permission.edit/{id}', 'PermissionController@update')->name('permission.edit');

        // //Route::post('permission.delete/{id}', 'PermissionController@destroy')->name('permission.delete');
        // Route::post('/permission.delete/{id}', [
        //     'uses' => 'PermissionController@destroy',
        //     'middleware' => 'checkmiddleware:permission.delete',
        // ])->name('permission.delete');

        //-----User-----//
        // Route::get('users', 'UserController@index')->name('users');
        // Route::get('userstk', 'UserController@show')->name('userstk');
        // Route::get('users.create', 'UserController@create')->name('users.create');
        // Route::post('users.create', 'UserController@store')->name('users.create');
        // Route::get('users.edit/{id}', 'UserController@edit')->name('users.edit');
        // Route::post('users.edit/{id}', 'UserController@update')->name('users.edit');
        // Route::post('users.delete/{id}', 'UserController@destroy')->name('users.delete');
        // Route::get('users', 'UserController@index')->name('users');

        Route::get('/users', [
            'uses' => 'UserController@index',
            'middleware' => 'checkmiddleware:users',
        ])->name('users');

        Route::get('userstk', 'UserController@show')->name('userstk');

        //Route::get('users.create', 'UserController@create')->name('users.create');
        Route::get('/users.create', [
            'uses' => 'UserController@create',
            'middleware' => 'checkmiddleware:users.create',
        ])->name('users.create');
        Route::post('users.create', 'UserController@store')->name('users.create');

        //Route::get('users.edit/{id}', 'UserController@edit')->name('users.edit');
        Route::get('/users.edit/{id}', [
            'uses' => 'UserController@edit',
            'middleware' => 'checkmiddleware:users.edit',
        ])->name('users.edit');
        Route::post('users.edit/{id}', 'UserController@update')->name('users.edit');

        //Route::post('users.delete/{id}', 'UserController@destroy')->name('users.delete');
        Route::post('/users.delete/{id}', [
            'uses' => 'UserController@destroy',
            'middleware' => 'checkmiddleware:users.delete',
        ])->name('users.delete');


        //-----role-----//
        // Route::get('role', 'roleController@index')->name('role');
        // Route::get('roletk', 'roleController@show')->name('roletk');
        // Route::get('role.create', 'roleController@create')->name('role.create');
        // Route::post('role.create', 'roleController@store')->name('role.create');
        // Route::get('role.edit/{id}', 'roleController@edit')->name('role.edit');
        // Route::post('role.edit/{id}', 'roleController@update')->name('role.edit');
        // Route::post('role.delete/{id}', 'roleController@destroy')->name('role.delete');

        //Route::get('role', 'roleController@index')->name('role');
        Route::get('/role', [
            'uses' => 'roleController@index',
            'middleware' => 'checkmiddleware:role',
        ])->name('role');
        Route::get('roletk', 'roleController@show')->name('roletk');

        //Route::get('role.create', 'roleController@create')->name('role.create');
        Route::get('/role.create', [
            'uses' => 'roleController@create',
            'middleware' => 'checkmiddleware:role.create',
        ])->name('role.create');
        Route::post('role.create', 'roleController@store')->name('role.create');

        //Route::get('role.edit/{id}', 'roleController@edit')->name('role.edit');
        Route::get('/role.edit/{id}', [
            'uses' => 'roleController@edit',
            'middleware' => 'checkmiddleware:role.edit',
        ])->name('role.edit');
        Route::post('role.edit/{id}', 'roleController@update')->name('role.edit');

        //Route::post('role.delete/{id}', 'roleController@destroy')->name('role.delete');
        Route::post('/role.delete/{id}', [
            'uses' => 'roleController@destroy',
            'middleware' => 'checkmiddleware:role.delete',
        ])->name('role.delete');

        //-----Menus-----//
});


});
