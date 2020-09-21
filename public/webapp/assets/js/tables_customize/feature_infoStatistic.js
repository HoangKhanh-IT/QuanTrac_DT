/*---- Cắt chuỗi theo thông số ----*/
function process_detail_parameter(quantrac_selected, checkboxed_para) {
    var total_detail;
    var data;

    for (var i = 0; i < quantrac_selected.length; i++) {
        total_detail = quantrac_selected[i].total_detail;
        for (var j = total_detail.length - 1; j >= 0; j--) {
            data = total_detail[j].data;

            var detail_daytime = total_detail[j].time.split(", ");
            var detail_day = detail_daytime[1];
            var detail_time = detail_daytime[0];

            /*** Chuyển detail time sang time mặc định trong JS ***/
            var string_day = detail_day.split("/");

            /*** Gộp thành chuỗi rồi chuyển sang dạng thời gian mặc định ***/
            var data_day_time = new Date(string_day[2] + "/" + string_day[1] + "/" + string_day[0] +
                " " + detail_time);

            total_detail[j]['time_js'] = data_day_time;

            /*** Kiểm tra có các para đã đó trước đó và còn ở trong mảng không, nếu có thì delete ***/
            for (var k_check = data.length - 1; k_check >= 0; k_check--) {
                var spidID_check = Object.keys(data[k_check]);

                for (var k_para_check = 0; k_para_check < checkboxed_para.length; k_para_check++) {
                    if (parseInt(spidID_check) != parseInt(checkboxed_para[k_para_check])) {
                        delete total_detail[j][spidID_check]
                    }
                }
            }

            for (var k = data.length - 1; k >= 0; k--) {
                var spidID = Object.keys(data[k]);
                var value = Object.values(data[k]);

                for (var k_para_sample = 0; k_para_sample < total_std_param.length; k_para_sample++) {
                    for (var k_para_checked = 0; k_para_checked < checkboxed_para.length; k_para_checked++) {
                        if (parseInt(spidID) == total_std_param[k_para_sample].id &&
                            parseInt(spidID) == parseInt(checkboxed_para[k_para_checked])) {
                            total_detail[j][spidID] = value[0].v;
                        }
                    }
                }
            }
        }
        sortResults(total_detail, 'time_js', true);
    }

    for (var i_check_quantrac = 0; i_check_quantrac < quantrac_selected.length; i_check_quantrac++) {
        total_detail = quantrac_selected[i_check_quantrac].total_detail;
        for (var j_total = total_detail.length - 1; j_total >= 0; j_total--) {
            var key_para = Object.keys(total_detail[j_total]);
            var arr_exprop = compare_2array(checkboxed_para, key_para).arr1;
            for (var i_exprop = 0; i_exprop < arr_exprop.length; i_exprop++) {
                total_detail[j_total][arr_exprop[i_exprop]] = null;
            }
        }
    }

    return quantrac_selected;
}

function convert_dateInput_to_dateJS(date, string_time) {
    /*** Chuyển sang time mặc định trong JS ***/
    var string_day = date.split("/");

    /*** Gộp thành chuỗi rồi chuyển sang dạng thời gian mặc định ***/
    return new Date(string_day[2] + "/" + string_day[1] + "/" + string_day[0] + string_time);
}

function choose_Time(time_option, val) {
    var floor_time = [];
    /*** Lấy dữ liệu khoảng giờ bắt đầu - kết thúc ***/
    $.ajax({
        url: "public/webapp/assets/js/tables_customize/range_timeOption.json",
        async: false,
        dataType: 'json',
        success: function (time) {
            floor_time.push({
                "floor_start": time[time_option][val].start,
                "floor_end": time[time_option][val].end
            })
        }
    });

    return floor_time;
}

function getAverages(array, groupKeys, averageKeys) {
    var groups = {},
        result = [];

    array.forEach(o => {
        var key = groupKeys.map(k => o[k]).join('|'),
            group = groups[key];

        if (!group) {
            groups[key] = {count: 0, payload: {}};
            group = groups[key];
            averageKeys.forEach(k => group[k] = 0);
            groupKeys.forEach(k => group.payload[k] = o[k]);
            result.push(group.payload);
        }
        groups[key].count++;
        /*** Tính trung bình (kiểm tra giá trị có null hay không) ***/
        averageKeys.forEach(average);
        function average(item) {
            var dem = group.count;
            if (o[item] != null) {
                group[item] += o[item]
            } else {
                dem = dem - 1;
            }

            if (dem == 0) {
                group.payload[item] = "";
            } else {
                group.payload[item] = Math.round((group[item] / dem) * 100) / 100;
            }
        }
    })
    return result;
}

