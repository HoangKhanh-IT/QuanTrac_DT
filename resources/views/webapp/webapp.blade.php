<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quan trắc Trà Vinh</title>
    <meta content="width=device-width, maximum-scale = 1, minimum-scale=1" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" name="viewport">
    <meta content="yes" name="mobile-web-app-capable">
    <meta content="yes" name="apple-mobile-web-app-capable">

    <!-- Favicon -->
    <link href="{{ asset('public/webapp/assets/images/SoTNMT.ico') }}" rel="icon" type="image/x-icon" />

    <!-- Main CSS -->
    <link href="{{ asset('public/webapp/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/vendor/bootstrap/css/bootstrap-toggle.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/vendor/bootstrap/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/vendor/bootstrap/fonts/glyphicon.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/assets/css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/assets/css/icomoon/styles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/assets/css/pretty-checkbox/dist/pretty-checkbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/assets/css/material-icon/materialdesignicons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/assets/css/main.css') }}" rel="stylesheet">

    <!-- Map CSS -->
    <link href="{{ asset('public/webapp/assets_map/css/leaflet.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/assets_map/css/leaflet.zoomhome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/assets_map/css/leaflet-gps.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/assets_map/css/Control.FullScreen.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/webapp/assets_map/css/L.Icon.Pulse.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/assets_map/css/L.Control.Basemaps.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/assets_map/css/MapStyle.css') }}" rel="stylesheet">
    <!-- Datatables CSS -->
    <link href="{{ asset('public/webapp/vendor/jquery/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/vendor/bootstrap/css/dataTables.bootstrap3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/vendor/bootstrap/css/select.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/vendor/bootstrap/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/webapp/vendor/bootstrap/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Tree CSS -->
    <link href="{{ asset('public/webapp/assets/css/tree/default/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="navbar-icon-container">
                    <a class="navbar-icon pull-right visible-xs" href="#" id="nav-btn">
                        <i class="fa fa-users fa-lg blue" style="font-size: 20px"></i>
                    </a>
                    <a class="navbar-icon pull-right visible-xs" href="#" id="sidebar-toggle-btn">
                        <i class="fa fa-list fa-lg blue" style="font-size: 20px"></i>
                    </a>
                </div>
                <div class="hidden-xs" style="float: left">
                    <a data-target=".navbar-collapse.in" data-toggle="collapse" href="#" id="list-btn">
                        <i class="fa fa-list blue collapse_menu"></i>
                    </a>
                </div>
                <img id="logo" src="{{ asset('public/webapp/assets/images/SoTNMT.png') }}" />
                <div class="title">
                    <div id="titlefont1">SỞ TÀI NGUYÊN VÀ MÔI TRƯỜNG TỈNH TRÀ VINH</div>
                    <div id="titlefont2">CHẤT LƯỢNG MÔI TRƯỜNG TỈNH TRÀ VINH</div>
                </div>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav" style="margin-top: 1.25%">
                    <li>
                        <a data-target=".navbar-collapse.in" data-toggle="collapse" href="master" id="admin-btn">
                            <i class="icon-newspaper blue" style="font-size: 16px; margin-top: -2px;"></i> &nbsp;&nbsp;Tin tức
                        </a>
                    </li>
                    <li>
                        <a data-target=".navbar-collapse.in" data-toggle="collapse" href="master" id="admin-btn">
                            <i class="icon-table2 blue" style="font-size: 16px; margin-top: -2px;"></i> &nbsp;&nbsp;Quản trị
                        </a>
                    </li>
                    <li>
                        <a data-target=".navbar-collapse.in" data-toggle="collapse" href="#" id="about-btn">
                            <i class="icon-accessibility blue" style="font-size: 16px; margin-top: -2px;"></i> &nbsp;&nbsp;Về chúng tôi
                        </a>
                    </li>
                    <!-- <li>
                        <a data-target=".navbar-collapse.in" data-toggle="collapse" href="#" id="login-btn">
                            <i class="fa fa-user blue" style="font-size: 16px; margin-top: -2px;"></i> &nbsp;&nbsp;Admin
                        </a>
                    </li> -->
                </ul>
            </div>
            <!--/.navbar-collapse -->
        </div>
    </div>

    <div id="container" style="top: 10%">
        <div id="sidebar">
            <div class="sidebar-wrapper">
                <div class="panel panel-default" id="features">
                    <!-- Tìm kiếm dữ liệu -->
                    <div class="panel-heading" data-toggle="collapse" href="#search_tramqt" style="border-top: unset">
                        <h3 class="panel-title blue">
                            <i class="icon-cog52" style="font-size: 16px; margin-top: -2px;"></i>&nbsp;&nbsp;&nbsp;Tìm kiếm dữ liệu
                        </h3>
                    </div>
                    <div class="panel-body collapse" id="search_tramqt" aria-multiselectable="true">
                        <div class="panel">
                            <div class="col-xs-12 col-md-12" data-toggle="collapse" data-parent="#search_tramqt" aria-expanded="true" aria-controls="search_basic" href="#search_basic" id="search_basic_heading">
                                <i class="fa fa-location-arrow" style="font-size: 16px; margin-top: -2px; color: #999"></i>
                                <span class="panel-search" style="font-weight: bold;">&nbsp;&nbsp;
                                    Tìm kiếm cơ bản</span>
                                <i class="glyphicon glyphicon-triangle-bottom" style="font-size: 13px; color: #999"></i>
                            </div>
                            <div class="collapse in" id="search_basic">
                                <div class="col-xs-12 col-md-12">
                                    <form class="navbar-form navbar-left" role="search" style="margin-bottom: -5px">
                                        <div class="form-group has-feedback">
                                            <span class="fa fa-search form-control-feedback blue" id="searchicon"></span>
                                            <input class="form-control" id="searchbox" placeholder="Nhập tên vị trí" type="text" onclick="Refresh_Option()" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <hr class="line-search">
                        </div>
                        <div class="panel">
                            <div class="col-xs-8 col-md-8" data-toggle="collapse" data-parent="#search_tramqt" aria-expanded="false" aria-controls="search_advanced" href="#search_advanced" id="search_advanced_heading">
                                <i class="mdi mdi-map-search" style="font-size: 16px; margin-top: -2px; color: #999"></i>
                                <span class="panel-search" style="font-weight: bold;">&nbsp;&nbsp;
                                    Tìm kiếm nâng cao</span>
                                <i class="glyphicon glyphicon-triangle-bottom" style="font-size: 13px; color: #999"></i>
                            </div>
                            <div class="collapse" id="search_advanced">
                                <div class="col-xs-12 col-md-12 search-advanced-titles">
                                    <i class="icon-lab blue" style="font-size: 14px; margin-top: -2px"></i>
                                    <span for="loaihinh" style="margin-left: 1px">&nbsp;Loại hình</span>
                                </div>
                                <div class="form-group col-xs-12 col-md-12 search-advanced">
                                    <div id="loaihinh"></div>
                                </div>
                                <div class="col-xs-12 col-md-12 search-advanced-titles">
                                    <i class="icon-server blue" style="font-size: 14px; margin-top: -2px"></i>
                                    <span for="loaitram" style="margin-left: 1px">&nbsp;Loại trạm</span>
                                </div>
                                <div class="form-group col-xs-12 col-md-12 search-advanced">
                                    <select class="form-control" id="loaitram">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-12 search-advanced-titles">
                                    <i class="icon-location3 blue" style="font-size: 14px; margin-top: -2px"></i>
                                    <span for="district" style="margin-left: 1px">&nbsp;Huyện, Thị xã</span>
                                </div>
                                <div class="form-group col-xs-12 col-md-12 search-advanced">
                                    <select class="form-control" id="district">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-12 search-advanced-titles">
                                    <i class="mdi mdi-map-legend blue" style="font-size: 14px; margin-top: -2px"></i>
                                    <span for="locType" style="margin-left: 1px">&nbsp;Loại địa danh</span>
                                </div>
                                <div class="form-group col-xs-12 col-md-12 search-advanced">
                                    <select class="form-control" id="locType">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-12 search-advanced-titles">
                                    <i class="mdi mdi-location-enter blue" style="font-size: 14px; margin-top: -2px"></i>
                                    <span for="location" style="margin-left: 1px">&nbsp;Địa danh</span>
                                </div>
                                <div class="form-group col-xs-12 col-md-12 search-advanced">
                                    <select class="form-control" id="location">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                                <!-- <div class="col-xs-12 col-md-12" style="margin-bottom: 10px">
                                    <button class="btn btn-primary btn-block" id="search-advanced-btn" type="button" onclick="search_list_tramqt()">
                                        <i class="icon-cog5" style="font-size: 16px; margin-top: -1px"></i>&nbsp;&nbsp;Danh sách trạm tìm kiếm
                                    </button>
                                </div> -->
                                <div class="col-xs-12 col-md-12 search-advanced-titles">
                                    <i class="icon icon-store blue" style="font-size: 14px; margin-top: -2px"></i>
                                    <span for="quantrac">&nbsp;Trạm quan trắc</span>
                                </div>
                                <div class="form-group col-xs-12 col-md-12 search-advanced">
                                    <select class="form-control" id="quantrac" onchange="search_tramqt()">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                                <!-- DOM kết quả thẻ div Search Error và Search Success -->
                                <div class="form-group col-xs-12 col-md-12 search-error" style="display: none">
                                    <i class="icon-alert" style="font-size: 16px; margin-top: -1px"></i>
                                    <span>&nbsp;Không tìm thấy trạm quan trắc</span>
                                </div>
                                <div class="form-group col-xs-12 col-md-12 search-success" style="display: none">
                                    <i class="icon-check" style="font-size: 20px; margin-top: -1px"></i>
                                    <span id="success_alert"></span>
                                </div>
                                <!-- Thêm 1 thẻ div để đẩy thẻ div sau ra giữa khung navbar
                                <div class="col-xs-1 col-md-1"></div>
                                <div class="col-xs-10 col-md-10" style="margin-bottom: 10px; margin-top: 6px">
                                    <button class="btn btn-success btn-block" id="search-advanced-btn" type="button" onclick="search_tramqt()">
                                        <i class="icon-arrow-right16" style="font-size: 16px; margin-top: -1px"></i>&nbsp;&nbsp;Đi đến trạm
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Công cụ hỗ trợ -->
                    <div class="panel-heading" data-toggle="collapse" href="#tools_qt">
                        <h3 class="panel-title blue">
                            <i class="icon-wrench" style="font-size: 16px; margin-top: -2px;"></i>&nbsp;&nbsp;&nbsp;Công cụ hỗ trợ và thống kê quan trắc
                        </h3>
                    </div>
                    <div class="panel-body collapse" id="tools_qt">
                        <!-- <div class="row toggle_cus">
                            <div class="col-xs-6 col-md-6">
                                <input data-off="Tắt" data-on="Bật" data-onstyle="success" data-offstyle="danger"
                                       data-style="ios" data-toggle="toggle" id="switchbutton_screen" type="checkbox">
                            </div>
                            <div class="nav-titles-icon default_icon">
                                <i class="fa fa-desktop legend-icon" style="margin-left: 19%"></i>
                            </div>
                            <label class="nav-titles nav-titles-default">Mở rộng màn hình</label>
                        </div> -->
                        <!-- <div class="row toggle_cus">
                            <div class="col-xs-6 col-md-6">
                                <input data-off="Tắt" data-on="Bật" data-onstyle="warning" data-offstyle="info"
                                       data-style="ios" data-toggle="toggle" id="switch_legend" type="checkbox">
                            </div>
                            <div class="nav-titles-icon default_icon">
                                <i class="icon-inbox legend-icon"></i>
                            </div>
                            <label class="nav-titles nav-titles-default">Chú thích bản đồ</label>
                        </div> -->
                        <div class="col-xs-6 col-md-6" style="margin-bottom: 10px">
                            <button class="btn btn-info btn-block" id="upload-btn" type="button" style="padding-left: 7%;">
                                <!-- <i class="icon-warning" style="font-size: 16px; margin-top: -1px"></i> -->
                                <label style="font-size: 10pt">Upload File</label>
                            </button>
                        </div>
                        <div class="col-xs-6 col-md-6" style="margin-bottom: 10px">
                            <button class="btn btn-warning btn-block" id="threshold-btn" type="button" style="padding-left: 7%;">
                                <!-- <i class="icon-warning" style="font-size: 16px; margin-top: -1px"></i> -->
                                <label style="font-size: 10pt">DS vượt ngưỡng</label>
                            </button>
                        </div>
                        <div class="col-xs-6 col-md-6" style="margin-bottom: 10px">
                            <button class="btn btn-success btn-block" id="statistic-btn" type="button">
                                <i class="icon-chart" style="font-size: 16px; margin-top: -1px"></i>
                                <label style="font-size: 10pt">&nbsp;Thống kê</label>
                            </button>
                        </div>
                        <div class="col-xs-6 col-md-6" style="margin-bottom: 10px">
                            <button class="btn btn-danger btn-block" id="WQI_AQI_btn" type="button" style="padding-left: 7%;">
                                <!-- <i class="icon-warning" style="font-size: 16px; margin-top: -1px"></i> -->
                                <label style="font-size: 10pt">AQI - WQI</label>
                            </button>
                        </div>
                    </div>
                    <!-- Lớp dữ liệu -->
                    <div class="panel-heading panel-data-quantrac" data-toggle="collapse" href="#data_layer_tramqt" >
                        <h3 class="panel-title blue">
                            <i class="glyphicon glyphicon-list-alt" style="font-size: 16px; margin-top: -5px;"></i>&nbsp;&nbsp;&nbsp;Lớp dữ liệu trạm quan trắc
                            <!-- <button class="btn btn-xs btn-default pull-right" id="sidebar-hide-btn" type="button">
                                <i class="fa fa-chevron-left blue" style="font-size: 16px; margin-top: -2px;"></i>
                            </button> -->
                            <!-- <button class="btn btn-xs btn-default btn-cus pull-right" type="button"
                                    data-toggle="collapse" href="#data_layer_tramqt">
                                <i class="fa fa-chevron-down blue" style="font-size: 16px; margin-top: -2px;"></i>
                            </button> -->
                        </h3>
                    </div>
                    <div class="panel-body collapse in" id="data_layer_tramqt">
                        <!-- Trạm quan trắc
                        <div class="row panel-map">
                            <div class="col-xs-12 col-md-12">
                                <i class="icon-map4" style="font-size: 16px; margin-top: -2px; color: #999"></i>
                                <span class="panel-search">&nbsp;&nbsp;Chú thích loại hình trạm quan trắc</span>
                            </div>
                        </div> -->
                        <div class="row toggle_cus">
                            <!-- <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật" data-size="small"
                                       data-style="ios" data-toggle="toggle" id="qt_dat_data" type="checkbox">
                            </div> -->
                            <div class="nav-titles-icon tramqt_dat_icon">
                                <i class="icon-checkbox-unchecked2 legend-icon" style="margin-top: 1%"></i>
                            </div>
                            <label class="nav-titles tramqt_dat_label">Trạm quan trắc đất</label>
                        </div>
                        <div class="row toggle_cus">
                            <!-- <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật" data-size="small"
                                       data-style="ios" data-toggle="toggle" id="qt_khongkhi_data" type="checkbox">
                            </div> -->
                            <div class="nav-titles-icon tramqt_khongkhi_icon">
                                <i class="glyphicon glyphicon-cloud legend-icon"></i>
                            </div>
                            <label class="nav-titles tramqt_khongkhi_label">Trạm quan trắc không khí</label>
                        </div>
                        <div class="row toggle_cus">
                            <!-- <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật" data-size="small"
                                       data-style="ios" data-toggle="toggle" id="qt_nuocmat_data" type="checkbox">
                            </div> -->
                            <div class="nav-titles-icon tramqt_nuocmat_icon">
                                <i class="icon-wave2 legend-icon" style="margin-left: 19%"></i>
                            </div>
                            <label class="nav-titles tramqt_nuocmat_label">Trạm quan trắc nước mặt</label>
                        </div>
                        <div class="row toggle_cus">
                            <!-- <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật" data-size="small"
                                       data-style="ios" data-toggle="toggle" id="qt_nuocngam_data" type="checkbox">
                            </div> -->
                            <div class="nav-titles-icon tramqt_nuocngam_icon">
                                <i class="icon-graph legend-icon"></i>
                            </div>
                            <label class="nav-titles tramqt_nuocngam_label">Trạm quan trắc nước ngầm</label>
                        </div>
                        <div class="row toggle_cus">
                            <!-- <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật" data-size="small"
                                       data-style="ios" data-toggle="toggle" id="qt_nuocthai_data" type="checkbox">
                            </div> -->
                            <div class="nav-titles-icon tramqt_nuocthai_icon">
                                <i class="icon-alert legend-icon"></i>
                            </div>
                            <label class="nav-titles tramqt_nuocthai_label">Trạm quan trắc nước thải</label>
                        </div>
                        <div class="row toggle_cus">
                            <!-- <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật" data-size="small"
                                       data-style="ios" data-toggle="toggle" id="qt_nuocthai_data" type="checkbox">
                            </div> -->
                            <div class="nav-titles-icon tramqt_nuocbien_icon">
                                <i class="icon-air legend-icon"></i>
                            </div>
                            <label class="nav-titles tramqt_nuocbien_label">Trạm quan trắc nước biển ven bờ</label>
                        </div>
                        <div class="row toggle_cus">
                            <!-- <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật" data-size="small"
                                       data-style="ios" data-toggle="toggle" id="qt_nuocthai_data" type="checkbox">
                            </div> -->
                            <div class="nav-titles-icon bangdientu_icon" style="border-radius: 25%">
                                <i class="icon-table2 legend-icon"></i>
                            </div>
                            <label class="nav-titles electric_label">Bảng điện tử</label>
                        </div>
                        <div class="row toggle_cus">
                            <!-- <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật" data-size="small"
                                       data-style="ios" data-toggle="toggle" id="qt_nuocthai_data" type="checkbox">
                            </div> -->
                            <div class="nav-titles-icon diemxathai_icon" style="border-radius: 25%">
                                <i class="icon-circle-code legend-icon"></i>
                            </div>
                            <label class="nav-titles discharge_label">Điểm xả thải</label>
                        </div>
                        <!-- Đơn vị hành chính
                        <div class="row panel-map">
                            <div class="col-xs-10 col-md-10">
                                <i class="icon-bookmark" style="font-size: 16px; margin-top: -2px; color: #999"></i>
                                <span class="panel-search">&nbsp;&nbsp;Đơn vị hành chính và quản lý nhãn</span>
                            </div>
                        </div>
                        <div class="row toggle_cus">
                            <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật"
                                       data-style="ios" data-toggle="toggle" id="hanhchinh_data" type="checkbox">
                            </div>
                            <div class="nav-titles-icon hanhchinh_icon">
                                <i class="icon-map5 legend-icon"></i>
                            </div>
                            <label class="nav-titles hanhchinh-label">Hành chính huyện/thành phố</label>
                        </div>
                        <div class="row toggle_cus">
                            <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật"
                                       data-style="ios" data-toggle="toggle" id="label_quantrac" type="checkbox">
                            </div>
                            <div class="nav-titles-icon default_icon">
                                <i class="icon-info3 legend-icon"></i>
                            </div>
                            <label class="nav-titles nav-titles-default">Nhãn trạm quan trắc</label>
                        </div>
                        <div class="row toggle_cus">
                            <div class="col-xs-6 col-md-6">
                                <input checked data-off="Tắt" data-on="Bật"
                                       data-style="ios" data-toggle="toggle" id="label_hanhchinh" type="checkbox">
                            </div>
                            <div class="nav-titles-icon default_icon">
                                <i class="icon-info3 legend-icon"></i>
                            </div>
                            <label class="nav-titles nav-titles-default">Nhãn đơn vị hành chính</label>
                        </div> -->
                    </div>
                    <!-- Hướng dẫn sử dụng -->
                    <div class="panel-heading" data-toggle="collapse" href="#help_qt">
                        <h3 class="panel-title blue">
                            <i class="icon-help" style="font-size: 16px; margin-top: -2px;"></i>&nbsp;&nbsp;&nbsp;Hướng dẫn sử dụng
                        </h3>
                    </div>
                    <div class="panel-body collapse" id="help_qt">
                        <div class="col-xs-8 col-md-8">
                            <i class="fa fa-file" style="font-size: 16px; margin-top: -2px; color: #999"></i>
                            <a class="panel-help" href="{{ asset('public/webapp/assets/text/HDSD_QuanTracTraVinh.docx') }}">Tài liệu hướng dẫn</a>
                        </div>
                        <div class="col-xs-8 col-md-8" style="margin-top: 10px">
                            <i class="fa fa-barcode" style="font-size: 16px; margin-top: -2px; color: #999"></i>
                            <span class="panel-version">Phiên bản&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span class="badge bg-info panel-version-style">1.0.1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="mymap"></div>
    </div>

    <!-- <div id="loading">
        <div class="loading-indicator">
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-info progress-bar-full"></div>
            </div>
        </div>
    </div> -->

    <!-- Modal giới thiệu Dự án -->
    <div class="modal fade" id="aboutModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title" style="text-transform: uppercase">
                        <i class="icon-profile" style="font-size: 16px; margin-top: -2px"></i> Giới thiệu về hệ thống quan trắc Trà Vinh
                    </h4>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-justified" id="aboutTabs">
                        <li class="active">
                            <a data-toggle="tab" href="#about">
                                <i class="fa fa-question-circle" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Giới thiệu về dự án
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#contact">
                                <i class="fa fa-envelope" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Liên hệ chúng tôi
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#developers">
                                <i class="fa fa-exclamation-circle" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Đơn vị phát triển phần mềm
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="aboutTabsContent">
                        <div class="tab-pane fade active in" id="about">
                            <p>Hệ thống truyền, nhận, quản lý và công bố dữ liệu các hệ thống quan trắc môi trường của tỉnh Trà Vinh tích hợp số liệu quan trắc các nguồn thải từ các khu công nghiệp, khu chế xuất và khu công nghệ cao nói riêng và quan trắc
                                nguồn điểm nói chung nhằm mục đích bảo vệ nguồn tiếp nhận (sông, hồ), đảm bảo chất lượng nước thải của các khu công nghiệp, khu chế xuất, khu công nghệ cao trước khi thải vào nguồn tiếp nhận;</p>
                            <div class="panel panel-primary">
                                <div class="panel-heading">Các nguồn tiếp nhận</div>
                                <ul class="list-group">
                                    <li class="list-group-item">Các trạm quan trắc tự động</li>
                                    <li class="list-group-item">Các trạm quan trắc bán tự động</li>
                                    <li class="list-group-item">Các doanh nghiệp xả thải trên 1000 m³</li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade text-danger" id="developers">
                            <p>Trung tâm ứng dụng công nghệ thông tin phía Nam</p>
                            <!-- <p>(Cục CNTT và dữ liệu Tài nguyên môi trường - Bộ TN & MT)</p> -->
                            <p>
                                <i class="icon-location4 blue" style="font-size: 16px; margin-top: -2px"></i>
                                <a href="http://tiny.cc/2btqmz" target="_blank">
                                    Số 36, Lý Văn Phức, P. Tân Định, Q. 1, TP. HCM
                                </a>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="contact">
                            <form class="contact-form">
                                <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="first-name">Họ:</label>
                                                <input class="form-control" id="firstname" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="last-name">Tên:</label>
                                                <input class="form-control" id="lastemail" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <input class="form-control" id="email" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="message">Tin nhắn:</label>
                                            <textarea class="form-control" id="message" rows="8"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <p>
                                                <button class="btn btn-primary pull-right" id="sendmail" 
												data-dismiss="modal" type="submit">Gửi đến chúng tôi
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title">Đăng nhập</h4>
                </div>
                <div class="modal-body">
                    <form class="user-form">
                        <fieldset>
                            <div class="form-group">
                                <i class="icon-user" style="font-size: 14px; margin: -2px 2px 0px 0px"></i>
                                <label for="name">&nbsp;Thông tin tài khoản:</label>
                                <span id="user-admin">&nbsp;Quản trị</span>
                            </div>
                            <button class="col-md-12 form-group">
                                <i class="icon-lock" style="font-size: 16px; margin-top: -2px"></i>
                                <label for="">&nbsp;Quyền hạn sử dụng</label>
                                <!-- <input class="form-control" id="password" type="password"> -->
                            </button>
                            <button class="col-md-12 form-group">
                                <i class="icon-wrench2" style="font-size: 16px; margin-top: -2px"></i>
                                <label for="">&nbsp;Cài đặt tài khoản</label>
                                <!-- <input class="form-control" id="password" type="password"> -->
                            </button>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" type="submit">Đăng xuất</button>
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal thuộc tính điểm Quan trắc (cho trạm tự động) -->
    <div class="modal fade" id="featureModal" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" style="margin-top: 0%; margin-left: 15%">
            <div class="modal-content modal-feature">
                <div class="modal-header">
                    <button aria-hidden="true" class="close closemodal" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title text-primary feature-title"></h4>
                </div>
                <div class="modal-body" id="feature-info">
                    <ul class="nav nav-tabs nav-justified" id="">
                        <li class="active">
                            <a data-toggle="tab" href="'#info_data_qt">
                                Thông tin trạm và số liệu mới
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="'#chart_data_qt">
                                <i class="icon-chart" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Lịch sử số liệu
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="feature-result-TabsContent">
                        <div class="tab-pane fade active in" id="info_data_qt">
                            <i class="icon-info3" style="font-size: 16px; margin-top: -2px; padding-left: 15px"></i> &nbsp;Thông tin trạm
                            <div class="info_qt"></div>
                            <i class="icon-table" style="font-size: 16px; margin-top: -2px; padding-left: 15px"></i> &nbsp;Số liệu mới nhất
                            <div id="data_qt" style="padding-right: 10px; margin-top: 5px; padding-top: 5px;"></div>
                        </div>
                        <!-- <div class="tab-pane fade" id="data_qt"></div> -->
                        <div class="tab-pane fade" id="chart_data_qt">
                            <!-- DOM chart lựa chọn theo thời gian -->
                            <div class="form-group col-xs-4 col-md-4">
                                <i class="icon-database-time2 blue" style="font-size: 16px; margin-top: -1px; padding-left: 15px"></i> &nbsp;
                                <span for="" class="blue" style="margin-left: 1px">&nbsp;Thời gian</span>
                                <select class="form-control" id="filter_time">
                                    <option value="filter_1h_chart">1 giờ</option>
                                    <option value="filter_8h_chart">8 giờ</option>
                                    <option value="filter_24h_chart">24 giờ</option>
                                </select>
                            </div>

                            <!-- DOM chart lựa chọn theo thông số -->
                            <div class="form-group col-xs-4 col-md-4">
                                <i class="icon-list-numbered blue" style="font-size: 16px; margin-top: -1px; padding-left: 15px"></i> &nbsp;
                                <span for="" class="blue" style="margin-left: 1px">&nbsp;Thông số</span>
                                <select class="form-control" id="filter_parameters">
                                    <!-- DOM from JSON -->
                                </select>
                            </div>

                            <!-- DOM chart lựa chọn theo kiểu chart -->
                            <div class="form-group col-xs-4 col-md-4">
                                <i class="icon-chart blue" style="font-size: 16px; margin-top: -1px; padding-left: 15px"></i> &nbsp;
                                <span for="" class="blue" style="margin-left: 1px">&nbsp;Biểu đồ</span>
                                <select class="form-control" id="filter_typechart">
                                    <option value="filter_column_chart">Biểu đồ cột</option>
                                    <option value="filter_line_chart">Biểu đồ đường</option>
                                </select>
                            </div>

                            <!-- DOM thông báo khi không có dữ liệu hiển thị chart -->
                            <p id="info_dom_chart"></p>
                            <div id="chart_para" class="gender-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default closemodal" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal thuộc tính điểm Quan trắc (cho trạm bán tự động) -->
    <div class="modal fade" id="featureModal-btd" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" style="margin-top: 2%; margin-left: 15%">
            <div class="modal-content modal-feature">
                <div class="modal-header">
                    <button aria-hidden="true" class="close closemodal" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title text-primary feature-title"></h4>
                </div>
                <div class="modal-body">
                    <div>
                        <i class="icon-info3" style="font-size: 16px; margin-top: -2px; padding-left: 0px"></i> &nbsp;Thông tin trạm
                        <div class="info_qt" style="padding: 10px 0 10px 0"></div>
                        <i class="icon-database-time2" style="font-size: 16px;
                            margin-top: -2px; padding-left: 0px"></i> &nbsp;Xem số liệu theo từng đợt
                    </div>
                    <form class="filter-time-form">
                        <fieldset>
                            <div class="form-group" style="padding-top: 5px">
                                <div class="col-xs-2 col-md-2" style="margin-top: 1%"><b>Từ ngày</b></div>
                                <div class="form-group col-xs-4 col-md-4">
                                    <!-- <input class="form-control" id="FromDate_data" type="date"> -->
                                    <div class="form-group">
                                        <div class='input-group date' id='FromDate_data'>
                                            <input type='text' class="form-control" placeholder="dd/MM/yyyy" />
                                            <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-md-2" style="margin-top: 1%"><b>Đến ngày</b></div>
                                <div class="form-group col-xs-4 col-md-4">
                                    <!-- <input class="form-control" id="ToDate_data" type="date"> -->
                                    <div class='input-group date' id='ToDate_data'>
                                        <input type='text' class="form-control" placeholder="dd/MM/yyyy" />
                                        <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" data-dismiss="modal" type="submit" id="sample-btn">Xem dữ liệu</button>
                    <button class="btn btn-default closemodal reset_input" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal bảng điện tử -->
    <div class="modal fade" id="featureModal-eletric" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" style="margin-top: 2%; margin-left: 16%">
            <div class="modal-content modal-feature">
                <div class="modal-header">
                    <button aria-hidden="true" class="close closemodal" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title text-primary feature-title"></h4>
                </div>
                <div class="modal-body">
                    <div>
                        <!-- <i class="icon-info3" style="font-size: 16px; margin-top: -2px; padding-left: 0px"></i> &nbsp;Thông tin trạm -->
                        <div class="info_eletric" style="padding: 10px 0 10px 0"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default closemodal_electric reset_input" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal điểm xả thải -->
    <div class="modal fade" id="featureModal-discharge" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" style="margin-top: 8%; margin-left: 16%">
            <div class="modal-content modal-feature">
                <div class="modal-header">
                    <button aria-hidden="true" class="close closemodal" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title text-primary feature-title"></h4>
                </div>
                <div class="modal-body">
                    <div>
                        <!-- <i class="icon-info3" style="font-size: 16px; margin-top: -2px; padding-left: 0px"></i> &nbsp;Thông tin trạm -->
                        <div class="info_discharge" style="padding: 10px 0 10px 0"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default closemodal_discharge reset_input" data-dismiss="modal" type="button">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal danh sách mẫu/đợt của trạm bán tự động -->
    <div class="modal fade" id="sampleModal" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sample">
            <div class="modal-content" style="border-radius: 0">
                <div class="modal-header" style="border-bottom-color: #00a709">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title green" style="font-weight: bold; text-transform: uppercase">
                        <i class="icon-table2 green" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Thông tin dữ liệu
                    </h4>
                </div>
                <div class="modal-body modal-body-sample">
                    <!-- Demo bảng vượt ngưỡng -->
                    <table class="table table-striped table-hover table-bordered table-condensed table-responsive" id="table_sample">
                        <thead>
                        <tr class="bg-info" role="row" style="color: #000">
                            <th scope="col" class="bg-info fixed_header"></th>
                            <th scope="col" class="bg-info fixed_header">Tên Mẫu</th>
                            <!-- Ngày và giờ lấy mẫu gộp chung -->
                            <th scope="col" class="bg-info fixed_header">Thời gian lấy mẫu</th>
                            <th scope="col" class="bg-info fixed_header">Ngày phân tích mẫu</th>
                            <th scope="col" class="bg-info fixed_header">Vị trí lấy mẫu</th>
                            <th scope="col" class="bg-info fixed_header">Thời tiết</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Dom data vượt ngưỡng -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal danh sách Vượt ngưỡng -->
    <div class="modal fade" id="thresholdModal" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-threshold">
            <div class="modal-content" style="border-radius: 0">
                <div class="modal-header" style="border-bottom-color: #ee0000">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title red" style="font-weight: bold; text-transform: uppercase">
                        <i class="icon-warning red" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Danh sách vượt ngưỡng
                    </h4>
                </div>
                <div class="modal-body modal-body-threshold">
                    <table class="table table-striped table-bordered table-condensed table-responsive" cellspacing="0" width="100%" id="table_threshold">
                        <thead>
                        <tr class="bg-info" role="row" style="color: #000">
                            <th scope="col" class="bg-info fixed_header"></th>
                            <th scope="col" class="bg-info fixed_header">Tên trạm</th>
                            <th scope="col" class="bg-info fixed_header">Loại hình</th>
                            <th scope="col" class="bg-info fixed_header">Loại trạm</th>
                            <th scope="col" class="bg-info fixed_header">Địa điểm</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Dom data vượt ngưỡng -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal AQI/WQI -->
    <div class="modal fade" id="WQI_AQI_Modal" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-WQI-AQI">
            <div class="modal-content" style="border-radius: 0">
                <div class="modal-header" style="border-bottom-color: #ff6810">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title brown" style="font-weight: bold; text-transform: uppercase">
                        <i class="fa fa-envira brown" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Đánh giá chất lượng môi trường
                    </h4>
                </div>
                <div class="modal-body modal-body-WQI-AQI">
                    <form class="WQI-AQI-form">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-lab brown" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="loaihinh_WA" class="black" style="margin-left: 1px">&nbsp;Loại hình</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="loaihinh_WA">
                                        <option selected value="2">Nước mặt</option>
                                        <option value="1">Không khí</option>
                                        option
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-server brown" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="loaitram_WA" class="black" style="margin-left: 1px">&nbsp;Loại trạm</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="loaitram_WA">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-location3 brown" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="district_WA" class="black" style="margin-left: 1px">&nbsp;Huyện/Thị xã</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="district_WA">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-home4 brown" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="" class="black" style="margin-left: 1px">&nbsp;Trạm quan trắc</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced" style="height: 30px !important;">
                                    <input class="form-control" id="search_quantrac_WA" type="text">
                                    <i class="icon-search4 black" id="search_WAs_tramqt"></i>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-database-time2 brown" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="" class="black" style="margin-left: 1px">&nbsp;Từ ngày</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <div class='input-group date' id='FromDate_WA'>
                                        <input type='text' class="form-control" placeholder="dd/MM/yyyy" />
                                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-database-time2 brown" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="" class="black" style="margin-left: 1px">&nbsp;Đến ngày</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <div class='input-group date' id='ToDate_WA'>
                                        <input type='text' class="form-control" placeholder="dd/MM/yyyy" />
                                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="fa fa-envira brown" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="quality_WA" class="black" style="margin-left: 1px">&nbsp;Chỉ số môi trường</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="quality_WA">
                                        <option selected value="WQI">Chỉ số chất lượng nước (WQI)</option>
                                        <option value="AQI">Chỉ số chất lượng không khí (AQI)</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" type="submit" id="WQI-AQI-result-btn">Kết quả</button>
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Kết quả WQI/AQI -->
    <div class="modal fade" id="re_WA_Modal" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-re-WA">
            <div class="modal-content" style="border-radius: 0">
                <div class="modal-header" style="border-bottom-color: #ff6810">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title brown" style="font-weight: bold; text-transform: uppercase">
                        <i class="fa fa-envira brown" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Đánh giá chất lượng môi trường
                    </h4>
                </div>
                <div class="modal-body modal-body-re-WA" style="overflow: unset">
                    <div class="form-group col-xs-7 col-md-7" style="padding: 0px">
                        <a href="#" id="export_AQIWQI_Excel" class="btn btn-danger" role="button">EXCEL</a>
                        <a href="#" id="export_AQIWQI_PDF" class="btn btn-danger" role="button">PDF</a>
                    </div>
                    <div class="form-group col-xs-1 col-md-1" style="padding: 0px">
                        <i class="fa fa-search brown" style="font-size: 20px;
                        margin-left: 60%; margin-top: 6%;"></i>
                    </div>
                    <div class="form-group col-xs-4 col-md-4" style="padding: 0px">
                        <input class="form-control" type="text"
                               placeholder="Tìm kiếm ..." id="search_WA">
                    </div>
                    <div class="form-group col-xs-12 col-md-12" id="tab_AQIWQI_stat">
                        <table class="table table-striped table-bordered table-condensed table-responsive" cellspacing="0" width="100%" id="table_re_WA">
                            <thead>
                                <tr class="bg-info" role="row" style="color: #000">
                                    <th scope="col" class="bg-info fixed_header">Tên trạm</th>
                                    <th scope="col" class="bg-info fixed_header">Ngày</th>
                                    <th scope="col" class="bg-info fixed_header">Giá trị</th>
                                    <th scope="col" class="bg-info fixed_header">Mức độ</th>
                                    <th scope="col" class="bg-info fixed_header">Mục đích</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- Dom data WQI/AQI -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button" id="WQI-AQI-return">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Upload File -->
    <div class="modal fade" id="uploadFileModal" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-uploadFile">
            <div class="modal-content" style="border-radius: 0">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title blue" style="font-weight: bold; text-transform: uppercase">
                        <i class="blue" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Chuyển dữ liệu bán tự động
                    </h4>
                </div>
                <div class="modal-body modal-body-uploadFile">
                    <form>
                        <fieldset>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-yelp blue" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="standardUpload" class="black" style="margin-left: 1px">&nbsp;Quy chuẩn</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="standardUpload">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-certificate blue" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="purposeUpload" class="black" style="margin-left: 1px">&nbsp;Mục đích sử dụng</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="purposeUpload">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-file-spreadsheet blue" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="" class="black" style="margin-left: 1px">&nbsp;Chọn file</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <input type="file" id="excelfile">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-file-excel blue" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="" class="black" style="margin-left: 1px">
                                        <a href="public/webapp/assets/text/File_test_import.xlsx">&nbsp;File mẫu</a>
                                    </span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <button type="button" name="upload" onClick="ProcessExcel()"
                                            class="form-control btn btn-info">Chuyển dữ liệu bán tự động</button>
                                </div>
                            </div>
                            <!-- DOM kết quả thẻ div Search Error và Search Success -->
                            <div class="form-group">
                                <div class="col-xs-12 col-md-12 upload-error" style="text-align: center; display: none">
                                    <i class="icon-alert" style="color: #FF0000; font-size: 16px; margin-top: -1px"></i>
                                    <span id="error_upload" style="color: #FF0000"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-md-12 upload-success" style="text-align: center; display: none">
                                    <i class="icon-check" style="color: #008000; font-size: 20px; margin-top: -1px"></i>
                                    <span id="success_upload" style="color: #008000"></span>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thống kê -->
    <div class="modal fade" id="statisticModal" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-statistic">
            <div class="modal-content" style="border-radius: 0">
                <div class="modal-header" style="border-bottom-color: #00a709">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title green" style="font-weight: bold; text-transform: uppercase">
                        <i class="icon-chart green" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Thống kê chi tiết
                    </h4>
                </div>
                <div class="modal-body modal-body-statistic">
                    <form class="statistic-form">
                        <fieldset>
                            <!-- <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-file-stats2 green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="loaihinh" class="black" style="margin-left: 1px">&nbsp;Tùy chọn hiển thị</span>
                                </div>
                                <div class="col-xs-3 col-md-3 modal-advanced modal-display">
                                    <input checked data-off="<p></p>" data-on="<p></p>" data-size="mini" data-style="ios" data-toggle="toggle" id="report_stat" type="checkbox">
                                </div>
                                <div class="col-xs-3 col-md-3 modal-advanced modal-display" style="padding-top: 1px; margin-left: -5%;">
                                    <span style="white-space: nowrap">Báo cáo</span>
                                </div>
                                <div class="col-xs-3 col-md-3 modal-advanced modal-display">
                                    <input checked data-off="<p></p>" data-on="<p></p>" data-size="mini" data-style="ios" data-toggle="toggle" id="chart_stat" type="checkbox">
                                </div>
                                <div class="col-xs-3 col-md-3 modal-advanced modal-display" style="padding-top: 1px; margin-left: -5%;">
                                    <span style="white-space: nowrap">Biểu đồ</span>
                                </div> -->
                                <!-- <div class="col-xs-2 col-md-2 modal-advanced modal-display">
                                    <input data-off="<p></p>" data-on="<p></p>" data-size="mini"
                                           data-style="ios" data-toggle="toggle" id="WQI_check" type="checkbox">
                                </div>
                                <div class="col-xs-1 col-md-1 modal-advanced modal-display"
                                     style="padding-top: 1px; margin-right: 5px;">
                                    <span style="margin-left: -30px">WQI</span>
                                </div>
                                <div class="col-xs-2 col-md-2 modal-advanced modal-display"
                                     style="margin-left: -20px">
                                    <input data-off="<p></p>" data-on="<p></p>" data-size="mini"
                                           data-style="ios" data-toggle="toggle" id="AQI_check" type="checkbox">
                                </div>
                                <div class="col-xs-1 col-md-1 modal-advanced modal-display"
                                     style="padding-top: 1px; margin-right: 5px;">
                                    <span style="margin-left: -30px">AQI</span>
                                </div> -->
                                <!-- Thêm 1 thẻ div để đẩy thẻ div sau ra giữa khung modal
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <div class="pretty p-image p-plain" style="margin-top: 0px">
                                        <input type="checkbox">
                                        <div class="state">
                                            <img class="image image-checkbox" src="{{ asset('public/webapp/assets/images/checkbox_2.png') }}">
                                            <label>WQI</label>
                                        </div>
                                    </div>
                                    <div class="pretty p-image p-plain" style="margin-top: 0px; margin-left: 23px">
                                        <input type="checkbox">
                                        <div class="state">
                                            <img class="image image-checkbox" src="{{ asset('public/webapp/assets/images/checkbox_2.png') }}">
                                            <label>AQI</label>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group" style="margin-top: 5px">
                                <div class="col-xs-12 col-md-12">
                                    <span id="statStatus_error"
                                          style="font-weight: bold; text-align: center;
                                          display: none; color: red"></span>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="form-group col-xs-7 col-md-7">
                                    <span id="statStatus_success"
                                          style="font-weight: bold; display: none; color: green"></span>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-lab green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="loaihinh_stat" class="black" style="margin-left: 1px">&nbsp;Loại hình</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="loaihinh_stat">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-server green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="loaitram_stat" class="black" style="margin-left: 1px">&nbsp;Loại trạm</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="loaitram_stat">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-location3 green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="district_stat" class="black" style="margin-left: 1px">&nbsp;Huyện/Thị xã</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="district_stat">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-yelp green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="standardtype" class="black" style="margin-left: 1px">&nbsp;Quy chuẩn</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="standardtype">
                                        <!-- DOM từ DB vào -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-home4 green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="" class="black" style="margin-left: 1px">&nbsp;Trạm quan trắc</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced" style="height: 30px !important;">
                                    <input class="form-control" id="search_quantrac" type="text">
                                    <i class="icon-search4 black" id="search_stats_tramqt"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-list-numbered green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="para" class="black" style="margin-left: 1px">&nbsp;Thông số</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <input class="form-control" id="search_para" type="text">
                                </div>
                            </div>
                            <!-- <div class="collapse form-group AQI_WQI_toggle">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-blog green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="purposetype" class="black" style="margin-left: 1px">&nbsp;Mục đích</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="purposetype">
                                    </select>
                                </div>
                            </div> -->
                            <!-- <div class="form-group">
                                <div class="col-xs-12 col-md-12">
                                    <hr class="line-search">
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-database-time2 green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="" class="black" style="margin-left: 1px">&nbsp;Từ ngày</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <div class='input-group date' id='FromDate_stat'>
                                        <input type='text' class="form-control" placeholder="dd/MM/yyyy" />
                                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-database-time2 green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="" class="black" style="margin-left: 1px">&nbsp;Đến ngày</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <div class='input-group date' id='ToDate_stat'>
                                        <input type='text' class="form-control" placeholder="dd/MM/yyyy" />
                                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-pie-chart3 green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="charttype" class="black" style="margin-left: 1px">&nbsp;Loại biểu đồ</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="charttype">
                                        <option selected>Lựa chọn biểu đồ</option>
                                        <option>Biểu đồ cột</option>
                                        <option>Biểu đồ đường</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="icon-reply green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="statisticby" class="black" style="margin-left: 1px">&nbsp;Kết quả hiển thị</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="statisticby">
                                        <option selected value="all_stat">Tất cả giá trị</option>
                                        <option value="average_stat">Giá trị trung bình</option>
                                        <option value="max_stat">Giá trị lớn nhất</option>
                                        <option value="min_stat">Giá trị nhỏ nhất</option>
                                    </select>
                                </div>
                            </div>
                            <div class="collapse form-group option_stat_display">
                                <div class="col-xs-5 col-md-5 modal-advanced-titles">
                                    <i class="glyphicon glyphicon-time green" style="font-size: 16px; margin-top: -2px"></i>
                                    <span for="stat_time_display" class="black" style="margin-left: 1px">&nbsp;Thời gian hiển thị</span>
                                </div>
                                <div class="form-group col-xs-7 col-md-7 modal-advanced">
                                    <select class="form-control" id="stat_time_display">
                                        <option value="15" selected>15 phút</option>
                                        <option value="30">30 phút</option>
                                        <option value="60">1 giờ</option>
                                        <option value="480">8 giờ</option>
                                        <option value="720">12 giờ</option>
                                        <option value="1440">24 giờ</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" data-dismiss="modal" type="submit" id="statistic-result-btn">Thống kê</button>
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thống kê (phần Tìm trạm) -->
    <div class="modal fade" id="search_stats_tramqtModal" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-stats-search">
            <div class="modal-content" style="border-radius: 0">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title blue" style="font-weight: bold; text-transform: uppercase">
                        <i class="icon-statistics blue" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Tìm kiếm trạm quan trắc
                    </h4>
                </div>
                <div class="modal-body">
                    <form class="contact-form">
                        <fieldset>
                            <!-- <div class="form-group col-xs-8 col-md-8">
                                <input class="form-control" id="tram_qt" type="text">
                            </div>
                            <div class="form-group col-xs-4 col-md-4">
                                <button class="btn btn-info" type="button">
                                    <i class="icon-home4" style="font-size: 16px; margin-top: -2px"></i>
                                    &nbsp;Tìm trạm
                                </button>
                            </div> -->
                            <div class="form-group col-xs-12 col-md-12">
                                <table id="table_stat_stations" class='table table-striped table-bordered table-condensed table-responsive'>
                                    <thead>
                                    <tr class="bg-info" role="row" style="color: #000">
                                        <th scope="col" class="bg-info fixed_header">Mã trạm</th>
                                        <th scope="col" class="bg-info fixed_header">Tên trạm</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- DOM dữ liệu trạm quan trắc -->
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" type="submit" id="station_multiple">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thống kê (phần Thông số) -->
    <div class="modal fade" id="search_paraqtModal" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-stats-para">
            <div class="modal-content" style="border-radius: 0">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title blue" style="font-weight: bold; text-transform: uppercase">
                        <i class="icon-statistics blue" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Tìm kiếm thông số
                    </h4>
                </div>
                <div class="modal-body">
                    <form class="contact-form">
                        <fieldset>
                            <!-- <div class="form-group col-xs-7 col-md-7">
                                <input class="form-control" id="para" type="text">
                            </div>
                            <div class="form-group col-xs-5 col-md-5">
                                <button class="btn btn-info" type="button">
                                    <i class="icon-home4" style="font-size: 16px; margin-top: -2px"></i>
                                    &nbsp;Tìm Thông số
                                </button>
                            </div> -->
                            <div class="form-group col-xs-12 col-md-12 table-overflow" id="para_tab" style="overflow-x: auto">
                                <!-- DOM bảng Thông số checkbox -->
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" type="submit" id="para_multiple">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xuất kết quả Thống kê -->
    <div class="modal fade" id="statistic_resultModal" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-statistic-result">
            <div class="modal-content modal-statistic-result-content" style="border-radius: 0">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title blue" style="font-weight: bold; text-transform: uppercase">
                        <i class="icon-statistics blue" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Kết quả Thống kê chi tiết
                    </h4>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-justified" id="tab_stats">
                        <li class="active">
                            <a data-toggle="tab" href="#table_qt">
                                <i class="icon-table2" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Bảng số liệu trạm quan trắc
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#chart_qt">
                                <i class="icon-chart" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Biểu đồ
                            </a>
                        </li>
                        <!-- <li>
                            <a data-toggle="tab" href="#WQI_qt">
                                <i class="icon-wave2" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Chỉ số chất lượng nước (WQI)
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#AQI_qt">
                                <i class="icon-air" style="font-size: 16px; margin-top: -2px"></i> &nbsp;Chỉ số chất lượng không khí (AQI)
                            </a>
                        </li> -->
                    </ul>
                </div>
                <div class="tab-content" id="statistic-result-TabsContent">
                    <div class="tab-pane fade active in" id="table_qt">
                        <div class="form-group col-xs-12 col-md-12">
                            <a href="#" id="exportExcel" class="btn btn-info" role="button">EXCEL</a>
                            <a href="#" id="exportPDF" class="btn btn-info" role="button">PDF</a>
                        </div>
                        <div class="form-group col-xs-12 col-md-12 table-scroll" id="tab_stat">
                            <table id="table_result_stat" class='table table-striped table-bordered table-condensed table-responsive'>
                                <thead>
                                <!-- DOM trạm và thuộc tính -->
                                </thead>
                                <tbody>
                                <!-- DOM dữ liệu trạm quan trắc -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="chart_qt">
                        <!-- DOM số thẻ div theo số Param được chọn để tạo Chart -->
                        <div class="form-group col-xs-3 col-md-3 option_stat_typechart">
                            <select class="form-control" id="filter_stat_typechart">
                                <option value="filter_stat_column_chart">Biểu đồ cột</option>
                                <option value="filter_stat_line_chart">Biểu đồ đường</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="WQI_qt">
                        <h5 style="padding-left: 15px">Chất lượng nước WQI (DataTables)</h5>
                    </div>
                    <div class="tab-pane fade" id="AQI_qt">
                        <h5 style="padding-left: 15px">Chất lượng không khí AQI (DataTables)</h5>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button id="return_modal_statistic" class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main JS -->
    <script src="{{ asset('public/webapp/vendor/jquery/js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('public/webapp/vendor/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/webapp/vendor/bootstrap/js/bootstrap-toggle.js') }}"></script>
    <script src="{{ asset('public/webapp/vendor/bootstrap/js/moment.js') }}"></script>
    <script src="{{ asset('public/webapp/vendor/bootstrap/js/moment-with-locales.js') }}"></script>
    <script src="{{ asset('public/webapp/vendor/bootstrap/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/search_plugin/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/search_plugin/handlebars.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/search_plugin/list.min.js') }}"></script>

    <!-- Datatables JS -->
    <script src="{{ asset('public/webapp/vendor/jquery/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/webapp/vendor/bootstrap/js/dataTables.bootstrap3.min.js') }}"></script>
    <script src="{{ asset('public/webapp/vendor/bootstrap/js/datetime-moment.js') }}"></script>
    <!-- Tree JS -->
    <script src="{{ asset('public/webapp/assets/js/tree/jstree.js') }}"></script>
    <!-- Datatables Plugin -->
    <script src="{{ asset('public/webapp/assets/js/tables/datatables.min.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables/jszip.min.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables/buttons.html5.min.js') }}"></script>

    <!-- Map JS-->
    <script src="{{ asset('public/webapp/assets_map/js/leaflet_plugin/leaflet.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/leaflet_plugin/leaflet.ajax.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/leaflet_plugin/leaflet.zoomhome.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/leaflet_plugin/leaflet-gps.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/leaflet_plugin/rbush.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/leaflet_plugin/labelgun.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/leaflet_plugin/Control.FullScreen.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/leaflet_plugin/L.Icon.Pulse.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/leaflet_plugin/L.Control.Basemaps.js') }}"></script>

    <script src="{{ asset('public/webapp/assets_map/js/leaflet_plugin/geojson-bbox.js') }}"></script>

    <!-- Map Data Chart -->
    <script src="{{ asset('public/webapp/vendor/chart/AmChart/core.js') }}"></script>
    <script src="{{ asset('public/webapp/vendor/chart/AmChart/charts.js') }}"></script>
    <script src="{{ asset('public/webapp/vendor/chart/AmChart/lang/vi_VN.js') }}"></script>
    <script src="{{ asset('public/webapp/vendor/chart/AmChart/themes/animated.js') }}"></script>

    <!-- Import Excel -->
    <script src="{{ asset('public/webapp/assets/js/import_excel/xlsx.full.min.js') }}"></script>

    <!-- Main JS Custom -->
    <script src="{{ asset('public/webapp/assets/js/config.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/main.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/chart/Viewchart.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/option_customize/option_searches.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/option_customize/option_stats.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/option_customize/option_WQIAQI.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/option_customize/option_renderChart.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/option_customize/option_uploadFiles.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables_customize/export_infoToFile.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables_customize/feature_onChange.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables_customize/feature_infoBTD.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables_customize/feature_infoThreshold.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables_customize/feature_infoStatistic.js') }}"></script>
    <script src="{{ asset('public/webapp/assets/js/tables_customize/feature_infoWQIAQI.js') }}"></script>

    <!-- Map JS Custom -->
    <script src="{{ asset('public/webapp/assets_map/js/map_function/MapCollisionLabels.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/map_function/MapScript.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/map_function/MapFeatureInfo.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/map_function/MapSearch.js') }}"></script>
    <script src="{{ asset('public/webapp/assets_map/js/map_function/MapVS_pre_data.js') }}"></script>

</body>

</html>
