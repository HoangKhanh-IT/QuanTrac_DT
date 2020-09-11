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
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css')}}">
    <style>
        * {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
    <!-- Google Font: Source Sans Pro
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

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
                            <h2>Quản lý lưu vực sông</h2>
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
                                    <h3 class="card-title">Thêm mới lưu vực sông</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('Basin.create') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Mã </label>
                                                    <input name="riverid" id="riverid" type="text" class="form-control"
                                                        placeholder="Mã ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tên (<span style="color: red;">*</span>)</label>
                                                    <input name="name" id="name" type="text" class="form-control"
                                                        placeholder="Tên ...">
                                                </div>
                                            </div>
                                             <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Chủ công trình</label>
                                                    <input name="master" id="master" type="text" class="form-control"
                                                        placeholder="Chủ công trình ...">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Lưu vực cha</label>
                                                    <select class="form-control select2 select2-hidden-accessible"
                                                        name="parentriverbasinid" id="parentriverbasinid" style="width: 100%;">
                                                        <option value="">--Chọn lưu vực cha--</option>
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
                                                    <label>Dung tích</label>
                                                    <input name="capacity" id="capacity" type="text" class="form-control"
                                                        placeholder="Dung tích ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Dung tích hữu ích</label>
                                                    <input name="netcapacity" id="netcapacity" type="text" class="form-control"
                                                        placeholder="Dung tích hữu ích...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Dung tích chết</label>
                                                    <input name="deadcapacity" id="deadcapacity" type="text" class="form-control"
                                                        placeholder="Dung tích chết...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Diện tích mặt hồ của mực nước dâng BT</label>
                                                    <input name="surfaceareanwt" id="surfaceareanwt" type="text" class="form-control"
                                                        placeholder="Diện tích mặt hồ của mực nước dâng bình thường...">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Diện tích mặt hồ ứng với mực nước dâng BT</label>
                                                    <input name="risingofnormalwaterlevel" id="risingofnormalwaterlevel" type="text" class="form-control"
                                                        placeholder="Diện tích mặt hồ ứng với mực nước dâng bình thường...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Mực nước chết</label>
                                                    <input name="deadwaterlevel" id="deadwaterlevel" type="text" class="form-control"
                                                        placeholder="Mực nước chết...">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Điểm đầu</label>
                                                    <input name="beginning" id="beginning" type="text" class="form-control"
                                                        placeholder="Điểm đầu...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Điểm cuối</label>
                                                    <input name="termini" id="termini" type="text" class="form-control"
                                                        placeholder="Điểm cuối...">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Chiều dài (km)</label>
                                                    <input name="length" id="length" type="text" class="form-control"
                                                        placeholder="Chiều dài (km)...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Diện tích lưu vực</label>
                                                    <input name="riverbasinarea" id="riverbasinarea" type="text" class="form-control"
                                                        placeholder="Diện tích lưu vực ...">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Lưu lượng trung bình</label>
                                                    <input name="averageflowrate" id="averageflowrate" type="text" class="form-control"
                                                        placeholder="Lưu lượng trung bình...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Mực nước dâng bình thường</label>
                                                    <input name="normalwaterlevel" id="normalwaterlevel" type="text" class="form-control"
                                                        placeholder="Mực nước dâng bình thường ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Tiêu chuẩn</label>
                                                    <input name="standard" id="standard" type="text" class="form-control"
                                                        placeholder="Tiêu chuẩn ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Mục đích sử dụng</label>
                                                    <input name="purpose" id="purpose" type="text" class="form-control"
                                                        placeholder="Mục đích sử dụng ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Mô tả</label>
                                                    <input name="description" id="description" type="text" class="form-control"
                                                        placeholder="Mô tả ...">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                            <a href="{{ route('Basin') }}"
                                                class="btn btn-default float-right">
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


    <!-- /.content-wrapper -->

    @include('temp.footer')
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src=" {{ asset('public/admin/plugins/jquery/jquery.min.js') }} "></script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src=" {{ asset('public/admin/dist/js/adminlte.min.js') }} "></script>
    <!-- AdminLTE for demo Basins -->
    <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>

</body>

</html>
