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
                    <div class="row">
                        <div class="col-sm-12">
                            @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                            @endif
                        </div>
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-header">
                                    <div class="col-sm-12 col-md-1 card-title">
                                        <a href="{{ route('Camera.create') }}"
                                            class="btn btn-block bg-gradient-primary">
                                            Thêm
                                        </a>
                                    </div>
                                    <div class="card-tools">
                                        <form method="get" action="{{ route('Cameratk') }}">
                                            @csrf
                                            <div class="input-group input-group-prepend" style="width: 250px;">
                                                <input type="text" name="search" class="form-control float-right"
                                                    placeholder="Tên camera, Tên trạm, mô tả, IP, username">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn  btn-default"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th scope="col" class="">STT</th>
                                                            <th scope="col" class="">Tên</th>
                                                            <th scope="col" class="">Tên trạm</th>
                                                            <th scope="col" class="">Tài khoản</th>
                                                            <th scope="col" class="">Địa chỉ IP</th>
                                                            <th scope="col" class="">Mô tả</th>
                                                            <th scope="col" class="">Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($cameras as $key => $Camera)
                                                        <tr class="text-center">
                                                            <td scope="row">
                                                                {{ $cameras->firstItem() + $key }}
                                                            </td>
                                                            <td>
                                                                {{$Camera->name}}
                                                            </td>
                                                            <td>
                                                                {{$Camera->Observationstation->name}}
                                                            </td>
                                                            <td>
                                                                {{$Camera->username}}
                                                            </td>
                                                            <td>
                                                                {{$Camera->ipaddress}}
                                                            </td>
                                                            <td>
                                                                {{$Camera->description}}
                                                            </td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm">
                                                                    <a href="{{route('Camera.edit',$Camera->id)}}"
                                                                        class="btn btn-sm btn-warning">Sửa</a>
                                                                    <form
                                                                        action="{{route('Camera.delete',$Camera->id)}}"
                                                                        method="post">
                                                                        <input type="hidden" name="_token"
                                                                            value="{{csrf_token()}}">
                                                                        <button class="btn btn-sm btn-danger rounded-0">
                                                                            Xóa
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex justify-content-center">{{$cameras->links()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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
    <script type="">
        $(document).on('click','.open_modal',function(){
            //alert($(this).val());
            //$('#myModal').modal('show');
        });
    </script>
</body>

</html>
