# Quan trắc Trà Vinh

### References
+ https://datatables.net/forums/discussion/29866/datatables-buttons-removes-the-length-menu
+ https://datatables.net/reference/option/dom
+ https://www.amcharts.com/docs/v4/concepts/formatters/formatting-date-time/
+ https://stackoverflow.com/questions/39612553/add-custom-dropdown-list-datatables-plugin-in-correct-layout
+ https://www.amcharts.com/docs/v4/tutorials/customizing-chart-scrollbar/

### Note giao diện (Thư viện)
+ Phần export biểu đồ: sử dụng export của Amchart
+ Phần export bảng dữ liệu: sử dụng export của Datatables
+ Sửa Modal Exporting trong Amchart ==> Sửa trong thư viện Core.js
+ Sửa thư viện comboTreePlugin.js ==> Xóa dòng `this.options.collapse` và sửa file style css

### Note giao diện (đề xuất)
+ Chặn cơ chế bấm click bên ngoài modal để tắt modal thêm thuộc tính `data-backdrop="static"` và `data-keyboard="false"`
+ Cơ chế đóng mở 1 trong 2 của Search Cơ bản và Nâng cao: 
https://viblo.asia/p/bai-19-tao-collapse-va-accordion-voi-bootstrap-3-Qbq5Q1gG5D8
+ Lưu ý: phải thêm thẻ class `.panel` thì thuộc tính `data-parent` mới được thực hiện:
https://stackoverflow.com/questions/19425165/bootstrap-accordion-button-toggle-data-parent-not-working
+ Nút Navbar Collapse chuyển qua góc trái (sát Logo) ==> done
+ Border ở các Modal (Header và Footer) tăng Width ==> done
+ Điều chỉnh thanh kéo ngang (giảm Width) ==> done
+ Hiển thị kết quả thống kê
    + Giới hạn số lượng trạm so sánh: 3 ==> Bảng biểu và chart hiển thị tối đa 3 trạm (done)
    + Bảng dữ liệu báo cáo: đề xuất làm Dropdown hiển thị Chart (done)
+ Nút toggle thay đổi (xóa ==> thay đổi cơ chế làm mờ)  ==> làm nút toggle nhỏ hơn
+ Làm gọn panel heading (bấm xố dropdown nhưng không làm nút, cái đầu tiên mặc định mở) ==> done
+ Bỏ chú thích bản đồ (done)
+ Làm baner to hơn (done)
+ Bỏ nút Copy và Print, đổi màu đỏ cho các nút hiển thị 1 giờ, 8 giờ và 24 giờ (done)
+ Tool chạy batch files để ở trang Admin (tool chạy bằng Php)
+ Làm phần Scrollbar width to hơn (done) ==> thay đổi `heigth` của Scrollbar ngang (done)
+ Fit content cho modalFeature khi DOM dữ liệu từ DB
+ Hiện số liệu trạm quan trắc:
    + Đối với trạm tự động: có hiện chart
    + Đối với trạm bán tự động: không hiện chart nhưng hiện bảng số liệu 
    Datatables cho từng mẫu (không hiện số mới nhất)
    + Dom nhiều thuộc tính từ DB
    + Các mẫu theo hàng, chỉ tiêu theo hàng (Scrollbar ngang)
+ Thêm hàng kinh vĩ cho các trạm quan trắc (round 4) ==> done
+ Thêm cột trạng thái thiết bị ở bảng "Số liệu mới nhất" (áp dụng cho trạm tự động với DN)
+ Gom fromDate, toDate làm 1 input ==> tách làm 2 input
+ Thêm input "Thời gian hiển thị" dưới "Kết quả hiển thị"
+ Nếu "Kết quả hiển thị" là chọn all ==> Collapse "Thời gian hiển thị"
+ WQI, AQI nếu được chọn sẽ mở "Mục đích" và "Quy chuẩn" ==> chuyển thành Button riêng và có Modal kết quả riêng
+ Làm toogle cho phần "Tùy chọn hiển thị", đưa lên trên cùng, dàn hàng ngang
+ Bảng thống kê ko đưa Unitname (done)
+ Purpose trong phần Thông số cho xuống dòng
+ Chỉnh width input (done)  
+ Input bị lấp ở phần input show các trạm đã chọn
+ Mặc định tắt biểu đồ

### Set Up in Xampp
+ Thêm extension cho PostgreSQL: 
https://askubuntu.com/questions/599921/adminer-none-of-the-supported-php-extensions-mysqli-mysql-pdo-mysql-are-ava/600156#600156
+ Xóa toàn bộ file trong folder `htdocs`

