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
                            <h2>Quản lý Bảng điện tử</h2>
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
                                    <h3 class="card-title">Thêm mới Bảng điện tử</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('ElectronicBoard.create') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tên</label>
                                                    <input name="name" id="name" type="text" class="form-control"
                                                        placeholder="Tên ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Trạm quan trắc</label>
                                                    <select onchange="getComboA(this)"
                                                        class="form-control select2 select2-hidden-accessible"
                                                        name="loaihinhcha" id="loaihinhcha" style="width: 100%;">
                                                        @foreach ($ObservationStations as $ObservationStation)
                                                        <option value="{{$ObservationStation => id}}">
                                                            {{$ObservationStation => name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                     <label>Chỉ tiêu quan trắc</label>
                                                    <div class="custom-control custom-checkbox CheckParam"
                                                        id="CheckParam"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tọa độ X</label>
                                                    <input name="coordx" id="coordx" type="text" class="form-control"
                                                        placeholder="Tọa độ X ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tọa độ Y</label>
                                                    <input name="coordy" id="coordy" type="text" class="form-control"
                                                        placeholder="Tọa độ Y ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Mô tả</label>
                                                    <input name="note" id="note" type="text" class="form-control"
                                                        placeholder="Mô tả ...">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                            <a href="{{ route('ElectronicBoard') }}"
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
    <!-- AdminLTE for demo ElectronicBoards -->
    <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
    <script type="">
        var ObservationStations = {!! json_encode($ObservationStations => toArray()) !!};
        var Parameters = {!! json_encode($Parameters => toArray()) !!};
        var StandardParameters = {!! json_encode($StandardParameters => toArray()) !!};
        var StdStations = {!! json_encode($StdStations => toArray()) !!};
        var StationIDItem;
        var StationIDItem1 = $('#loaihinhcha').val();
        if (ObservationStations.length > 0) {
            $('#loaihinhcha').selectedIndex = 0
        }
        var strHTML;
       	StandardParameters.forEach(element => {
       		if (element.standardid == StationIDItem1) {
       			//alert(element.parameterid);
       			strHTML = "";
       			Parameters.forEach(elementParam => {
                       if (element.parameterid == elementParam.id) {
                            strHTML += '<label class="checkbox"><input type="checkbox" name="Check" id="Check1"  value="'+elementParam.id+'" /> '+ elementParam.name +' </label>';
                       }
       				//break;
       			});
       			//$('#CheckParam').append('<label class="checkbox"><input type="checkbox" name="Check" id="Check1" value="WQI" /></label>');
       		}
       	});

        $('#CheckParam').append(strHTML);
        //$('#CheckParam').append('<label class="checkbox"><input type="checkbox" name="Check" id="Check1" value="WQI" /></label>');
        $(document).on('click','.open_modal',function(){
            //alert($(this).val());
            //$('#myModal').modal('show');
        });
        function getComboA(selectObject) {
            StationIDItem = selectObject.value;
            console.log(StationIDItem);
            StandardParameters.forEach(element => {
                  if (element.standardid == StationIDItem) {
                      alert(element.parameterid);
                  }
            });
        }

        function getParam(stationid){
            var strHTML;
            StdStations.forEach(StdStationsItem => {
                if (StdStationsItem.stationid == stationid) {
                    StandardParameters.forEach(StandardParametersItem => {
                        if (StandardParametersItem.) {

                        }
                    });
                }
            });
            return strHTML;
        }
    </script>
</body>

</html>
