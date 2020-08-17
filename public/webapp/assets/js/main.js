var map, featureList;

$(window).resize(function () {
    sizeLayerControl();
});

$(document).on("click", ".feature-row", function (e) {
    $(document).off("mouseout", ".feature-row", clearHighlight);
    sidebarClick(parseInt($(this).attr("id"), 10));
});

if (!("ontouchstart" in window)) {
    $(document).on("mouseover", ".feature-row", function (e) {
        highlight.clearLayers().addLayer(L.circleMarker([$(this).attr("lat"),
            $(this).attr("lng")
        ], highlightStyle));
    });
}

$(document).on("mouseout", ".feature-row", clearHighlight);

/*---- Reset Input ----*/
$(".reset_input").click(function () {
    $("input[type=date]").val("")
})

/*---- Modal About Us ----*/
$("#about-btn").click(function () {
    $("#aboutModal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

/*---- Modal Login ----*/
$("#login-btn").click(function () {
    $("#loginModal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

/*---- Modal Upload Files ----*/
$("#upload-btn").click(function () {
    $("#uploadFileModal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

/*---- Modal Threshold ----*/
$("#threshold-btn").click(function () {
    $("#thresholdModal").modal("show");
    getData_threshold_station();

    /*** Reset Button ***/
    $('#fillter_1h').addClass('active');
    $('#fillter_8h').removeClass('active');
    $('#fillter_24h').removeClass('active');

    $(".navbar-collapse.in").collapse("hide");
    return false;
});

/*---- Modal Sample ----*/
$("#sample-btn").click(function () {
    $("#sampleModal").modal("show");
    getData_sample_Bantudong();
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

/*---- Modal AQI/WQI ----*/
$("#WQI_AQI_btn").click(function () {
    $("#WQI_AQI_Modal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

/*---- Modal Result AQI/WQI ----*/
$("#WQI-AQI-result-btn").click(function () {
    $("#re_WA_Modal").modal("show");
    $("#WQI_AQI_Modal").modal("hide");

    $(".navbar-collapse.in").collapse("hide");
    return false;
})

/*---- Return Modal AQI/WQI ----*/
$("#WQI-AQI-return").click(function () {
    $("#re_WA_Modal").modal("hide");
    $("#WQI_AQI_Modal").modal("show");

    $(".navbar-collapse.in").collapse("hide");
    return false;
})

/*---- Modal Statistic ----*/
/*** Linked Date Picker ***/
function formatDatetime() {
    $('#FromDate_stat').datetimepicker({
        locale: 'vi',
        format: 'L',
        /*** Vị trí mở tìm ngày luôn nằm ở Top ***/
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'auto'
        },
        useCurrent: false
    });
    $('#ToDate_stat').datetimepicker({
        locale: 'vi',
        format: 'L',
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'auto'
        },
        useCurrent: false /* Important! See issue #1075 */
    });
    $("#FromDate_stat").on("dp.change", function (e) {
        $('#ToDate_stat').data("DateTimePicker").minDate(e.date);
    });
    $("#ToDate_stat").on("dp.change", function (e) {
        $('#FromDate_stat').data("DateTimePicker").maxDate(e.date);
    });
};
formatDatetime();

/*** Collapse On/Off để mở Input "Thời gian hiển thị" (chỉ mở khi Option là "Tất cả giá trị") ***/
var item_stat_display_time;
item_stat_display_time = $("#statisticby").val();
$('#statisticby').change(function () {
    item_stat_display_time = $("#statisticby").val();
    if (item_stat_display_time != "all_stat") {
        $('.option_stat_display').addClass('in')
    } else {
        $('.option_stat_display').removeClass('in')
    }
})

/*** Collapse On/Off để mở Input "Mục đích"
 $('#WQI_check').change(function () {
    if ($('#WQI_check').is(':checked') == true) {
        $('#AQI_check').attr("disabled", true);
        $('.AQI_WQI_toggle').addClass('in')
    } else {
        $('#AQI_check').removeAttr("disabled");
        $('.AQI_WQI_toggle').removeClass('in')
    }
})

 $('#AQI_check').change(function () {
    if ($('#AQI_check').is(':checked') == true) {
        $('#WQI_check').attr("disabled", true);
        $('.AQI_WQI_toggle').addClass('in')
    } else {
        $('#WQI_check').removeAttr("disabled");
        $('.AQI_WQI_toggle').removeClass('in')
    }
}) ***/

$("#statistic-btn").click(function () {
    /*** Reset các button ***/
    $('#loaihinh_stat').val('none');
    $('#loaitram_stat').val('1');
    $('#district_stat').val('none');
    $('#standardtype').val('');
    $('#search_para').val('');
    $('#search_quantrac').val('');
    $('#FromDate_stat input, #ToDate_stat input').val('');

    $("#statisticModal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

/*---- Quay trở lại Modal Statistic ----*/
$("#return_modal_statistic").click(function () {
    $("#statisticModal").modal("show");
    $("#statistic_resultModal").modal("hide");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

/*---- Modal Statistic Result ----*/
/*** Tạo biến trả kết quả Array thống kê ***/
var data_quantrac_selected = [];
var checkboxed_para_arr = [];
var checkboxed_paraName_arr = [];

$("#statistic-result-btn").click(function () {
    $("#statisticModal").modal("hide");
    /*** Xử lý JSON theo thông số ***/
    data_quantrac_selected = process_detail_parameter(data_quantrac_selected,
        checkboxed_para_arr)

    /*** DOM result Chart Stat ***/
    /*** Dùng trigger() để load lại dữ liệu - tránh trường hợp thay đổi
     thứ tự thông số được chọn ***/
    $('#para_multiple').trigger("click");
    render_stat_chart($("#filter_stat_typechart").val(), data_quantrac_selected,
        checkboxed_para_arr, checkboxed_paraName_arr);

    /*** Onchange Type Chart ***/
    var item_stat_type = $("#filter_stat_typechart").val();
    $("#filter_stat_typechart").change(function () {
        $('#para_multiple').trigger("click");
        /*** Cần gán lại biến item_stat_type ***/
        item_stat_type = $("#filter_stat_typechart").val();
        render_stat_chart(item_stat_type, data_quantrac_selected,
            checkboxed_para_arr, checkboxed_paraName_arr);
    })

    /*** DOM result Datatable Stat ***/
    var datatable_DOM = process_stat_datatable(data_quantrac_selected, checkboxed_para_arr)
    var thead_table = render_stat_thead_datatable()
    render_stat_datatable(datatable_DOM, thead_table)

    $("#statistic_resultModal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

/*---- Modal Search Stats Trạm ----*/
/*** Onchange Option Stat Loại hình ==> Onchange Option Stat Quy chuẩn ***/
$("#loaihinh_stat").change(function () {
    var item_loaihinh_stat = $("#loaihinh_stat").val();
    $("#standardtype").find('option').remove();
    dom_standard_stat_option($("#loaihinh_stat").val())
})

/*** Onchange Option Stat Quy chuẩn ==> Reset input trạm quan trắc và thông số ***/
$("#standardtype").change(function () {
    $('#search_para').val('');
    $('#search_quantrac').val('');
})

$("#search_stats_tramqt").click(function () {
    /*** Remove các thẻ <li> có chứa các input checkbox ***/
    $("#para_list").find('li').remove();
    /*** Reset các Input ***/
    $('#search_para').val('');
    $('#search_quantrac').val('');

    var url_list_stations = '';
    var item_loaihinh_stat = $("#loaihinh_stat").val();
    var item_loaitram_stat = $("#loaitram_stat").val();
    var item_quanhuyen_stat = $("#district_stat").val();
    var item_quychuan_stat = $("#standardtype").val();

    if (item_loaihinh_stat == 'none') {
        alert("Vui lòng chọn loại hình");
    } else {
        if (item_quanhuyen_stat == 'none') {
            url_list_stations = 'statStation?' + '%20loaihinh_stat=' + item_loaihinh_stat +
                '&%20loaitram_stat=' + item_loaitram_stat + '&%20quanhuyen_stat=1=1' +
                '&%20quychuan_stat=' + item_quychuan_stat;
        } else {
            url_list_stations = 'statStation?' + '%20loaihinh_stat=' + item_loaihinh_stat +
                '&%20loaitram_stat=' + item_loaitram_stat + '&%20quanhuyen_stat=' + item_quanhuyen_stat +
                '&%20quychuan_stat=' + item_quychuan_stat;
        }

        $(document).ready(function () {
            if ($.fn.DataTable.isDataTable('#table_stat_stations')) {
                $('#table_stat_stations').DataTable().ajax.url(url_list_stations).load();
            }
            if (!$.fn.DataTable.isDataTable('#table_stat_stations')) {
                /*** Hàm xử lý DOM các trạm quan trắc ***/
                var table_stat_stations = $('#table_stat_stations').DataTable({
                    ajax: url_list_stations,
                    columns: [
                        {"data": "code"},
                        {"data": "name"}
                    ],
                    order: [
                        [1, 'asc']
                    ],
                    dom: "<'row'<'col-sm-12'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    paging: false,
                    autoWidth: false,
                    "ordering": false,
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
                        sZeroRecords: " ",
                        sInfo: "Hiển thị _START_ đến _END_ trên _TOTAL_ dòng",
                        sInfoFiltered: "(tất cả _MAX_ dòng)",
                        sInfoEmpty: "Hiển thị 0 đến _END_ trên _TOTAL_ dòng",
                    },
                });

                table_stat_stations.buttons().container()
                    .appendTo('#table_stat_stations_wrapper .col-md-12:eq(0)');

                $('#table_stat_stations tbody').on('click', 'tr', function () {
                    $(this).toggleClass('selected');
                    /*** Chặn chọn lớn hơn 5 trạm ***/
                    if (table_stat_stations.rows('.selected').data().length > 5) {
                        alert("Vui lòng chỉ chọn tối đa 5 trạm");
                        $(this).removeClass('selected');
                    }
                });

                /*** Xử lý trong modal (phần Tìm trạm)***/
                $('#station_multiple').click(function () {
                    /*** Kiểm tra có hàng dữ liệu nào được chọn không ***/
                    if (table_stat_stations.rows('.selected').data().length == 0) {
                        data_quantrac_selected = [];
                        $('#search_quantrac').val('');
                    } else {
                        data_quantrac_selected = [];
                        var station_selected = '';
                        var data_selected = Object.keys(table_stat_stations.rows('.selected').data())
                        if (table_stat_stations.rows('.selected').data().length == 0) {
                            $('#search_quantrac').val("");
                        } else {
                            for (var i_data_selected = 0; i_data_selected < data_selected.length; i_data_selected++) {
                                if (isNaN(Number(data_selected[i_data_selected])) == false) {
                                    data_quantrac_selected.push(table_stat_stations.rows('.selected').data()[i_data_selected])
                                    station_selected +=
                                        table_stat_stations.rows('.selected').data()[i_data_selected].name + " ";
                                    $('#search_quantrac').val(station_selected);
                                }
                            }
                        }
                    }

                    /*** Hàm xử lý DOM các input Thông số ***/
                    var dom_input_checkbox_para = '<ul id="para_list" style="list-style-type: none; ' +
                        'padding:0">' +
                        '<li>' +
                        '<div class="pretty p-svg p-curve">' +
                        '<input id="checked_all" type=checkbox>' +
                        '<div class="state p-success">' +
                        '<svg class="svg svg-icon" viewBox="0 0 20 20">' +
                        '<path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,' +
                        '7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>' +
                        '</svg>' +
                        '<label>Tất cả</label>' +
                        '</div>' +
                        '</div>' +
                        '</li><br>';

                    if (data_quantrac_selected.length != 0) {
                        var spid_para_unit = []
                        /*** Lấy danh sách checkbox cho Modal chọn thông số ***/
                        for (var i_quantrac_select = 0; i_quantrac_select < data_quantrac_selected.length; i_quantrac_select++) {
                            var total_detail = data_quantrac_selected[i_quantrac_select].total_detail;

                            for (var j = total_detail.length - 1; j >= 0; j--) {
                                var data = total_detail[j].data;
                                for (var k = data.length - 1; k >= 0; k--) {
                                    var spidID = Object.keys(data[k]);
                                    var value = Object.values(data[k]);

                                    for (var k_para_sample = 0; k_para_sample < total_std_param.length; k_para_sample++) {
                                        if (parseInt(spidID) == total_std_param[k_para_sample].id) {
                                            parameterName = total_std_param[k_para_sample].parameterName;
                                            unitName = total_std_param[k_para_sample].unitName;
                                            purposeName = total_std_param[k_para_sample].purposeName;
                                            if (unitName == null) {
                                                unitName = '';
                                            }

                                            if (purposeName == null) {
                                                purposeName = '';
                                            }

                                            spid_para_unit.push({
                                                "spidID": parseInt(spidID),
                                                "parameterName": parameterName,
                                                "unitName": unitName,
                                                "purposeName": purposeName
                                            });
                                        }
                                    }
                                }
                            }
                        }
                        /*** Tìm hợp lớn nhất của các thông số ***/
                        var spid_para_unit_unique = [];
                        spid_para_unit.forEach(function (item) {
                            var i = spid_para_unit_unique.findIndex(x => x.spidID == item.spidID);
                            if (i <= -1) {
                                spid_para_unit_unique.push({
                                    "spidID": item.spidID,
                                    "parameterName": item.parameterName,
                                    "unitName": item.unitName,
                                    "purposeName": item.purposeName
                                });
                            }
                        });
                        sortResults(spid_para_unit_unique, "spidID", true)

                        for (var i_param_unique = 0; i_param_unique < spid_para_unit_unique.length; i_param_unique++) {
                            /*** DOM List checkbox Thông số ***/
                            if (spid_para_unit_unique[i_param_unique].unitName != '') {
                                if (spid_para_unit_unique[i_param_unique].purposeName != '') {
                                    dom_input_checkbox_para += '<li>' +
                                        '<div class="pretty p-svg p-curve">' +
                                        '<input id="' + spid_para_unit_unique[i_param_unique].spidID + '" name="' +
                                        spid_para_unit_unique[i_param_unique].parameterName + "_" +
                                        spid_para_unit_unique[i_param_unique].unitName + '" type=checkbox>' +
                                        '<div class="state p-success">' +
                                        '<svg class="svg svg-icon" viewBox="0 0 20 20">' +
                                        '<path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,' +
                                        '7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>' +
                                        '</svg>' +
                                        '<label>' + spid_para_unit_unique[i_param_unique].parameterName +
                                        ' (' + spid_para_unit_unique[i_param_unique].unitName + ') - ' +
                                        '<b style="word-break: break-word;">' + spid_para_unit_unique[i_param_unique].purposeName + '</b>' +
                                        '</label>' +
                                        '</div>' +
                                        '</div>' +
                                        '</li>' + '<br>';
                                } else {
                                    dom_input_checkbox_para += '<li>' +
                                        '<div class="pretty p-svg p-curve">' +
                                        '<input id="' + spid_para_unit_unique[i_param_unique].spidID + '" name="' +
                                        spid_para_unit_unique[i_param_unique].parameterName + "_" +
                                        spid_para_unit_unique[i_param_unique].unitName + '" type=checkbox>' +
                                        '<div class="state p-success">' +
                                        '<svg class="svg svg-icon" viewBox="0 0 20 20">' +
                                        '<path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,' +
                                        '7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>' +
                                        '</svg>' +
                                        '<label>' + spid_para_unit_unique[i_param_unique].parameterName +
                                        ' (' + spid_para_unit_unique[i_param_unique].unitName + ')' +
                                        '</label>' +
                                        '</div>' +
                                        '</div>' +
                                        '</li>' + '<br>';
                                }
                            } else {
                                if (spid_para_unit_unique[i_param_unique].purposeName != '') {
                                    dom_input_checkbox_para += '<li>' +
                                        '<div class="pretty p-svg p-curve">' +
                                        '<input id="' + spid_para_unit_unique[i_param_unique].spidID + '" name="' +
                                        spid_para_unit_unique[i_param_unique].parameterName + "_" +
                                        spid_para_unit_unique[i_param_unique].unitName + '" type=checkbox>' +
                                        '<div class="state p-success">' +
                                        '<svg class="svg svg-icon" viewBox="0 0 20 20">' +
                                        '<path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,' +
                                        '7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>' +
                                        '</svg>' +
                                        '<label>' + spid_para_unit_unique[i_param_unique].parameterName +
                                        ' - ' + '<b style="word-break: break-word;">' + spid_para_unit_unique[i_param_unique].purposeName + '</b>' +
                                        '</label>' +
                                        '</div>' +
                                        '</div>' +
                                        '</li>' + '<br>';
                                } else {
                                    dom_input_checkbox_para += '<li>' +
                                        '<div class="pretty p-svg p-curve">' +
                                        '<input id="' + spid_para_unit_unique[i_param_unique].spidID + '" name="' +
                                        spid_para_unit_unique[i_param_unique].parameterName + "_" +
                                        spid_para_unit_unique[i_param_unique].unitName + '" type=checkbox>' +
                                        '<div class="state p-success">' +
                                        '<svg class="svg svg-icon" viewBox="0 0 20 20">' +
                                        '<path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,' +
                                        '7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>' +
                                        '</svg>' +
                                        '<label>' + spid_para_unit_unique[i_param_unique].parameterName +
                                        '</label>' +
                                        '</div>' +
                                        '</div>' +
                                        '</li>' + '<br>';
                                }
                            }
                        }
                    }
                    dom_input_checkbox_para += '</ul>';
                    $('#para_tab').html(dom_input_checkbox_para);

                    /*** Checkbox All ***/
                    $(".pretty #checked_all").click(function () {
                        $(".pretty input[type=checkbox]").prop("checked", $(this).prop("checked"));
                    });

                    $(".pretty input[type=checkbox]").click(function () {
                        if (!$(this).prop("checked")) {
                            $("#checked_all").prop("checked", false);
                        }
                    })
                });

                /*** Xử lý trong modal (phần Thông số) ***/
                $('#para_multiple').click(function () {
                    var para_selected = '';
                    var div_para = '';
                    /* var div_para = '<div class="form-group col-xs-3 col-md-3 option_stat_typechart">' +
                        '<select class="form-control" id="filter_stat_typechart">' +
                        '<option value="filter_stat_column_chart">Biểu đồ cột</option>' +
                        '<option value="filter_stat_line_chart">Biểu đồ đường</option>' +
                        '</select>' +
                        '</div>'; */

                    checkboxed_para_arr = [];
                    checkboxed_paraName_arr = [];
                    $('#para_list input:checked').each(function () {
                        if ($(this).attr('id') != 'checked_all') {
                            checkboxed_para_arr.push($(this).attr('id'))
                            checkboxed_paraName_arr.push($(this).attr('name'))
                            /*** DOM ở phần Input Para ***/
                            var para_name = $(this).attr('name').split('_');
                            if (para_name[1] != '') {
                                para_selected += para_name[0] + ' (' + para_name[1] + ')' + " ";
                            } else {
                                para_selected += para_name[0] + " ";
                            }

                            /*** Remove các thẻ div trước ***/
                            $('#chart_qt').find('div.gender-chart_stats').remove();

                            /*** Tạo các thẻ div ở Modal Result Stat ***/
                            div_para += '<div class="gender-chart_stats" id="chart_para_' +
                                $(this).attr('id') + '">' + '</div>';
                        }
                    });
                    $('#search_para').val(para_selected);
                    $('#chart_qt').append(div_para);
                })
            }
        })
    }

    if (url_list_stations != '') {
        $("#search_stats_tramqtModal").modal("show");
    }
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

/*---- Modal Search Checkbox Parameters ----*/
$("#search_para").click(function () {
    $("#search_paraqtModal").modal("show");
    $(".navbar-collapse.in").collapse("hide");
    return false;
});

$("#list-btn").click(function () {
    animateSidebar();
    return false;
});

$("#nav-btn").click(function () {
    $(".navbar-collapse").collapse("toggle");
    return false;
});

$("#sidebar-toggle-btn").click(function () {
    animateSidebar();
    return false;
});

$("#sidebar-hide-btn").click(function () {
    animateSidebar();
    return false;
});

function animateSidebar() {
    $("#sidebar").animate({
        width: "toggle"
    }, 350, function () {
        map.invalidateSize();
    });
}

function sizeLayerControl() {
    $(".leaflet-control-layers").css("max-height", $("#mymap").height() - 50);
}

function clearHighlight() {
    highlight.clearLayers();
}

/*---- Highlight search box text on click ----*/
$("#searchbox").click(function () {
    $(this).select();
});

/*---- Prevent hitting enter from refreshing the page ----*/
$("#searchbox").keypress(function (e) {
    if (e.which == 13) {
        e.preventDefault();
    }
});

/*---- Draggable Modal ----*/
$(".modal-header").on("mousedown", function (mousedownEvt) {
    var $draggable = $(this);
    var x = mousedownEvt.pageX - $draggable.offset().left,
        y = mousedownEvt.pageY - $draggable.offset().top;
    $("body").on("mousemove.draggable", function (mousemoveEvt) {
        $draggable.closest(".modal-dialog").offset({
            "left": mousemoveEvt.pageX - x,
            "top": mousemoveEvt.pageY - y
        });
    });
    $("body").one("mouseup", function () {
        $("body").off("mousemove.draggable");
    });
    $draggable.closest(".modal").one("bs.modal.hide", function () {
        $("body").off("mousemove.draggable");
    });
});

/*---- Call Standard Parameter using Ajax ----*/
var total_std_param;
$.ajax({
    url: "standardParam",
    async: false,
    dataType: 'json',
    success: function (data) {
        total_std_param = data;
    }
});

/*---- Datables Children DOM ----*/
/*** `d` is the original data object for the row ***/
function format(d, ID_modal) {
    var DOM_child_table = '';
    var parameterName, parameterID, unitName;
    var spidID, value;

    if (ID_modal == "sampleModal") {
        DOM_child_table = '<div class="table-wrapper">' +
            '<table class="table table-bordered table-striped table-hover">';
        DOM_child_table += '<thead>' +
            '<tr>' +
            '<th class="first-col" scope="col" ' +
            'style="border-top: 1px solid #ddd !important; ' +
            'margin-top: -1px; text-align: center;"> Thông số </th>'

        /*** Sử dụng Object keys để lấy tên từng tham số ***/
        for (var i_sample = 0; i_sample < d.detail.data.length; i_sample++) {
            spidID = Object.keys(d.detail.data[i_sample]);
            for (var k_para_sample = 0; k_para_sample < total_std_param.length; k_para_sample++) {
                if (parseInt(spidID) == total_std_param[k_para_sample].id) {
                    parameterName = total_std_param[k_para_sample].parameterName;
                }
            }
            DOM_child_table += '<th scope="col" class="parameter_tab">' + parameterName + '</th>';
        }

        DOM_child_table += '</thead><tbody>' + '<tr>' +
            '<th class="first-col" ' +
            'style="border-bottom: 1px solid #ddd !important;">' + 'Giá trị/Thời gian' + '</th>';

        /*** Sử dụng Object value để lấy value của từng tham số ***/
        for (var j_sample = 0; j_sample < d.detail.data.length; j_sample++) {
            spidID = Object.keys(d.detail.data[j_sample]);
            value = Object.values(d.detail.data[j_sample]);
            for (var k_value_sample = 0; k_value_sample < total_std_param.length; k_value_sample++) {
                if (parseInt(spidID) == total_std_param[k_value_sample].id) {
                    unitName = total_std_param[k_value_sample].unitName;
                }
            }
            /*** DOM dữ liệu, nếu null thì trả về không có kết quả***/
            if (value[0].v != null) {
                if (unitName != null) {
                    DOM_child_table += '<td style="text-align: center"><b class="green">' +
                        value[0].v + ' ' + unitName + '</b></td>';
                } else {
                    DOM_child_table += '<td style="text-align: center"><b class="green">' +
                        value[0].v + '</b></td>';
                }
            } else {
                DOM_child_table += '<td style="text-align: center"><b class="red">Không có</b></td>';
            }
        }
    }
    DOM_child_table += '</tr></tbody></table></div>';

    if (ID_modal == "thresholdModal") {
        var total_detail = d.total_detail;

        if (total_detail.length != 0) {
            DOM_child_table = '<div class="table-wrapper-threshold">' +
                '<table class="table table-bordered table-striped table-hover">';
            DOM_child_table += '<thead>' +
                '<tr>' +
                '<th class="first-col-threshold" scope="col" ' +
                'style="border-top: none !important"></th>' +
                '<th class="first-col-threshold" scope="col" ' +
                'style="border-top: 1px solid #ddd !important; ' +
                'margin-top: -1px; text-align: center;">Thời gian/Thông số</th>'

            /*** DOM tên thông số chung kèm Min Max***/
            var detail_data_param = total_detail[0].data;
            for (var i_threshold = 0; i_threshold < detail_data_param.length; i_threshold++) {
                spidID = Object.keys(detail_data_param[i_threshold]);
                /* var min, max, dom_min_max; */
                for (var k_para_threshold = 0; k_para_threshold < total_std_param.length; k_para_threshold++) {
                    if (parseInt(spidID) == total_std_param[k_para_threshold].id) {
                        parameterID = total_std_param[k_para_threshold].parameterid;
                        parameterName = total_std_param[k_para_threshold].parameterName;
                        min = total_std_param[k_para_threshold].min_value;
                        max = total_std_param[k_para_threshold].max_value;

                        /*** DOM ngưỡng dữ liệu
                         if (min == null && max != null) {
                            dom_min_max = '&#8804; ' + max;
                        }
                         if (min != null && max == null) {
                            dom_min_max = '&#8805; ' + min;
                        }
                         if (min != null && max != null) {
                            dom_min_max = min + ' &#8804; x &#8804; ' + max;
                        }  ***/
                    }
                }
                /*** DOM min max
                 DOM_child_table += '<th scope="col" style="white-space: nowrap;" ' +
                 'class="parameter_tab" id="' + spidID + '">' +
                 parameterName + ' (' + dom_min_max + ')</th>'; ***/

                DOM_child_table += '<th scope="col" style="white-space: nowrap;" ' +
                    'class="parameter_tab" id="' + spidID + "_" + row_detail + '">' +
                    parameterName + '</th>';
            }

            /*** DOM value vượt ngưỡng ***/
            /*** Thay đổi rowspan theo time và date  ***/
            DOM_child_table += '</thead><tbody>' + '<tr>' +
                '<th class="first-col-threshold" rowspan="' + total_detail.length + '"></th>';

            /*** Tạo bảng dữ liệu trước ***/
            for (var i_dom_threshold = 0; i_dom_threshold < total_detail.length; i_dom_threshold++) {
                var detail_data_value = total_detail[i_dom_threshold].data;
                var j_threshold;
                var td_id_threshold;

                /*** DOM hàng đầu tiên không thêm thẻ tr ***/
                if (i_dom_threshold == 0) {
                    /*** Thời gian ***/
                    DOM_child_table += '<td style="text-align: center; border-bottom-width: 1px;" ' +
                        'class="first-col-threshold ' + i_dom_threshold + "_" + row_detail +
                        '_daytimes' + '">' +
                        '</td>';
                    /*** Số liệu vượt ngưỡng và đơn vị ***/
                    for (j_threshold = 0; j_threshold < detail_data_value.length; j_threshold++) {
                        /*** Thêm thuộc tính ID có chứa hàng row i và ID thông số ***/
                        td_id_threshold = Object.keys(detail_data_value[j_threshold]) +
                            "_" + i_dom_threshold;

                        DOM_child_table += '<td style="text-align: center" ' +
                            'id="' + td_id_threshold + "_" + row_detail + '">' +
                            '<b class="red"></b>' +
                            '</td>';
                    }
                }
                DOM_child_table += '</tr>';

                /*** DOM các hàng tiếp theo cần thêm thẻ tr ***/
                if (i_dom_threshold >= 1) {
                    /*** Thời gian ***/
                    DOM_child_table += '<tr><td style="text-align: center; border-bottom-width: 1px;" ' +
                        'class="first-col-threshold ' + i_dom_threshold + "_" + row_detail +
                        '_daytimes' + '">' +
                        '</td>';
                    /*** Số liệu vượt ngưỡng và đơn vị ***/
                    for (j_threshold = 0; j_threshold < detail_data_value.length; j_threshold++) {
                        /*** Thêm thuộc tính ID có chứa hàng row i và ID thông số ***/
                        td_id_threshold = Object.keys(detail_data_value[j_threshold]) +
                            "_" + i_dom_threshold;

                        DOM_child_table += '<td style="text-align: center" ' +
                            'id="' + td_id_threshold + "_" + row_detail + '">' +
                            '<b class="red"></b>' +
                            '</td>';
                    }
                    DOM_child_table += '</tr>'
                }
            }
            DOM_child_table += '</tbody></table></div>';
        } else {
            DOM_child_table = '<div class="red" style="text-align: center;">' +
                '<b>Không có dữ liệu</b></div>'
        }
    }
    return DOM_child_table;
}
