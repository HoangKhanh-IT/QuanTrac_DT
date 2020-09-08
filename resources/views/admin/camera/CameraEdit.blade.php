<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quan trắc Trà Vinh</title>
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
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

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
                            <h2>Quản lý thông tin Camera</h2>
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
                                    <h3 class="card-title">Cập nhật thông tin Camera</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('Camera.edit',$Camera->id) }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tên (<span style="color: red;">*</span>)</label>
                                                    <input name="name" id="name" type="text" class="form-control"
                                                        placeholder="Tên ..." value="{{ $Camera->name }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Trạm quan trắc (<span style="color: red;">*</span>)</label>
                                                    <select class="form-control select2 select2-hidden-accessible"
                                                        name="loaihinhcha" id="loaihinhcha" style="width: 100%;">
                                                    @foreach ($ObservationStations as $ObservationStation)
                                                        <option {{ $Camera->stationid == $ObservationStation->id ?"Selected":""  }}
                                                            value="{{$ObservationStation->id}}">
                                                            {{$ObservationStation->name}}
                                                        </option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="col-sm-6">
                                                 <div class="form-group">
                                                     <label>Tài khoản (<span style="color: red;">*</span>)</label>
                                                     <input name="username" id="username" type="text"
                                                 class="form-control" value="{{ $Camera->username }}"
                                                         placeholder="Tài khoản ...">
                                                 </div>
                                             </div>
                                              <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label>Mật khẩu (<span style="color: red;">*</span>)</label>
                                                      <input name="pass" id="pass" type="text" class="form-control"
                                                          placeholder="Mật khẩu ..." value="{{ $Camera->pass }}">
                                                  </div>
                                              </div>
                                               <div class="col-sm-6">
                                                   <div class="form-group">
                                                       <label>Địa chỉ IP (<span style="color: red;">*</span>)</label>
                                                       <input name="ipaddress" id="ipaddress" type="text"
                                                           class="form-control"
                                                           placeholder="Địa chỉ IP ..."
                                                           value="{{ $Camera->ipaddress }}">
                                                   </div>
                                               </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mô tả</label>
                                                        <input name="description" id="description" type="text"
                                                            class="form-control"
                                                            placeholder="Mô tả ..." value="{{ $Camera->description }}">
                                                    </div>
                                                </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                            <a href="{{ route('Camera') }}" class="btn btn-default float-right">
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
    <!-- AdminLTE for demo Cameras -->
    <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
  
</body>

</html>
