/*---- Hàm cắt chuối JSON trả về theo thời gian ----*/
function onChangeTime_feature(time, type) {
    /*---- Call Threshold Station using Ajax ----*/
    var detail_threshold_station;
    $.ajax({
        url: "thresholdStation",
        async: false,
        dataType: 'json',
        success: function (data) {
            detail_threshold_station = data;
        }
    });

    var data_threshold_station = detail_threshold_station.data;
    var length_station_threshold = detail_threshold_station.data.length;

    /*** Tìm thời gian x (1, 8 hoặc 24) giờ trước hoặc 30 phút trước ***/
    var d_curent = new Date();
    var d_hour_minus;
    if (type == "hour") {
        d_hour_minus = new Date(d_curent.setHours(d_curent.getHours() - time));
    } else {
        d_hour_minus = new Date(d_curent.setMinutes(d_curent.getMinutes() - time));
    }

    for (var i = 0; i < length_station_threshold; i++) {
        var total_detail = data_threshold_station[i].total_detail;
        /*** Vòng lặp phải chạy ngược từ length - 1 về 0 ==> Hàm splice mới thực hiện chính xác ***/
        for (var j = total_detail.length - 1; j >= 0; j--) {

            var detail_daytime = total_detail[j].time.split(", ");
            var detail_day = detail_daytime[1];
            var detail_time = detail_daytime[0];

            /*** Chuyển detail time sang time mặc định trong JS ***/
            var string_day = detail_day.split("/");

            /*** Gộp thành chuỗi rồi chuyển sang dạng thời gian mặc định ***/
            var data_day_time = new Date(string_day[2] + "/" + string_day[1] + "/" + string_day[0] +
                " " + detail_time);

            total_detail[j]['time_js'] = data_day_time;
            // console.log(data_day_time)

            if (data_day_time.getTime() < d_hour_minus.getTime()) {
                /*** Dùng hàm Splice cắt phần tử mảng ở vị trí thứ j và bỏ đi 1 phần tử ***/
                total_detail.splice(j, 1);
            }
            detail_threshold_station.data[i].total_detail = total_detail;
        }
        sortResults(total_detail, 'time_js', false);
    }

    data_threshold_station = detail_threshold_station.data;
    length_station_threshold = detail_threshold_station.data.length;

    /*** Filter Object để loại bỏ các trạm có độ dài detail bằng 0 ***/
    data_threshold_station = data_threshold_station.filter(function (obj) {
        return obj.total_detail.length !== 0;
    });

    detail_threshold_station.data = data_threshold_station;
    var resutl_total_threshold_station = detail_threshold_station;

    return resutl_total_threshold_station;
}

/*** Hàm gửi mail ***/
function sendMail_threshold() {
    var total_threshold_station = onChangeTime_feature(30, "minute");
    var html = '<html><head><title>Danh sách vượt ngưỡng</title></head><body><b>Danh sách vượt ngưỡng</b>';

    for (var i = 0; i < total_threshold_station.data.length; i++) {
        html += '<h3>Trạm quan trắc: ' + total_threshold_station.data[i].name + '</h3>';
        var total_detail = total_threshold_station.data[i].total_detail;
        for (var i_dom_threshold = 0; i_dom_threshold < total_detail.length; i_dom_threshold++) {
            var detail_data_value = total_detail[i_dom_threshold].data;
            var detail_data_daytime = total_detail[i_dom_threshold].time.split(", ");
            var detail_data_day = detail_data_daytime[1];
            var detail_data_time = detail_data_daytime[0];
            var j_threshold;
            var td_id_threshold;
            var valueinlimit;

            html += '<h4>Ngày: ' + detail_data_day + '</h4>';
            html += '<h3>Giờ: ' + detail_data_time + '</h3>';

            html += '<table>' +
                '<tr>' +
                '<th>Thông số</th><th>Giá trị</th>' +
                '</tr>';

            for (j_threshold = 0; j_threshold < detail_data_value.length; j_threshold++) {
                spidID = Object.keys(detail_data_value[j_threshold]);
                td_id_threshold = spidID + "_" + i_dom_threshold;

                value = Object.values(detail_data_value[j_threshold]);
                for (var k_value_threshold = 0; k_value_threshold < total_std_param.length; k_value_threshold++) {
                    if (parseInt(spidID) == total_std_param[k_value_threshold].id) {
                        valueinlimit = value[0].v;
                        unitName = total_std_param[k_value_threshold].unitName;
                        if (value[0].inlimit == "N") {
                            html += '<tr>' +
                                '<td>' + total_std_param[k_value_threshold].parameterName +
                                '</td><td style="color: green; ' +
                                'font-weight: bold">' + valueinlimit.toString() + " " + unitName + '</td>' +
                                '</tr>';
                        } else {
                            html += '<tr>' +
                                '<td>' + total_std_param[k_value_threshold].parameterName +
                                '</td><td style="color: red; ' +
                                'font-weight: bold">' + valueinlimit.toString() + " " + unitName + '</td>' +
                                '</tr>';
                        }
                    }
                }
            }
            html += '</table>';
        }

    }

    html += '</body></html>';

    $.post("app/Http/Controllers/Call_sendMail_threshold.php", {
        content: html
    });
}

/*** 30 phút sẽ gọi hàm gửi Mail 1 lần ***/
 let timerId = setInterval(() => sendMail_threshold(), 1800000);
/*** let timerId = setInterval(() => sendMail_threshold(), 10000); ***/