function getMinMax(array, groupKeys, maxminKeys) {
    var groups = {},
        result = [];

    array.forEach(o => {
        var key = groupKeys.map(k => o[k]).join('|'),
            group = groups[key];

        if (!group) {
            groups[key] = {count: 0, payload: {}};
            group = groups[key];
            maxminKeys.forEach(k => group[k] = 0);
            groupKeys.forEach(k => group.payload[k] = o[k]);
            result.push(group.payload);
        }
        groups[key].count++;
        maxminKeys.forEach(k => group.payload[k] = (group[k] += o[k] + ",").split(","));
    })
    return result;
}

/*---- Hàm gom các phần tử trong mảng theo Object key
Object.defineProperty(Array.prototype, 'group', {
    enumerable: false,
    value: function (key) {
        var map = {};
        this.forEach(function (e) {
            var k = key(e);
            map[k] = map[k] || [];
            map[k].push(e);
        });
        return Object.keys(map).map(function (k) {
            return {key: k, data: map[k]};
        });
    }
}); ----*/

/*---- Trả danh sách thống kê các trạm quan trắc theo số thông số được check ----*/
function result_list_stations(quantrac_selected) {
    var fromDate_stat = convert_dateInput_to_dateJS($("#FromDate_stat input").val(), " 00:00:00");
    var toDate_stat = convert_dateInput_to_dateJS($("#ToDate_stat input").val(), " 23:59:59");
    var new_quantrac_selected = quantrac_selected;

    /*---- Xử lý JSON average, min, max ----*/
    if ($("#statisticby").val() == "all_stat") {
        var new_quantrac_selected_detail = [];

        for (var i = 0; i < new_quantrac_selected.length; i++) {
            total_detail = new_quantrac_selected[i].total_detail;
            for (var j = 0; j < total_detail.length; j++) {
                /*** Thêm thông tin trạm ***/
                total_detail[j]['id_station'] = quantrac_selected[i].id;
                total_detail[j]['code_station'] = quantrac_selected[i].code;
                total_detail[j]['name_station'] = quantrac_selected[i].name;

                if (total_detail[j]['time_js'].getTime() >= fromDate_stat.getTime() &&
                    total_detail[j]['time_js'].getTime() <= toDate_stat.getTime()) {
                    new_quantrac_selected_detail.push(total_detail[j])
                }
            }
        }
        sortResults(new_quantrac_selected_detail, 'time_js', true);
        return new_quantrac_selected_detail;

    } else {
        /*** Tạo mảng kết quả cuối cùng ***/
        var quantrac_haveStartEnd = [];

        for (var i_aver = 0; i_aver < new_quantrac_selected.length; i_aver++) {
            total_tb = new_quantrac_selected[i_aver].total_detail;
            for (var j_aver = 0; j_aver < total_tb.length; j_aver++) {

                if (total_tb[j_aver]['time_js'].getTime() >= fromDate_stat.getTime() &&
                    total_tb[j_aver]['time_js'].getTime() <= toDate_stat.getTime()) {

                    /*** Thêm thông tin trạm ***/
                    total_tb[j_aver]['id_station'] = quantrac_selected[i_aver].id;
                    total_tb[j_aver]['code_station'] = quantrac_selected[i_aver].code;
                    total_tb[j_aver]['name_station'] = quantrac_selected[i_aver].name;

                    var getHours = total_tb[j_aver]['time_js'].getHours();
                    var getMinutes = total_tb[j_aver]['time_js'].getMinutes();

                    /*** Tìm thứ tự khoảng thời gian ***/
                    var rangeTime_index = Math.floor((getHours * 60 + getMinutes) /
                        parseInt($('#stat_time_display').val()));

                    /*---- Hours 1 giờ, 8 giờ, 12 giờ và 24 giờ ----*/
                    var arr_floor_time = choose_Time($('#stat_time_display').val(), rangeTime_index);

                    total_tb[j_aver]['time_start'] = arr_floor_time[0].floor_start +
                        ", " + total_tb[j_aver]['time'].split(", ")[1]
                    total_tb[j_aver]['time_end'] = arr_floor_time[0].floor_end +
                        ", " + total_tb[j_aver]['time'].split(", ")[1]

                    total_tb[j_aver]['time'] = total_tb[j_aver]['time_start'];

                    /*** Chuyển Start Time sang time mặc định trong JS ***/
                    var string_day = total_tb[j_aver]['time_start'].split(", ")[1].split("/");

                    var data_day_time = new Date(string_day[2] + "/" +
                        string_day[1] + "/" + string_day[0] +
                        " " + arr_floor_time[0].floor_start);

                    total_tb[j_aver]['time_js'] = data_day_time;

                    quantrac_haveStartEnd.push(total_tb[j_aver]);
                }
            }
        }

        /*---- Tính trung bình ----*/
        if ($("#statisticby").val() == "average_stat") {
            result_average = [];
            result_average = getAverages(quantrac_haveStartEnd,
                ["time", "time_end", "time_js", "id_station", "name_station"],
                checkboxed_para_arr)

            sortResults(result_average, 'time_js', true);
            return result_average;
        }

        /*---- Tìm Max ----*/
        if ($("#statisticby").val() == "max_stat") {
            result_max = [];
            result_max = getMinMax(quantrac_haveStartEnd,
                ["time", "time_end", "time_js", "id_station", "name_station"],
                checkboxed_para_arr)

            sortResults(result_max, 'time_js', true);

            for (var i_max = 0; i_max < result_max.length; i_max++) {
                for (var j_max = 0; j_max < checkboxed_para_arr.length; j_max++) {
                    var maxArr = result_max[i_max][checkboxed_para_arr[j_max]];
                    let max_val = -Infinity;
                    maxArr.forEach(element => {
                        if (parseFloat(element) > max_val)
                            max_val = parseFloat(element)
                    })
                    result_max[i_max][checkboxed_para_arr[j_max]] = max_val;
                }
            }

            return result_max;
        }

        /*---- Tìm Min----*/
        if ($("#statisticby").val() == "min_stat") {
            result_min = [];
            result_min = getMinMax(quantrac_haveStartEnd,
                ["time", "time_end", "time_js", "id_station", "name_station"],
                checkboxed_para_arr)

            sortResults(result_min, 'time_js', true);

            for (var i_min = 0; i_min < result_min.length; i_min++) {
                for (var j_min = 0; j_min < checkboxed_para_arr.length; j_min++) {
                    var minArr = result_min[i_min][checkboxed_para_arr[j_min]];
                    let min_val = Infinity;
                    minArr.forEach(element => {
                        if (parseFloat(element) < min_val)
                            min_val = parseFloat(element)
                    })
                    result_min[i_min][checkboxed_para_arr[j_min]] = min_val;
                }
            }

            return result_min;
        }
    }
}

