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
                            <h2>Quản lý tin bài</h2>
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
                                    <h3 class="card-title">Sửa tin bài</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('Post.edit',$PostItem->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group" data-select2-id="76">
                                            <label>Chuyên mục bài viết (<span style="color: red;">*</span>)</label>
                                            <select class="form-control select2 select2-hidden-accessible"
                                                name="catepostid" id="catepostid" style="width: 100%;">
                                               <!--  <option value="">Chọn chuyên mục bài viết</option> -->
                                                @foreach($CategoryPosts as $CategoryPost)
                                                    @if ($CategoryPost->parentcateid == null)
                                                        <option
                                                            {{ $CategoryPost->id === $PostItem->catepostid? 'selected' : '' }}
                                                            value="{{$CategoryPost->id}}">{{$CategoryPost->name}}
                                                        </option>
                                                        @foreach ( $CategoryPosts as $CategoryPost1 )
                                                            @if ($CategoryPost1->parentcateid == $CategoryPost->id)
                                                            <option
                                                                {{ $CategoryPost1->id === $PostItem->catepostid? 'selected' : '' }} value="{{$CategoryPost1->id}}"> --{{$CategoryPost1->name}}
                                                            </option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        {{-- <option value="{{$CategoryPost->id}}">{{$CategoryPost->name}}
                                                        </option> --}}
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tiêu đề (<span style="color: red;">*</span>)</label>
                                            <input name="title" id="slug" type="text" class="form-control"
                                                value="{{ $PostItem->title }}" onkeyup="ChangeToSlug();">
                                        </div>
                                        <div class="form-group" style="display:none" >
                                            <label>Slug</label>
                                            <input name="slug" id="convert_slug" type="text" class="form-control" value="{{ $PostItem->slug }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tóm tắt</label>
                                            <textarea style="resize:none " rows="8" name="desc" id="desc" class="ckeditor form-control">{{ $PostItem->desc }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Từ khóa tóm tắt</label>
                                            <input name="metadesc" id="metadesc" type="text" class="form-control"
                                                 value="{{ $PostItem->metadesc }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Hình ảnh bài viết</label>
                                            <input name="image" id="image" type="file" class="form-control"
                                                placeholder="Hình ảnh bài viết ...">
                                            <img src="{{asset('public/uploads/post/thumbnail/'.$PostItem->image)}}" height="100",width="100">
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả hình ảnh bài viết</label>
                                            <input name="imagedesc" id="imagedesc" type="text" class="form-control"
                                                value="{{ $PostItem->imagedesc }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nội dung (<span style="color: red;">*</span>)</label>
                                            <textarea style="resize:none " rows="8" name="contents" id="contents" class="ckeditor form-control">{{ $PostItem->contents }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Từ khóa nội dung</label>
                                            <input name="metakeywords" id="metakeywords" type="text" class="form-control"
                                                value="{{ $PostItem->metakeywords }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tác giả (<span style="color: red;">*</span>)</label>
                                            <input name="authors" id="authors" type="text" class="form-control"
                                                 value="{{ $PostItem->authors }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nguồn bài viết (<span style="color: red;">*</span>)</label>
                                            <input name="sources" id="sources" type="text" class="form-control"
                                                value="{{ $PostItem->sources }}">
                                        </div>
                                        <div class="form-group" data-select2-id="76">
                                            <label>Hiển thị</label>
                                            <select class="form-control select2 select2-hidden-accessible"
                                                name="status" id="status" style="width: 100%;">
                                                 @if($PostItem->status==0)
                                                    <option selected value="0">Hiện</option>
                                                    <option value="1">Ẩn</option>
                                                @else
                                                    <option value="0">Hiện</option>
                                                    <option selected value="1">Ẩn</option>
                                                @endif
                                            </select>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('Post') }}" class="btn btn-default float-right">
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

    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
           $('.ckeditor').ckeditor();
        });
</script>

</body>

</html>
