<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quan trắc Đồng Tháp</title>
    <meta content="width=device-width, maximum-scale = 1, minimum-scale=1" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" name="viewport">
    <meta content="yes" name="mobile-web-app-capable">
    <meta content="yes" name="apple-mobile-web-app-capable">

    <!-- Favicon -->
    <link href="{{ asset('public/webapp/assets/images/SoTNMT.ico') }}" rel="icon" type="image/x-icon" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=" {{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href=" {{ asset('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css')}}">
    <style>
        * {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
    <!-- Google Font: Source Sans Pro
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

    <!-- jQuery -->
    <script src=" {{ asset('public/admin/plugins/jquery/jquery.min.js') }} "></script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src=" {{ asset('public/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src=" {{ asset('public/admin/dist/js/adminlte.min.js') }} "></script>
    <!-- AdminLTE for demo Organizations -->
    <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
    <script type="text/javascript">
        var standards = []; //cac qua chuan
        var parameters = []; //cac thong so
        var purposes = []; //cac muc dich
        var standardsparameters = []; // tieu chuan va thong so
        var standardsparameterswparam = [];
        var lstParam;
        var hostIP="http://10.151.46.88/";
        var sApp = "travinhqt_laravel";
        var sURL = hostIP + sApp + "/";
        // ----- Lấy danh mục standard ----- //
        function getstandardsData(callback) {
            $.ajax({
                type: "GET",
                url: sURL + "jsonStandard",
                dataType: "json",
                async: false,
                success: function (response) {
                    callbackstandards(response);
                },
                error: function (response) {
                    alert("jsonStandard thing didn't work.");
                }
            });
        }

        function callbackstandards(data) {
            var test = [];
            $.each(data, function (key, val) {
                test.push({
                    id: val.id,
                    name: val.name,
                    symbol: val.symbol,
                    obstypeid: val.obstypeid,
                    dateoflssue: val.dateoflssue,
                    organization: val.organization,
                    attachment: val.attachment
                });
            });
            standards = test;
        }
        getstandardsData(callbackstandards);
        // ----- End Lấy danh mục standard ----- //



        // ----- Lấy danh mục parameter ----- //
        function getparametersData(callback) {
            $.ajax({
                type: "GET",
                url: sURL + "jsonParameter",
                dataType: "json",
                async: false,
                success: function (response) {
                    callbackparameters(response);
                },
                error: function (response) {
                    alert("jsonParameter thing didn't work.");
                }
            });
        }

        function callbackparameters(data) {
            var test = [];
            $.each(data, function (key, val) {
                test.push({
                    id: val.id,
                    code: val.code,
                    name: val.name
                });
            });
            parameters = test;
        }
        getparametersData(callbackparameters);
        // ----- End Lấy danh mục standard ----- //



        // ----- Lấy danh mục purpose ----- //
        function getpurposesData(callback) {
            $.ajax({
                type: "GET",
                url: sURL + "jsonPurpose",
                dataType: "json",
                async: false,
                success: function (response) {
                    callbackpurposes(response);
                },
                error: function (response) {
                    alert("jsonpurpose thing didn't work.");
                }
            });
        }

        function callbackpurposes(data) {
            var test = [];
            $.each(data, function (key, val) {
                test.push({
                    id: val.id,
                    name: val.name,
                    description: val.description
                });
            });
            purposes = test;
        }
        getpurposesData(callbackpurposes);
        // ----- End Lấy danh mục standard ----- //



        // ----- Lấy dữ liệu standardsparameters ----- //
        function getstandardsparametersData(callback) {
            $.ajax({
                type: "GET",
                url: sURL + "jsonStandardParameter",
                dataType: "json",
                async: false,
                success: function (response) {
                    callbackstandardsparameters(response);
                },
                error: function (response) {
                    alert("jsonStandardParameter thing didn't work.");
                }
            });
        }

        function callbackstandardsparameters(data) {
            var items = [];
            $.each(data, function (key, val) {
                items.push({
                    id: val.id,
                    standardid: val.standardid,
                    parameterid: val.parameterid,
                    unitid: val.unitid,
                    minvalue: val.minvalue,
                    maxvalue: val.maxvalue,
                    purposeid: val.purposeid,
                    analysismethod: val.analysismethod
                });
            });
            standardsparameters = items;
        }
        getstandardsparametersData(callbackstandardsparameters);
        // ----- End Lấy dữ liệu standardsparameters ----- //



        // ----- Lấy dữ liệu standardsparameterswparam ----- //
        function getstandardsparameterswparamData(callback) {
            $.ajax({
                type: "GET",
                url: sURL + "jsonStandardParameterdb",
                dataType: "json",
                async: false,
                success: function (response) {
                    callbackstandardsparameterswparam(response);
                },
                error: function (response) {
                    alert("jsonStandardParameterdb thing didn't work.");
                }
            });
        }

        function callbackstandardsparameterswparam(data) {
            var items = [];
            $.each(data, function (key, val) {
                items.push({
                    spid: val.spid,
                    sp_standardid: val.sp_standardid,
                    sp_parameterid: val.sp_parameterid,
                    sp_purposeid: val.sp_purposeid,
                    sp_unitid: val.sp_unitid,
                    sp_minvalue: val.sp_minvalue,
                    sp_maxvalue: val.sp_maxvalue,
                    sp_analysismethod: val.sp_analysismethod,
                    parameter_id: val.parameter_id,
                    parameter_name: val.parameter_name,
                    parameter_code: val.parameter_code
                });
            });
            standardsparameterswparam = items;
        }
        getstandardsparameterswparamData(callbackstandardsparameterswparam);
        // ----- End Lấy dữ liệu standardsparameterswparam ----- //

    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('temp.header')

        <!-- Main Sidebar Container -->
        @include('temp.menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row mb-12">
                        <div class="col-sm-12">
                            <h4>Quản lý trạm quan trắc</h4>
                        </div>
                    </div>
                    <div class="row mb-12">
                        <div class="col-sm-12">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Thêm mới trạm quan trắc</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('Observationstation.create') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Mã trạm</label>
                                                    <input name="code" id="code" type="text" class="form-control"
                                                        placeholder="Mã trạm ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tên trạm</label>
                                                    <input name="name" id="name" type="text" class="form-control"
                                                        placeholder="Tên trạm ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>X</label>
                                                    <input name="coordx" id="coordx" type="text" class="form-control"
                                                        placeholder="X ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Y</label>
                                                    <input name="coordY" id="coordY" type="text" class="form-control"
                                                        placeholder="Y ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Loại trạm</label>
                                                    <select class="js-example-basic-single form-control"
                                                        name="category">
                                                        <option value="AL">Item</option>
                                                        ...
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Doanh nghiệp</label>
                                                    <select class="js-example-basic-single form-control"
                                                        name="enterprise">
                                                        <option value="AL">Item</option>
                                                        ...
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tổ chức</label>
                                                    <select class="js-example-basic-single form-control"
                                                        name="organization">
                                                        <option value="AL">Item</option>
                                                        ...
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Lưu vực sông</label>
                                                    <select class="js-example-basic-single form-control" name="basin">
                                                        <option value="AL">Item</option>
                                                        ...
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Địa danh</label>
                                                    <select class="js-example-basic-single form-control"
                                                        name="location">
                                                        <option value="AL">Item</option>
                                                        ...
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Quận huyện</label>
                                                    <input name="district" id="district" type="text"
                                                        class="form-control" placeholder="Quận huyện ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Ngày quan trắc</label>
                                                    <input name="establishdate" id="establishdate" type="text"
                                                        class="form-control" placeholder="Ngày quan trắc ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Ngày kết thúc quan trắc</label>
                                                    <input name="terminatedate" id="terminatedate" type="text"
                                                        class="form-control" placeholder="Quận huyện ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Bảo trì</label>
                                                    <input name="maintenance" id="maintenance" type="text"
                                                        class="form-control" placeholder="Quận huyện ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Ghi chú</label>
                                                    <input name="note" id="note" type="text"
                                                        class="form-control" placeholder="Quận huyện ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tình trạng hoạt động</label>
                                                    <select class="js-example-basic-single form-control"
                                                    id="active"  name="active">
                                                        <option value="true">Có</option>
                                                        <option value="false">Không</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>FTP Username</label>
                                                    <input name="ftpusername" id="ftpusername" type="text"
                                                        class="form-control" placeholder="FTP Username ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>FTP Password</label>
                                                    <input name="ftppassword" id="ftppassword" type="text"
                                                        class="form-control"
                                                        placeholder="FTP Password ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Loại hình</label>
                                                    <select class="js-example-basic-multiple1 form-control"
                                                        name="ObservationTypes[]" multiple="multiple">
                                                        <optgroup label="Chọn loại hình" value="">

                                                        </optgroup>
                                                        @foreach($ObservationTypes as $ObservationType)
                                                        @if ($ObservationType->parentid == null)
                                                    <option label="{{$ObservationType->name}}"
                                                        value="{{ $ObservationType->id }}">
                                                            {{$ObservationType->name}}
                                                            @foreach ( $ObservationTypes as $ObservationType1 )
                                                            @if ($ObservationType1->parentid == $ObservationType->id)
                                                        <option value="{{$ObservationType1->id}}">
                                                            --- {{$ObservationType1->name}}
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                        </option>
                                                        @endif
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Quy chuẩn</label>
                                                    <select class="js-example-basic-single form-control"
                                                        name="standards" id="standards">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Mục đích sử dụng</label>
                                                    <select class="js-example-basic-single form-control"
                                                        name="purposes">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Loại: </label>
                                                    <select class="js-example-basic-single form-control"
                                                        name="Type">
                                                        <option>WQI</option>
                                                        <option>AQI</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Thông số quan trắc</label>
                                                    <select class="js-example-basic-single form-control"
                                                        name="Parameters[]">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <table class="table table-bordered" id="formChitieu"
                                                        name="formChitieu">
                                                        <tr>
                                                            <th>Thông số</th>
                                                            <th>Giới hạn nhỏ nhất</th>
                                                            <th>Giới hạn lớn nhất</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <select onchange="setvalue(0);"
                                                                    id="chitieu[0][parameter]" class="form-control"
                                                                    name="chitieu[0][parameter]">
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input name="chitieu[0][minvalue]"
                                                                    id="chitieu[0][minvalue]" type="text"
                                                                    class="form-control" placeholder="Cận dưới ...">
                                                            </td>
                                                            <td>
                                                                <input name="chitieu[0][maxvalue]"
                                                                    id="chitieu[0][maxvalue]" type="text"
                                                                    class="form-control" placeholder="Cận trên ...">
                                                            </td>
                                                            <td>
                                                                <button type="button" name="addmore" id="addmore"
                                                                    class="btn btn-success">Add More</button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('Observationstation') }}" class="btn btn-default float-right">
                                            Quay lại
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>


    </div>


    <!-- /.modal-dialog -->
    </div>
    <!-- /.content-wrapper -->

    @include('temp.footer')
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


