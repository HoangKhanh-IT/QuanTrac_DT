<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quan trắc Trà Vinh</title>
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
    <script src=" {{ asset('public/admin/jqueryui/jquery-ui-1.12.1/jquery-ui.js') }} "></script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src=" {{ asset('public/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src=" {{ asset('public/admin/dist/js/adminlte.min.js') }} "></script>
    <link rel="stylesheet" href="{{ asset('public/admin/jqueryui/jquery-ui-1.12.1/jquery-ui.css') }}">
    <!-- AdminLTE for demo Organizations -->
    <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>

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
                            <h2>Quản lý điểm xả nước thải</h2>
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
                                    <h3 class="card-title">Thêm mới điểm xả nước thải</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('DischargePoint.create') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Doanh nghiệp (<span style="color: red;">*</span>)</label>
                                                    <select class="js-example-basic-single form-control"
                                                        name="enterpriseid" id="enterpriseid">
                                                        @foreach ($Enterprises as $Enterprise)
                                                        <option value="{{ $Enterprise->id }}">{{ $Enterprise->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Số quyết định</label>
                                                    <input name="decisionnumber" id="decisionnumber" type="text" class="form-control"
                                                        placeholder="Số quyết định giấy phép xả thải ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Ngày cấp phép</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="datepicker form-control" type="text"
                                                            placeholder="Ngày cấp phép" name="licensedate"
                                                            id="licensedate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Thời hạn</label>
                                                    <input name="period" id="period" type="text" class="form-control"
                                                        placeholder="Thời hạn giấy phép xả thải ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tên cơ sở</label>
                                                    <input name="establishmentname" id="establishmentname" type="text" class="form-control"
                                                        placeholder="Tên cơ sở ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Nơi xả thải</label>
                                                    <input name="location" id="location" type="text" class="form-control"
                                                        placeholder="Vị trí nơi xả nước thải ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Thời gian vận hành</label>
                                                    <input name="operatingtime" id="operatingtime" type="text" class="form-control"
                                                        placeholder="Thời gian vận hành ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Phương thức xả thải</label>
                                                    <input name="dischargemethod" id="dischargemethod" type="text" class="form-control"
                                                        placeholder="Phương thức xả nước thải ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Lưu lượng xả thải</label>
                                                    <input name="flowrate" id="flowrate" type="text" class="form-control"
                                                        placeholder="Lưu lượng xả nước thải ...">
                                                </div>
                                            </div>

                                             <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Quy chuẩn </label>
                                                    <select class="js-example-basic-single form-control"
                                                        name="standardid" id="standardid">
                                                        <option value="">--Lựa chọn Quy chuẩn--</option>
                                                        @foreach ($Standards as $Standard)
                                                        <option value="{{ $Standard->id }}">{{ $Standard->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tọa độ X (<span style="color: red;">*</span>)</label>
                                                    <input name="coordx" id="coordx" type="text" class="form-control"
                                                        placeholder="Tọa độ X ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tọa độ Y (<span style="color: red;">*</span>)</label>
                                                    <input name="coordy" id="coordy" type="text" class="form-control"
                                                        placeholder="Tọa độ Y ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Nguồn tiếp nhận nước thải</label>
                                                    <input name="sourcereception" id="sourcereception" type="text" class="form-control"
                                                        placeholder="Nguồn nước tiếp nhận nước thải ...">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Lưu vực sông (<span style="color: red;">*</span>)</label>
                                                    <select class="js-example-basic-single form-control" name="basinid" id="basinid">
                                                        @foreach($Basins as $Basinparent)
                                                            @if ($Basinparent->parentriverbasinid == null)
                                                                <option value="{{$Basinparent->id}}">{{$Basinparent->name}}
                                                                </option>
                                                                @foreach ( $Basins as $Basin1 )
                                                                    @if ($Basin1->parentriverbasinid == $Basinparent->id)
                                                                    <option value="{{$Basin1->id}}">
                                                                        --{{$Basin1->name}}
                                                                    </option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Loại giấy phép</label>
                                                    <input name="licensetype" id="licensetype" type="text"
                                                        class="form-control" placeholder="Loại giấy phép ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Hạn giấy phép</label>
                                                    <input name="licenseterm" id="licenseterm" type="text"
                                                        class="form-control" placeholder="Hạn giấy phép ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Ghi chú</label>
                                                    <input name="note" id="note" type="text" class="form-control"
                                                        placeholder="Ghi chú ...">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('DischargePoint') }}" class="btn btn-default float-right">
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
    $(document).ready(function () {
        $("#licensedate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });

    });


</script>