function compare_2array(arr1, arr2) {
    var diff = {};
    diff.arr1 = arr1.filter(function (value) {
        if (arr2.indexOf(value) === -1) {
            return value;
        }
    });
    diff.arr2 = arr2.filter(function (value) {
        if (arr1.indexOf(value) === -1) {
            return value;
        }
    });
    diff.concat = diff.arr1.concat(diff.arr2);
    return diff;
}

/*---- Tạo mảng chứa các thời điểm duy nhất ----*/
function create_distinct_timeArray(quantrac_selected) {
    var arr_time = [];
    for (var i_arr_time = 0; i_arr_time < quantrac_selected.length; i_arr_time++) {
        arr_time[i_arr_time] = quantrac_selected[i_arr_time].time;
    }
    arr_time = [...new Set(arr_time)];

    var arr_time_distinct = [];
    for (var j_arr_time_distinct = 0; j_arr_time_distinct < arr_time.length; j_arr_time_distinct++) {
        var detail_daytime = arr_time[j_arr_time_distinct].split(", ");
        var detail_day = detail_daytime[1];
        var detail_time = detail_daytime[0];

        /*** Chuyển detail time sang time mặc định trong JS ***/
        var string_day = detail_day.split("/");

        /*** Gộp thành chuỗi rồi chuyển sang dạng thời gian mặc định ***/
        var data_day_time = new Date(string_day[2] + "/" + string_day[1] + "/" + string_day[0] +
            " " + detail_time);

        arr_time_distinct.push({
            'time': arr_time[j_arr_time_distinct],
            'time_js': data_day_time
        })
    }
    return arr_time_distinct;
}