</body>


</html>
<script type="text/javascript">
    // ----- Truyền dữ liệu qua select Quy chuẩn ----- //
    var str_select_standards = "";
    var select_standards = document.getElementsByName("standards");
    $.each(standards, function (key, val) {
        str_select_standards += '<option value="' + val.id + '">' + val.name + '</option>';
    });
    $(select_standards).append(str_select_standards);
    $(select_standards).on('change', function () {
        //alert($(this).find(":selected").val());
        lstParam = getParameter();
        addOption("chitieu[0][parameter]", lstParam);
        //alert(lstParam.length);
    });
    // ----- End Truyền dữ liệu qua select Quy chuẩn ----- //


    // ----- Truyền dữ liệu qua select Quy chuẩn ----- //
    var str_select_purposes = "";
    var select_purposes = document.getElementsByName("purposes");
    $.each(purposes, function (key, val) {
        str_select_purposes += '<option value="' + val.id + '">' + val.name + '</option>';
    });
    $(select_purposes).append(str_select_purposes);
    $(select_purposes).on('change', function () {
        //alert($(this).find(":selected").val());
        lstParam = getParameter();
        addOption("chitieu[0][parameter]", lstParam);
        //alert(lstParam.length);
    });
    // ----- End Truyền dữ liệu qua select Quy chuẩn ----- //


    // ----- Hàm lấy tham số theo quy chuẩn và mục đích ----- //
    function getParameter() {
        var id_standard = $(select_standards).find(":selected").val();
        var id_purpose = $(select_purposes).find(":selected").val();
        var parametersbystandardAndpurpose = [];
        var str_parameter = "";
        if (standardsparameterswparam.length > 0) {
            for (let i = 0; i < standardsparameterswparam.length; i++) {
                if (standardsparameterswparam[i].sp_standardid == id_standard && standardsparameterswparam[i]
                    .sp_purposeid == id_purpose) {
                    str_parameter += '<option value="' + standardsparameterswparam[i].parameter_id + '">';
                    str_parameter += standardsparameterswparam[i].parameter_name + "( Min: " +
                        standardsparameterswparam[i].sp_minvalue + " - Max: " + standardsparameterswparam[i]
                        .sp_maxvalue + " )";
                    str_parameter += '</option>';
                }
            }
            return str_parameter;
        }
    }
    // ----- End Hàm lấy tham số theo quy chuẩn và mục đích ----- //
    lstParam = getParameter();
    var lstParam1 = lstParam;

