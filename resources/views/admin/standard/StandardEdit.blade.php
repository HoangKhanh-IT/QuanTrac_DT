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
    <!-- Sel -->
    {{-- <link rel="stylesheet" href="{{ asset('public/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/admin/jqueryui/jquery-ui-1.12.1/jquery-ui.css') }}">
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
                            <h2>Quản lý quy chuẩn</h2>
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
                                    <h3 class="card-title">Cập nhật quy chuẩn</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('Standard.edit',$Standard->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Tên (<span style="color: red;">*</span>)</label>
                                        <input name="name" id="name" type="text" class="form-control" value="{{ $Standard->name }}"
                                                placeholder="Tên ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Kí hiệu (<span style="color: red;">*</span>)</label>
                                            <input name="symbol" name="symbol" id="symbol" type="text" class="form-control" value="{{ $Standard->symbol }}"
                                                placeholder="Kí hiệu ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Loại hình quan trắc (<span style="color: red;">*</span>)</label>
                                            <select class="form-control select2 select2-hidden-accessible" name="loaihinhcha" id="loaihinhcha" style="width: 100%;">
                                               <!--  <option value="">--Chọn loại hình--</option> -->
                                                @foreach($ObservationTypes as $ObservationType)
                                                @if($ObservationType->parentid == null)
                                                <option {{ $ObservationType->id === $Standard->obstypeid? 'selected' : '' }}
                                                    value="{{$ObservationType->id}}">{{$ObservationType->name}}
                                                </option>
                                                @foreach ( $ObservationTypes as $ObservationType1 )
                                                @if ($ObservationType1->parentid == $ObservationType->id)
                                                <option {{ $ObservationType1->id === $Standard->obstypeid? 'selected' : '' }}
                                                    value="{{$ObservationType1->id}}">
                                                    --- {{$ObservationType1->name}}
                                                </option>
                                                @endif
                                                @endforeach
                                                @else
                                                {{-- <option value="{{$ObservationType->id}}">{{$ObservationType->name}}
                                                </option> --}}
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Ngày ban hành</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="datepicker form-control" type="text" placeholder="Chọn ngày ban hành ..." name="dateFrom" id="dateFrom">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Cơ quan ban hành</label>
                                            <input name="organization" id="organization" value="{{ $Standard->organization }}" type="text" class="form-control" placeholder="Cơ quan ban hành ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Tệp đính kèm</label>
                                            <input name="attachment" id="attachment" value="{{ $Standard->attachment }}"  type="file" class="form-control" placeholder="Tệp đính kèm ...">
                                            @if($Standard->attachment)
                                                <a href="{{asset('public/uploads/standards/'.$Standard->attachment)}}" target="blank" title="Xem tệp tin">{{$Standard->attachment}}<i class="fas fa-download"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('Standard') }}" class="btn btn-default float-right">
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
    <script src=" {{ asset('public/admin/jqueryui/jquery-ui-1.12.1/jquery-ui.js') }} "></script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- Sel -->
    {{-- <script src=" {{ asset('public/admin/plugins/select2/js/select2.full.min.js') }}"></script> --}}
    <!-- AdminLTE App -->
    <script src=" {{ asset('public/admin/dist/js/adminlte.min.js') }} "></script>
    <!-- AdminLTE for demo Standards -->
    <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
    <script type="">
        $(document).on('click','.open_modal',function(){
            //alert($(this).val());
            //$('#myModal').modal('show');
        });
    </script>
</body>

</html>
<script type="text/javascript">
    $( document ).ready(function() {
        //alert('a');
        //$('.js-example-basic-single').select2();
        $( "#dateFrom" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
        queryDate = "{{ $Standard->dateoflssue }}";
        var parsedDate = $.datepicker.parseDate('yy-mm-dd', queryDate);
        $('#dateFrom').datepicker('setDate', parsedDate);

    });
</script>