### Note kết nối Service Php PostgreSQL
+ Tạo file config Php (Thông tin kết nối database)
+ Tạo file Geojson từ truy vấn Php PostgreSQL 
(link: https://stackoverflow.com/questions/31885031/formatting-json-to-geojson-via-php)
+ DOM option: https://www.codebyamir.com/blog/populate-a-select-dropdown-list-with-json
+ Group by trong Querry và tạo string kết quả cho cột Obstypes ==> Tạo kết quả dạng mảng để DOM
(link: https://askubuntu.com/questions/599921/adminer-none-of-the-supported-php-extensions-mysqli-mysql-pdo-mysql-are-ava/600156#600156)
+ Tạo JSON Nested: 
https://www.semicolonworld.com/question/32508/add-json-element-to-multidimensional-json-object-php

### Note xử lý onchange in map using Select Option/Checkbox Input
+ Sự kiện search sẽ thay đổi theo cấp từ lớn tới nhỏ và có tính phụ thuộc nhau ==> done
+ Xử lý sự kiện `onChange`: xử lý duplicate Option Select: https://forum.jquery.com/topic/jquery-how-to-remove-duplicates-from-dropdown-select-box
+ Bắt sự kiện Option Checkbox để đóng/mở parent/children theo ý muốn `var obj_node = $('li#2.jstree-node.jstree-open')` ==> không hiệu quả khi có
thêm mảng loại hình mới ==> thêm thuộc tính ở phần core `'expand_selected_onload': false` ==> done
(https://groups.google.com/forum/#!topic/jstree/EoDgKTh5xFc)
+ Thêm event `onChange` vào `<select class="form-control" id="quantrac" onchange="search_tramqt()"></select>`
+ Vào trang show tất cả điểm (lựa chọn loại hình được tích `Tất cả` ==> done)
+ Ghép chuỗi trong service: sử dụng linh hoạt `%20` (dấu " ") và `%27` (dấu "'") ==> Chuyển sang GET id nên không sử dụng `%27`
+ Đưa về sử dụng Leaflet Ajax + Option Onchange + Ghép chuỗi service URL
+ Thanks my Master: http://dev.dothanhlong.org/geoserver_cql_query_ajax_json/
+ Ban đầu sử dụng ComboTree_Plguin ==> Hỗ trợ Onchange không hiệu quả ==> Chuyển sang sử dụng Kendo_UI ==> done
+ Kendo_UI có tính phí, sử dụng bản miễn phí chỉ có 30 ngày ==> Chuyển sang Plugin TreeJS ==> done
+ Close All Open Node Specify Branches: https://groups.google.com/forum/#!topic/jstree/EoDgKTh5xFc
+ Chuyển ID dạng Text sang dạng số (tránh lỗi Php khi gọi dạng text sẽ không truy vấn được)
+ Xử lý fitbound theo onChange Select/Checkbox: https://groups.google.com/forum/#!topic/leaflet-js/F66YlMCaQK4 ==> lỗi khi fitbound về 1 đối tượng sẽ zoom hết cỡ
+ Lựa chọn cơ chế chọn điểm fitbounds mới: https://github.com/geosquare/geojson-bbox

### Xử lý DOM dữ liệu bán tự động
+ Sử dụng js datetimepicker để chặn cơ chế load từ ngày đến ngày sai: https://stackoverflow.com/questions/41236574/bootstrap-datetimepicker-not-working-with-the-jquery-3
+ Cố định 1 cột và scroll các cột còn lại: https://jsfiddle.net/DTcHh/19842/
+ Cần `destroy` bảng trước khi tạo bảng mới: https://datatables.net/manual/tech-notes/3 ==> lỗi khi người dùng
click "Xem dữ liệu" các lần chẵn (tức là lần 2, 4, 6, ...) thì không mở được data-child ==> sử dụng cơ chế
`ajax.url().load` khi có url mới cho Datatables: https://datatables.net/reference/api/ajax.url().load()
+ Kiểm tra bảng có dữ liệu hay chưa: https://datatables.net/reference/api/%24.fn.dataTable.isDataTable
+ Cần xử lý cách DOM bảng Child (done)
+ Đối với 1 số VPS không hỗ trợ lấy Date có dấu nháy cần phải làm cách khác (đã note trong code)
+ Thêm ở thuộc tính `column` để có thể mở `row_child`:
```
    {
        "className": 'details-control',
        "orderable": false,
        "data": null,
        "defaultContent": ''
    }
```

### Note DB Observation
+ Mỗi 1 thời điểm (tức cứ 5 phút) là sẽ có 1 row/1 trạm/1 thời điểm (time, date)/1 detail
+ `Date và time` ở ngoài cần phải giống với `Date và time` trong detail

### Xử lý DOM dữ liệu danh sách vượt ngưỡng (chỉ áp dụng cho trạm tự động và trạm doanh nghiệp)
+ Xử lý gộp tất cả detail của 1 trạm vào 1 detail duy nhất
+ Khi xử lý gộp thì sử dụng hàm `distinct` trong SQL để tránh trường hợp trùng `obstype_namelist`
+ Để có thể DOM dữ liệu vượt ngưỡng cần phải DOM đúng vị trí các cột ==> Cần phải xây dựng hàm dựng 
lại layout bảng, sau đó mới DOM các giá trị vào trong thành phần bảng con
+ Khi load dữ liệu lần đầu luôn là 1 giờ trước sau đó mới onChange theo 8 giờ hoặc 24 giờ

### Xử lý DOM dữ liệu danh sách vượt ngưỡng (onChange theo 1, 8 hoặc 24)
+ Hiện tại đang gán cứng `total_threshold_station` ==> cần onChange theo số giờ của dữ liệu (done)
+ Xây dựng hàm `feature_onChange` (done)
+ DOM dữ liệu lần đầu luôn là 1 giờ (done)
+ Xử lý onChange theo các nút 1, 8, 24h (done)
+ Ý tưởng tiếp theo: viết function để tạo bảng datatable ==> Không khả thi khi tạo hàm
+ Thêm thuộc tính ScrollY cho datatable ==> Lỗi trong lần load đầu tiên (gom cột) ==> thêm phần style CSS
```
/* Thêm class `fixed_header` cho các thẻ td */
    #table_threshold {
        width: 100%;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }
    
    #table_threshold_wrapper .row:nth-child(2) {
        margin-top: 6px;
    }
    
    #table_threshold_wrapper .col-sm-12 {
        height: 40vh;
        overflow-y: scroll;
    }
    
    #table_threshold_wrapper .col-sm-12 thead .fixed_header{
        position: sticky;
        top: 0;
        z-index: 1;
    }
```
+ Khi các button kích hoạt, phải clear dữ liệu trước đó `$('#table_threshold').DataTable().clear().draw();`, sau đó
add data mới vào bảng dữ liệu
+ Hàm `onChangeTime_feature(time)` cần được sắp xếp dữ liệu lại
+ Cách add dữ liệu: điều kiện phụ thuộc vào việc kích hoạt của các button, nếu button có class `active` sẽ chạy hàm
`DOM_data_child_Threshold(row_detail, time)`
+ Luồng của hàm onChange vượt ngưỡng: click button `DS vượt ngưỡng` ==> `getData_threshold_station()` 
==> `onChangeTime_feature(1)` chạy hàm để lấy data từ db lấy dữ liệu trong 1 giờ gần nhất
==> `format()` có ID là thresholdModal, lấy row_detail (là hàng dữ liệu để show child) 
==> Tạo bảng chứa sẵn ==> `DOM_data_child_Threshold(row_detail, time)` để DOM dữ liệu child theo time nào và tại dòng nào
    + Nếu button nào được bật theo `time` nào ==> xóa bảng dữ liệu trước đó bằng `clear().draw()`
    + Đẩy dữ liệu mới dùng `onChangeTime_feature(time)`
    + DOM lại cột cho bảng dữ liệu dùng `table_threshold.columns.adjust().draw();`
    + Quay lại từ chỗ quy trình từ `format()` có ID là thresholdModal trở đi
+ Khi tắt thresholdModal và mở lại, sử dụng hàm `trigger` để kích hoạt nút button 1 giờ
+ Trong hàm `format()` với trường hợp `thresholdModal`, các element ID cần có thông số của `row_detail` ==>
tránh trường hợp khi có các hàng với thông số hoặc số liệu giống nhau, sẽ bị DOM thay thế nhau ==> các row sau sẽ bị trống
nhưng thực tế là có dữ liệu vì dữ liệu đã bị DOM thay thế lên row đầu tiên

### Xử lý DOM dữ liệu trạm tự động và doanh nghiệp ra Chart
+ Yêu cầu: thay đổi chart theo thời gian (1, 8 hoặc 24 giờ), theo kiểu chart (đường hoặc cột) và theo thông số (Ph, SO2, ...)
+ Xử lý từng Dropdown, trong đó theo thời gian và theo thông số sẽ không phụ thuộc nhau
+ Xử lý tạo chuỗi total detail mới: thêm vào service `call_obser_station.php` thêm phần tìm thời gian sớm nhất ==> 
sau đó sử dụng thời gian đó so sánh với thời gian của detail (gần tương tự với hàm vượt ngưỡng) ==> nếu phù hợp
sẽ `push` vào 1 mảng mới (không push vào mảng cũ vì sẽ làm thay đổi dữ liệu gốc ban đầu của detail đó)
+ Thay đổi: dữ liệu được DOM theo thời gian hệ thống

### Xử lý DOM dữ liệu thống kê
+ Sửa Services `call_stat_station.php` do gọi dữ liệu bị trùng lặp và sai các thông số (done)
+ Không xử lý trung bình trong 1 giờ của trạm bán tự động (pending)
+ Các thông số của các trạm quan trắc cần phải giống nhau
+ Get a list of checked checkboxes in a div using jQuery: 
https://stackoverflow.com/questions/2155622/get-a-list-of-checked-checkboxes-in-a-div-using-jquery
+ Luồng xử lý: Chia làm 4 luồng chính:
    + Luồng 1: Sau khi chọn các option 'Loại hình', 'Loại trạm', 'Quận huyện' và 'Quy chuẩn' ==> Show danh sách
    các trạm quan trắc ==> Chỉ được chọn 5 Trạm ==> DOM các trạm trong thẻ input, đồng thời lưu 1 mảng các trạm quan trắc
    được chọn
    + Luồng 2: Click vào 'Thông số' ==> Show các thông số của trạm ==> Chọn thông số ==> DOM các thông số và đồng thời
    lưu 1 mảng các thông số được Chọn ==> Xử lý mảng lưu các trạm quan trắc (cắt JSON theo thông số)
    + Luồng 3: Chọn các Option còn lại ==> Fromdate 00:00:00 từ và Todate 23:59:59
    + Luồng 4: Nhấn Thống kê ==> Xử lý mảng lưu các trạm quan trắc (cắt JSON theo thời gian) ==> DOM chart và datatables
+ FromDate_stat và ToDate_stat phải có giá trị
+ Kết quả hiển thị khi lựa chọn "Tất cả giá trị" ==> Collapse "Thời gian hiển thị"
+ DOM dữ liệu Datatables cần config lại file json trả về
+ Find Unique Object: https://stackoverflow.com/questions/38613654/javascript-find-unique-objects-in-array-based-on-multiple-properties
+ Colspan/Rowspan Datatable (Complex Datatable): https://datatables.net/examples/basic_init/complex_header.html
+ Check all jquery: https://codepen.io/jackharner/pen/wZPeBw?editors=0010
+ Scroll ngang fixed left column: https://codepen.io/paulobrien/pen/LBrMxa?editors=0100
+ DOM onchange typechart ==> Lỗi khi thay đổi bằng 1 sự kiện khác (onchange select hoặc cancel rồi nhấn nút Thống kê lại) ==> DOM sai vị trí các thông số ==> thêm hàm `trigger()` gọi lại hàm xử lý cắt chuỗi JSON theo thông số và theo thời gian (done)
+ Convert HTML table to Excel file with JS: https://redstapler.co/convert-html-table-excel-file-javascript/
+ Convert HTML table to PDF file with JS: https://www.encodedna.com/javascript/convert-html-table-to-pdf-using-javascript-without-a-plugin.htm

### Tối ưu hóa đợt 1
+ Tìm các thư viện nặng nhưng không sử dụng đến để loại bỏ
+ Tối ưu hóa thuật toán fitbounds (xem ở phần "Note xử lý onChange in map using Select Option/Checkbox Input")

### Tối ưu hóa đợt 2
+ Tìm cách load chart nhanh hơn trong render: https://www.amcharts.com/docs/v4/concepts/performance/#:~:text=With%20amCharts%204's%20built%2Din,its%20container%20scrolls%20into%20view.&text=onlyShowOnViewport%20%3D%20true%3B%20IMPORTANT-,This%20line%20needs%20to%20go%20before%20any%20chart%20is%20created,not%20strain%20the%20CPU%20unnecessarily.
+ Lazy loading amCharts modules: https://www.amcharts.com/docs/v4/tutorials/lazy-loading-amcharts-modules/
+ Make the charts "lazy-initialize" only when they scroll into view: https://codepen.io/team/amcharts/pen/Mwmevj?editors=0010