/*---- Format hiển thị chart trạm quan trắc ----*/
function result_chart_stats_stations(quantrac_selected, param_selected) {
    /*** Xử lý mảng chứa các thời điểm duy nhất ***/
    var arr_time_distinct = [];
    arr_time_distinct = create_distinct_timeArray(quantrac_selected)

    /*** Tìm kiếm các phần tử chọn không có trong mảng ***/
    var id_quantrac_selected = [];
    for (var j = 0; j < data_quantrac_selected.length; j++) {
        id_quantrac_selected.push(data_quantrac_selected[j].id);
    }

    for (var i_checkID_chart = 0; i_checkID_chart < arr_time_distinct.length; i_checkID_chart++) {
        var objkeys_arr = Object.keys(arr_time_distinct[i_checkID_chart]);

        var arr_exprop = compare_2array(id_quantrac_selected, objkeys_arr).arr1;
        for (var i_exprop = 0; i_exprop < arr_exprop.length; i_exprop++) {
            arr_time_distinct[i_checkID_chart][arr_exprop[i_exprop]] = null;
        }
    }

    /*** Tạo mảng DOM chart ***/
    for (var j_distinct = 0; j_distinct < arr_time_distinct.length; j_distinct++) {
        for (var i_domchart = 0; i_domchart < quantrac_selected.length; i_domchart++) {
            k = quantrac_selected[i_domchart]['id_station'];

            if (quantrac_selected[i_domchart].time == arr_time_distinct[j_distinct].time) {
                arr_time_distinct[j_distinct][k] = quantrac_selected[i_domchart][param_selected];
            }
        }
    }

    return (arr_time_distinct);
}

/*---- Render Datatable Stat ----*/
function onChange_stat_viewtable() {

}

function result_datatable_stats_stations(quantrac_selected, param_selected) {
    /*** Xử lý mảng chứa các thời điểm duy nhất ***/
    var arr_time_distinct = [];
    arr_time_distinct = create_distinct_timeArray(quantrac_selected);

    /*** Tạo mảng DOM Datatables ***/
    for (var j_distinct_dom = 0; j_distinct_dom < arr_time_distinct.length; j_distinct_dom++) {
        for (var i_dom = 0; i_dom < quantrac_selected.length; i_dom++) {
            /*** Dữ liệu theo Trạm ***/
            k_type1 = 'k1_' + quantrac_selected[i_dom]['id_station'] + '_' + param_selected;
            /*** Dữ liệu theo Thông số  ***/
            k_type2 = 'k2_' + param_selected + '_' + quantrac_selected[i_dom]['id_station'];

            arr_time_distinct[j_distinct_dom][k_type1] = '';
            arr_time_distinct[j_distinct_dom][k_type2] = '';
        }
    }

    /*** Đẩy dữ liệu vào mảng DOM Datatables ***/
    for (var j_distinct = 0; j_distinct < arr_time_distinct.length; j_distinct++) {
        for (var i_dom_datatable = 0; i_dom_datatable < quantrac_selected.length; i_dom_datatable++) {
            k_type1 = 'k1_' + quantrac_selected[i_dom_datatable]['id_station'] + '_' + param_selected;
            k_type2 = 'k2_' + param_selected + '_' + quantrac_selected[i_dom_datatable]['id_station'];

            if (quantrac_selected[i_dom_datatable].time === arr_time_distinct[j_distinct].time) {
                arr_time_distinct[j_distinct][k_type1] = quantrac_selected[i_dom_datatable][param_selected];
                arr_time_distinct[j_distinct][k_type2] = quantrac_selected[i_dom_datatable][param_selected];
            }
        }
    }

    return arr_time_distinct;
}

function process_stat_datatable(data_quantrac_selected, checkboxed_para_arr) {
    var quantrac_selected = result_list_stations(data_quantrac_selected);
    var restruct_datatable = [];
    var result_dom_datatable = [];
    var arr = {};
    for (var i = 0; i < checkboxed_para_arr.length; i++) {
        var data_stat_datatable = result_datatable_stats_stations(quantrac_selected, checkboxed_para_arr[i]);
        for (var j = 0; j < data_stat_datatable.length; j++) {
            restruct_datatable.push(data_stat_datatable[j]);
        }
    }
    sortResults(restruct_datatable, 'time_js', true);

    arr = restruct_datatable[0];
    /*** Trường hợp chọn 1 thông số với N trạm ***/
    if (checkboxed_para_arr.length == 1) {
        for (var k_1param = 0; k_1param < restruct_datatable.length; k_1param++) {
            result_dom_datatable.push(restruct_datatable[k_1param]);
        }
    } else {
        var length_object_station = 2 * data_quantrac_selected.length * checkboxed_para_arr.length + 2;
        for (var k = 0; k < restruct_datatable.length; k++) {
            if (k + 1 < restruct_datatable.length) {
                if (restruct_datatable[k].time == restruct_datatable[k + 1].time) {
                    arr = {...arr, ...restruct_datatable[k + 1]};
                    if (Object.keys(arr).length == length_object_station) {
                        result_dom_datatable.push(arr);
                    }
                } else {
                    arr = restruct_datatable[k + 1];
                }
            }
        }
    }

    return result_dom_datatable;
}

