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
    <link rel="stylesheet"
        href=" {{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href=" {{ asset('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
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
                            <h2>Quản lý chức năng</h2>
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
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                        </div>
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-1">
                                            <a href="{{ route('menu.create') }}"
                                                class="btn btn-block bg-gradient-primary">
                                                Thêm
                                            </a>
                                        </div>
                                        <div class="col-sm-12 col-md-8">

                                        </div>
                                        <div class="card-tools">
                                            <form method="get" action="{{ route('menutk') }}">
                                                @csrf
                                                <div class="input-group input-group-prepend" style="width: 250px;">
                                                    <input type="text" name="search" class="form-control float-right"
                                                    placeholder="Tên, mô tả">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn  btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr class="text-center text-sm">
                                                            <th scope="col" class="">STT</th>
                                                            <th scope="col" class="">Tên chức năng</th>
                                                            <th scope="col" class="">Link menu</th>
                                                            <th scope="col" class="">Mô tả</th>
                                                            <th scope="col" class="">Danh sách Action</th>
                                                            <th scope="col" class="">Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php$i = 1; @endphp
                                                            @foreach($chucnangs1 as $chucnang)
                                                                @if($chucnang->parent_id == null)
                                                                    <tr class="text-center">
                                                                        <td class="text-left text-bold text-sm"
                                                                            colspan="6">Nhóm
                                                                            chức năng: {{ $chucnang->name }}</td>
                                                                    </tr>
                                                                @endif
                                                                @php $i = 0; @endphp
                                                                @foreach($chucnangs1 as $key => $item)
                                                                    @if($item->parent_id == $chucnang->id)
                                                                    @php $i += 1; @endphp
                                                                        @foreach($item->menus as $key1 => $itemaction)
                                                                        <tr>
                                                                            @if ($key1 == 0)
                                                                            <td class="align-middle"
                                                                                rowspan="{{ count($item->Permissions) }}">
                                                                                {{ $i }}
                                                                            </td>
                                                                            <td class="align-middle"
                                                                                rowspan="{{ count($item->Permissions) }}">
                                                                                {{ $item->name }}</td>
                                                                            <td class="align-middle"
                                                                                rowspan="{{ count($item->Permissions) }}">
                                                                                {{ $item->Link }}</td>
                                                                            <td class="align-middle"
                                                                                rowspan="{{ count($item->Permissions) }}">
                                                                                {{ $item->description }}</td>
                                                                            @endif
                                                                            <td class="align-items-center">
                                                                                <span
                                                                                    class="badge bg-primary">{{ $itemaction->display_name.'('. $itemaction->name.')' }}</span>
                                                                            </td>
                                                                            @if ($key1 == 0)
                                                                                <td class="align-middle"
                                                                                    rowspan="{{ count($item->Permissions) }}">
                                                                                    <div
                                                                                        class="btn-group btn-group-sm align-middle">
                                                                                        <a href="{{route('menu.edit',$item->id)}}"
                                                                                            class="btn btn-sm btn-warning">Sửa</a>
                                                                                        <form
                                                                                            id="delete-form-{{ $item->id }}"
                                                                                            action="{{route('menu.delete',$item->id)}}"
                                                                                            method="post">
                                                                                            <input type="hidden"
                                                                                                name="_token"
                                                                                                value="{{csrf_token()}}">
                                                                                            <button
                                                                                                class="btn btn-sm btn-danger rounded-0"
                                                                                                onclick="delConfirm({{ $item->id }},'{{$item->name}}')">
                                                                                                Xóa
                                                                                            </button>
                                                                                        </form>
                                                                                    </div>
                                                                                </td>
                                                                            @endif
                                                                            {{-- <td>
                                                                                <div
                                                                                    class="btn-group btn-group-sm align-middle">
                                                                                    <a href="{{route('permission.edit',$itemaction->id)}}"
                                                                                        class="btn btn-sm btn-warning">Sửa</a>
                                                                                    <form
                                                                                        action="{{route('permission.delete',$itemaction->id)}}"
                                                                                        method="post">
                                                                                        <input type="hidden"
                                                                                            name="_token"
                                                                                            value="{{csrf_token()}}">
                                                                                        <button
                                                                                            class="btn btn-sm btn-danger rounded-0">
                                                                                            Xóa
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                            </td> --}}
                                                                        </tr>
                                                                        @endforeach

                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex justify-content-center">
                                                {{$chucnangs1->links('vendor.pagination.paginator')}}
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
    <script src=" {{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    <!-- overlayScrollbars -->
    <script
        src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
    </script>
    <!-- AdminLTE App -->
    <script src=" {{ asset('public/admin/dist/js/adminlte.min.js') }} "></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
    <script type="">
        $(document).on('click','.open_modal',function(){
            //alert($(this).val());
            //$('#myModal').modal('show');
        });
    </script>
</body>

</html>
