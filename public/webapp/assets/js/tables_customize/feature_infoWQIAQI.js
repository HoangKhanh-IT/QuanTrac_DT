/*** Linked Date Picker ***/
function formatDatetime_WA() {
    $('#FromDate_WA').datetimepicker({
        locale: 'vi',
        format: 'L',
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'auto'
        },
        useCurrent: false
    });
    $('#ToDate_WA').datetimepicker({
        locale: 'vi',
        format: 'L',
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'auto'
        },
        useCurrent: false /* Important! See issue #1075 */
    });
    $("#FromDate_WA").on("dp.change", function(e) {
        $('#ToDate_WA').data("DateTimePicker").minDate(e.date);
    });
    $("#ToDate_WA").on("dp.change", function(e) {
        $('#FromDate_WA').data("DateTimePicker").maxDate(e.date);
    });
};
formatDatetime_WA();

var url_list_WA = '';
$("#WQI-AQI-result-btn").click(function() {
    /*** Reset các Input ***/
    $('#search_quantrac_WA').val('');

    var WA_quantrac_selected = [];
    var item_loaihinh_WA = $("#loaihinh_WA").val();
    var item_loaitram_WA = $("#loaitram_WA").val();
    var item_quanhuyen_WA = $("#district_WA").val();
    var fromDate_WA = $("#FromDate_WA input").val();
    var toDate_WA = $("#ToDate_WA input").val();

    if (item_loaihinh_WA == 'none') {
        item_loaihinh_WA_cond = '%20loaihinh_WA=1=1';
    } else {
        item_loaihinh_WA_cond = '%20loaihinh_WA=' + item_loaihinh_WA
    }

    if (item_loaitram_WA == 'none') {
        item_loaitram_WA_cond = '%20loaitram_WA=1=1';
    } else {
        item_loaitram_WA_cond = '%20loaitram_WA=' + item_loaitram_WA
    }

    if (item_quanhuyen_WA == 'none') {
        item_quanhuyen_WA_cond = '%20district_WA=1=1';
    } else {
        item_quanhuyen_WA_cond = '%20district_WA=' + item_quanhuyen_WA
    }

    if (fromDate_WA == '') {
        fromDate_WA_cond = '%20fromDate_WA=%271900-01-01%27';
    } else {
        var fromDate_WA_split = fromDate_WA.split("/");
        fromDate_WA = "%27" + fromDate_WA_split[2] + "/" + fromDate_WA_split[1] + "/" + fromDate_WA_split[0] + "%27";
        fromDate_WA_cond = '%20fromDate_WA=' + fromDate_WA
    }

    if (toDate_WA == '') {
        toDate_WA_cond = '%20toDate_WA=%272200-01-01%27';
    } else {
        var toDate_WA_split = toDate_WA.split("/");
        toDate_WA = "%27" + toDate_WA_split[2] + "/" + toDate_WA_split[1] + "/" + toDate_WA_split[0] + "%27";
        toDate_WA_cond = '%20toDate_WA=' + toDate_WA;
    }

    url_list_WA = 'WQI_AQI?' + item_loaihinh_WA_cond + "&" +
        item_loaitram_WA_cond + "&" + item_quanhuyen_WA_cond + "&" +
        fromDate_WA_cond + "&" + toDate_WA_cond;

    /*** DOM result WQI/AQI ***/
    DOM_data_WQI_AQI(url_list_WA);
})

function DOM_data_WQI_AQI(url_list) {
    $.getJSON(url_list, function(data_DOM) {
        var tbody = '';
        if (data_DOM.length == 0) {
            tbody = '';
            tbody += '<tr>' +
                '<td colspan="4" class="red" style="text-align:center">' +
                '<b>Không có dữ liệu</b>' +
                '</td>' +
                '</tr>';
        } else {
            tbody = '';
            for (var i_data = 0; i_data < data_DOM.length; i_data++) {
                tbody += '<tr>' + '<td>' + data_DOM[i_data].name + '</td>';

                /*** Format Date ***/
                var date_WA = data_DOM[i_data].day.split("-");
                var date_DOM_WA = date_WA[2] + "/" + date_WA[1] + "/" + date_WA[0];

                tbody += '<td>' + date_DOM_WA + '</td>';
                tbody += '<td style="text-align: center">' + data_DOM[i_data].value + '</td>';
                tbody += '<td style="border:none; background-color:' + data_DOM[i_data].qualityColorcode + '"></td>';
                tbody += '<td>' + data_DOM[i_data].qualityPurpose + '</td>';
                tbody += '</tr>';
            }
        }
        $('#table_re_WA tbody').html(tbody);
    })
}
