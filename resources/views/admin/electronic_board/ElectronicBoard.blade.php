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
                            <h2>Quản lý bảng điện tử</h2>
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
                                        <a href="{{ route('ElectronicBoard.create') }}"
                                            class="btn btn-block bg-gradient-primary">
                                            Thêm
                                        </a>
                                    </div>
                                    <div class="card-tools">
                                        <form method="get" action="{{ route('ElectronicBoardtk') }}">
                                            @csrf
                                            <div class="input-group input-group-prepend" style="width: 250px;">
                                                <input type="text" name="search" class="form-control float-right"
                                                    placeholder="Tên bảng, Ghi chú, Tên trạm">

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
                                                            <th scope="col" class="">Tên bảng</th>
                                                            <th scope="col" class="">Tên trạm</th>
                                                            <th scope="col" class="">Tọa độ X</th>
                                                            <th scope="col" class="">Tọa độ Y</th>
                                                            <th scope="col" class="">Ghi chú</th>
                                                            <th scope="col" class="">Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($ElectronicBoards as $key => $ElectronicBoard)
                                                        <tr class="text-center">
                                                            <td scope="row">
                                                                {{ $ElectronicBoards->firstItem() + $key }}
                                                            </td>
                                                            <td>
                                                                {{$ElectronicBoard->name}}
                                                            </td>
                                                            <td>
                                                                {{$ElectronicBoard->Observationstation->name}}
                                                            </td>
                                                            <td>
                                                                {{$ElectronicBoard->coordx}}
                                                            </td>
                                                            <td>
                                                                {{$ElectronicBoard->coordy}}
                                                            </td>
                                                            <td>
                                                                {{$ElectronicBoard->note}}
                                                            </td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm">
                                                                    <a href="{{route('ElectronicBoard.edit',$ElectronicBoard->id)}}"
                                                                        class="btn btn-sm btn-warning">Sửa</a>
                                                                    <form
                                                                        action="{{route('ElectronicBoard.delete',$ElectronicBoard->id)}}"
                                                                        method="post">
                                                                        <input type="hidden" name="_token"
                                                                            value="{{csrf_token()}}">
                                                                        {{-- <input type="hidden" name="_method" value="destroy"> --}}
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
                                            <div class="d-flex justify-content-center">{{$ElectronicBoards->links()}}
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
    <!-- AdminLTE for demo ElectronicBoards -->
    <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
    <script type="">
        $(document).on('click','.open_modal',function(){
            //alert($(this).val());
            //$('#myModal').modal('show');
        });
    </script>
</body>

</html>
