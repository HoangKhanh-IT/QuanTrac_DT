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
                            <h2>Quản lý chức năng</h2>
                        </div>
                    </div>
                    <div class="row mb-12">
                        <div class="col-sm-12">
                            @if(session()->get('success'))
                            <div class="alert alert-danger">
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
                            </div>
                            @endif
                            <div class="card card-primary">

                                <div class="card-header">
                                    <h3 class="card-title">Thêm mới quyền chức năng</h3>
                                </div>

                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('permission.create') }}">
                                    @csrf
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>Chức năng</label>
                                            <select class="form-control select2 select2-hidden-accessible"
                                                name="loaihinhcha" id="loaihinhcha" style="width: 100%;">

                                                @foreach($chucnangs as $nhomCN)
                                                    @if ($nhomCN ->parent_id == null)
                                                        <option readonly="readonly" value="null">Nhóm: {{ $nhomCN->name }}
                                                        </option>
                                                        @foreach($chucnangs as $item)
                                                            @if ($item->parent_id == $nhomCN->id)
                                                                <option readonly="readonly" value="{{ $item->id.'_'.$item->code }}">-----{{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                {{-- <option value="danhmuc">Nhóm danh mục hệ thống</option>
                                                <option value="quanly">Nhóm quản trị dữ liệu</option>
                                                <option value="quantri">Nhóm quản trị hệ thống</option> --}}
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Danh sách Action</label>
                                            <table class="table table-bordered" id="dynamicTable">
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Mô tả</th>
                                                    {{-- <th>Price</th> --}}
                                                    <th> </th>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="addmore[0][name]" placeholder="Action" class="form-control" /></td>
                                                    <td><input type="text" name="addmore[0][display_name]" placeholder="Mô tả" class="form-control" /></td>
                                                    {{-- <td><input type="text" name="addmore[0][price]" placeholder="Enter your Price" class="form-control" /></td> --}}
                                                    <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fas fa-plus-square"></i></button></td>
                                                </tr>
                                            </table>
                                        </div>
                                        {{-- <div class="form-group" data-select2-id="76">

                                        </div>
                                        <div class="form-group">
                                            <label>Mã</label>
                                            <input name="maloaihinh" id="maloaihinh" type="text" class="form-control" placeholder="Mã ...">
                                        </div> --}}
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('permission') }}" class="btn btn-default float-right">
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

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tour</h4>
                    </div>
                    <div class="modal-body">
                        <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                            <div class="form-group error">
                                <label for="inputName" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control has-error" id="name" name="name"
                                        placeholder="Product Name" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDetail" class="col-sm-3 control-label">Details</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="details" name="details"
                                        placeholder="details" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                        <input type="hidden" id="product_id" name="tour_id" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-primary" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-primary">
                <div class="modal-header">
                    <h4 class="modal-title">Primary Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-light">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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


    <script type="text/javascript">


        // $(document).on('click', '.remove-tr', function(){
        //     $(this).parents('tr').remove();
        // });
        // $(document).on('click','.open_modal',function(){
        //     //alert($(this).val());
        //     //$('#myModal').modal('show');
        // });
    </script>
</body>

</html>
<script type="text/javascript">
    var i = 0;

    $("#add").click(function(){
        ++i;
        $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" placeholder="Action" class="form-control" /></td><td><input type="text" name="addmore['+i+'][display_name]" placeholder="Mô tả" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-minus-square"></i></button></td></tr>');
    });

    $(document).on('click', '.remove-tr', function(){
         $(this).parents('tr').remove();
    });

</script>