</script>
<script type="text/javascript">
    $('.js-example-basic-multiple').select2();
    $('.js-example-basic-multiple1').select2();
    var test2 = standards;
    var test = parameters;
    var test3 = purposes;
    var test4 = standardsparameters;
    var test5 = standardsparameterswparam;
    var i = 0;
    var j = 0;
    var chitieu_parammeter = document.getElementsByName("chitieu[0][parameter]");

    function addOption(control, str) {
        var element = document.getElementsByName(control);
        $(element).empty();
        if (str.length > 0) {
            $(element).append(str);
        } else {
            $(element).append('<option value="">Không có dữ liệu</option>');
        }
    }

    $("#addmore").click(function () {
        ++j;
        var str = '<tr>';
        str += '<td><select onchange="setvalue(' + j + ');" name="chitieu[' + j +
            '][parameter]" class="js-example-basic-single form-control" ';
        str += ' style="width: 100%;">;'
        str += lstParam;
        str += '</select></td>';
        str += '<td><input type="text" name="chitieu[' + j +
            '][minvalue]" placeholder="Cận dưới " class="form-control" /></td>';
        str += '<td><input type="text" name="chitieu[' + j +
            '][maxvalue]" placeholder="Cận trên" class="form-control" /></td>';
        str += '<td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>';
        str += '</tr>';
        $("#formChitieu").append(str);
    });

    $(document).on('click', '.remove-tr', function () {
        $(this).parents('tr').remove();
    });

    function setvalue(i) {
        alert(i);
        var chitieu_parammeter = document.getElementsByName("chitieu[" + i + "][minvalue]");
        $(chitieu_parammeter).val(i);
    }

</script>
<script type="text/javascript">
    $(document).ready(function () {
        addOption("chitieu[0][parameter]", lstParam);
    });

</script>
