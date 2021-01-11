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
                            <h2>Quản lý danh mục tin bài</h2>
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
                                    <h3 class="card-title">Thêm mới danh mục tin bài</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('CatePost.create') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group" data-select2-id="76">
                                            <label>Danh mục cha</label>
                                            <select class="form-control select2 select2-hidden-accessible"
                                                name="parentcateid" id="parentcateid" style="width: 100%;">
                                                <option value="">--Chọn danh mục tin bài--</option>
                                                @foreach($CategoryPosts as $CategoryPost)
                                                    @if ($CategoryPost->parentcateid == null)
                                                        <option value="{{$CategoryPost->id}}">{{$CategoryPost->name}}
                                                        </option>
                                                        @foreach ( $CategoryPosts as $CategoryPost1 )
                                                            @if ($CategoryPost1->parencatetid == $CategoryPost->id)
                                                            <option value="{{$CategoryPost1->id}}">
                                                                --{{$CategoryPost1->name}}
                                                            </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tên (<span style="color: red;">*</span>)</label>
                                            <input name="name" id="slug" type="text" class="form-control"
                                                placeholder="Tên ..." onkeyup="ChangeToSlug();">
                                        </div>
                                        <div class="form-group" style="display:none" >
                                            <label>Slug</label>
                                            <input name="slug" id="convert_slug" type="text" class="form-control"
                                                placeholder="Slug ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <input name="desc" id="desc" type="text" class="form-control"
                                                placeholder="Mô tả ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Từ khóa</label>
                                            <input name="keywords" id="keywords" type="text" class="form-control"
                                                placeholder="Từ khóa ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Thứ tự (<span style="color: red;">*</span>)</label>
                                            <input name="order" id="order" type="text" class="form-control"
                                                placeholder="Thứ tự ...">
                                        </div>
                                        <div class="form-group" data-select2-id="76">
                                            <label>Hiển thị</label>
                                            <select class="form-control select2 select2-hidden-accessible"
                                                name="status" id="status" style="width: 100%;">
                                                <option value="0">Hiện</option>
                                                <option value="1">Ẩn</option>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('CatePost') }}" class="btn btn-default float-right">
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
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>

</body>

</html>
