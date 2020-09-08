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
                           <h2>Quản lý Quy chuẩn - Chi tiêu</h2>
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
                                   <h3 class="card-title">Sửa Quy chuẩn - Chi tiêu</h3>
                               </div>
                               <!-- /.card-header -->
                               <!-- form start -->
                               <form method="post"
                                   action="{{ route('StandardParameter.edit',$StandardParameter->id) }}">
                                   @csrf
                                   <div class="card-body">
                                       <div class="form-group">
                                           <label>Quy chuẩn (<span style="color: red;">*</span>)</label>
                                           <select class="js-example-basic-single form-control"
                                               name="standard" id="standard" style="width: 100%;">
                                               @foreach ($standards as $standard)
                                               <option {{$StandardParameter->standardid === $standard->id ? 'selected':'' }}
                                                   value="{{ $standard->id }}">
                                                   {{ $standard->name }}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                       <div class="form-group">
                                           <label>Mục đích sử dụng</label>
                                           <select class="js-example-basic-single form-control"name="purpose"
                                               id="purpose" style="width: 100%;">
                                               @foreach ($purposes as $purpose)
                                               <option {{$StandardParameter->purposeid == $purpose->id ? "selected":""}} value="{{ $purpose->id }}">
                                                   {{ $purpose->name }}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                       <div class="form-group">
                                           <label>Tên thông số (<span style="color: red;">*</span>)</label>
                                           <select class="js-example-basic-single form-control"
                                               name="paramerter" id="paramerter" style="width: 100%;">
                                               @foreach ($paramerters as $paramerter)
                                               <option  {{$StandardParameter->parameterid == $paramerter->id ? "selected":""}}
                                                   value="{{ $paramerter->id }}">{{ $paramerter->name }}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                       <div class="form-group">
                                           <label>Đơn vị</label>
                                           <select class="js-example-basic-single form-control" name="unit"
                                               id="unit" style="width: 100%;">
                                               @foreach ($units as $unit)
                                               <option
                                                   {{$StandardParameter->unitid == $unit->id ? "selected":""}}
                                                   value="{{ $unit->id }}">{{ $unit->name }}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                       <div class="form-group">
                                           <label>Giới hạn nhỏ nhất</label>
                                           <input name="minvalue" id="minvalue" type="text" class="form-control"
                                       placeholder="Giới hạn nhỏ nhất ..." value="{{ $StandardParameter->minvalue }}">
                                       </div>
                                       <div class="form-group">
                                           <label>Giới hạn lớn nhất</label>
                                           <input name="maxvalue" id="maxvalue" type="text" class="form-control"
                                               placeholder="Giới hạn lớn nhất ..."
                                               value="{{ $StandardParameter->maxvalue }}">
                                       </div>
                                       <div class="form-group">
                                           <label>Phương pháp phân tích</label>
                                           <input name="analysismethod" id="analysismethod" type="text"
                                               class="form-control" placeholder="Phương pháp phân tích ..."
                                               value="{{ $StandardParameter->analysismethod }}">
                                       </div>
                                   </div>
                                   <!-- /.card-body -->

                                   <div class="card-footer">
                                       <button type="submit" class="btn btn-primary">Lưu</button>
                                       <a href="{{ route('StandardParameter') }}" class="btn btn-default float-right">
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
    <script type="">
        $(document).on('click','.open_modal',function(){
            //alert($(this).val());
            //$('#myModal').modal('show');
        });
    </script>
</body>

</html>