function DOM_column_stat() {
    var quantrac_selected = result_list_stations(data_quantrac_selected);
    var arr_col = []
    for (var j_parma = 0; j_parma < checkboxed_para_arr.length; j_parma++) {
        for (var i_dom_datatable = 0; i_dom_datatable < quantrac_selected.length; i_dom_datatable++) {
            k_type1 = 'k1_' + quantrac_selected[i_dom_datatable]['id_station'] + '_' +
                checkboxed_para_arr[j_parma];
            arr_col.push({
                "data": k_type1,
                /*** mData là kiểu dữ liệu được render của Datatable ***/
                "mData": k_type1
            })
        }
    }

    arr_col = arr_col.filter(function (k_data) {
        var key = k_data.data + '|' + k_data.mData;
        if (!this[key]) {
            this[key] = true;
            return true;
        }
    }, Object.create(null));

    sortResults(arr_col, 'data', 'true');
    /*** Thêm cột dữ liệu thời gian ở trước data trả về ***/
    arr_col.unshift({"data": "time_js"})
    return arr_col
}

function render_stat_thead_datatable() {
    /*** Xử lý thead ***/
    var thead = '';
    var theadarr = [];
    thead += '<tr role="row">' +
        '<th scope="col" rowspan="2" class="bg-info fixed_header">Thời gian</th>';
    var length_param_checked = checkboxed_para_arr.length;
    for (var i_station = 0; i_station < data_quantrac_selected.length; i_station++) {
        /*** Phân biệt giữa các trạm thông qua màu sắc ***/
        if (i_station % 2 == 0) {
            thead += '<th scope="col" colspan="' + length_param_checked +
                '" class="bg-info fixed_header">' +
                data_quantrac_selected[i_station].name + '</th>'
        } else {
            thead += '<th scope="col" colspan="' + length_param_checked +
                '" class="bg-table fixed_header">' +
                data_quantrac_selected[i_station].name + '</th>'
        }
    }
    thead += '</tr><tr role="row">';
    /*** Sort mảng Thông số checked để DOM dữ liệu ***/
    checkboxed_para_arr.sort();
    for (var i_param = 0; i_param < data_quantrac_selected.length; i_param++) {
        for (var j_param = 0; j_param < checkboxed_para_arr.length; j_param++) {
            for (var k_para_stat = 0; k_para_stat < total_std_param.length; k_para_stat++) {
                if (checkboxed_para_arr[j_param] == total_std_param[k_para_stat].id) {
                    parameterName = total_std_param[k_para_stat].parameterName;
                    unitName = total_std_param[k_para_stat].unitName;

                    /*** DOM các thẻ <th> con
                     if (unitName != null) {
                        thead += '<th id="k1_' + data_quantrac_selected[i_param].id + "_" +
                            checkboxed_para_arr[j_param] + '" scope="col" ' +
                            'class="bg-info fixed_header">' +
                            parameterName + ' (' + unitName + ')</th>'
                    } else {  ***/
                    if (i_param % 2 == 0) {
                        thead += '<th id="k1_' + data_quantrac_selected[i_param].id + "_" +
                            checkboxed_para_arr[j_param] + '" scope="col" ' +
                            'class="bg-info fixed_header">' +
                            parameterName + '</th>'
                    } else {
                        thead += '<th id="k1_' + data_quantrac_selected[i_param].id + "_" +
                            checkboxed_para_arr[j_param] + '" scope="col" ' +
                            'class="bg-table fixed_header">' +
                            parameterName + '</th>'
                    }
                    /* } */

                    theadarr.push('k1_' + data_quantrac_selected[i_param].id + "_" +
                        checkboxed_para_arr[j_param])
                }
            }
        }
    }
    thead += '</tr>';
    $('#table_result_stat thead').html(thead);
    return theadarr;
}

