<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-primary" style="padding: 1.15rem 1.15rem">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="dropdown" style="padding-right: 20px">
            <a href="{{ url('/') }}/webapp" class="" data-toggle="" aria-expanded="false">
                <i class="fas fa-map fa-1x" style="color: white"></i>
                <span style="color: white;" class="hidden-xs">
                    <span class="mdi-format-float-center"> &nbsp;&nbsp;Bản đồ</span>
                </span>
            </a>
        </li>
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-1x" style="color: white"></i>
                <span style="color: white;" class="hidden-xs">
                    @if (auth()->guest())
                    <span class="mdi-format-float-center"> &nbsp;&nbsp;Admin</span>
                    @else
                        <span class="mdi-format-float-center">{{ Auth::user()->username }}</span>
                    @endif
                </span>
            </a>
            <ul class="dropdown-menu">
                @if (auth()->guest())
                @else
                <li class="user-header">
                  <i class="fas fa-user-circle fa-5x"></i>
                    <p>
                        <span>Tài khoản: {{ Auth::user()->username }}</span>
                    </p>
                    <p><span> Họ và tên: {{ Auth::user()->name }}</span></p>
                </li>
                @endif
                <!-- User image -->

                <!-- Menu Body -->
                {{-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li> --}}
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="float-left">
                        <a href="#" class="btn btn-default btn-flat">Thông tin tài khoản</a>
                    </div>
                    <div class="float-right">
                        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Thoát</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>


</nav>
<!-- /.navbar -->

<script type="text/javascript">

    function ChangeToSlug()
        {
            var slug;

            //Lấy text từ thẻ input title
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }

</script>