function render_stat_datatable(datatable_DOM, thead_table) {
    /*** DOM datatable ***/
    var tbody = '';
    for (var i_data = 0; i_data < datatable_DOM.length; i_data++) {
        tbody += '<tr>' + '<td>' + datatable_DOM[i_data].time + '</td>';
        var key_id = Object.keys(datatable_DOM[i_data]);
        var key_val = Object.values(datatable_DOM[i_data]);

        for (var j_thead = 0; j_thead < thead_table.length; j_thead++) {
            for (var k_id = 0; k_id < key_id.length; k_id++) {
                if (key_id[k_id] == thead_table[j_thead]) {
                    if (key_val[k_id] != null) {
                        tbody += '<td>' + key_val[k_id] + '</td>';
                    } else {
                        tbody += '<td></td>';
                    }

                }
            }
        }
        tbody += '</tr>';
    }
    $('#table_result_stat tbody').html(tbody);

    /* Datatable
    if ($.fn.DataTable.isDataTable('#table_result_stat')) {
        $('#table_result_stat').DataTable().destroy();
        $('#table_result_stat').empty();
    }
    if (!$.fn.DataTable.isDataTable('#table_result_stat')) {
        var table_result_stat = $('#table_result_stat').DataTable({
            dom: "<'row'<'col-sm-7'B><'col-sm-5'f>>" +
                "<'row'<'col-sm-12 table-scroll'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {extend: 'pdf', className: 'btn btn-info btn-sm'},
                {extend: 'excel', className: 'btn btn-info btn-sm'}
            ],
            paging: true,
            "pageLength": 10,
            autoWidth: false,
            "language": {
                pagingType: "full_numbers",
                search: '<span>Tìm kiếm:</span> _INPUT_',
                searchPlaceholder: 'Gõ để tìm...',
                paginate: {
                    'first': 'First',
                    'last': 'Last',
                    'next': $('html').attr('dir') == 'rtl' ? '<span style="font-size:13px;">Trước</span>' : '<span style="font-size:13px;">Sau</span>',
                    'previous': $('html').attr('dir') == 'rtl' ? '<span style="font-size:13px;">Sau</span>' : '<span style="font-size:13px;">Trước</span>'
                },
                sLengthMenu: "<span>Hiển thị&nbsp;</span> _MENU_<span> kết quả</span>",
                sZeroRecords: "Không tìm thấy kết quả",
                sInfo: "Hiển thị _START_ đến _END_ trên _TOTAL_ dòng",
                sInfoFiltered: "(tất cả _MAX_ dòng)",
                sInfoEmpty: "Hiển thị 0 đến _END_ trên _TOTAL_ dòng",
            },
        });
    } */
}

/*---- Render Onchange Stat TypeChart ----*/
function render_stat_chart(typechart, data_quantrac_selected,
                           checkboxed_para_arr, checkboxed_paraName_arr) {
    var quantrac_selected = result_list_stations(data_quantrac_selected);
    var length_data = quantrac_selected.length;
    if (length_data != 0) {
        var unit_chart;
        var data_stat_chart

        for (var i = 0; i < checkboxed_para_arr.length; i++) {
            data_stat_chart = result_chart_stats_stations(quantrac_selected, checkboxed_para_arr[i]);
            var minRange, maxRange;
            /*** Tìm minRange, maxRange ***/
            for (var k_para_sample = 0; k_para_sample < total_std_param.length; k_para_sample++) {
                if (parseInt(checkboxed_para_arr[i]) == total_std_param[k_para_sample].id) {
                    minRange = total_std_param[k_para_sample].min_value;
                    maxRange = total_std_param[k_para_sample].max_value;
                }
            }
            /*** Render Chart ***/
            if (typechart == "filter_stat_column_chart") {
                unit_chart = checkboxed_paraName_arr[i].split('_');
                render_groupColumnchart_quantrac('chart_para_' + checkboxed_para_arr[i],
                    data_stat_chart, unit_chart[0], unit_chart[1], "time_js", minRange, maxRange);
            } else {
                unit_chart = checkboxed_paraName_arr[i].split('_');
                render_groupLinechart_quantrac('chart_para_' + checkboxed_para_arr[i],
                    data_stat_chart, unit_chart[0], unit_chart[1], "time_js", minRange, maxRange);
            }
        }
    } else {
        return length_data;
    }
}

