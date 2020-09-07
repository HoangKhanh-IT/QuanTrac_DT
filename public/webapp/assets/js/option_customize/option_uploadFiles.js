/*----- DOM Option Thống kê Quy chuẩn -----*/
function dom_standard_upload_option() {
    $.getJSON("standardStat", function (data_standard) {
        /* $('#district_stat')
            .append($("<option></option>")
                .attr('value', 'none').text("Lựa chọn quy chuẩn")); */
        $.each(data_standard, function (key, value) {
            $('#standardUpload')
                .append($("<option></option>")
                    .attr('value', value.id).text(value.symbol));
        });
    })
}
dom_standard_upload_option()

/*----- DOM Option Mục đích sử dụng -----*/
function dom_purpose_upload_option() {
    $.getJSON("purposeExcel", function (data_purpose) {
        /* $('#district_stat')
            .append($("<option></option>")
                .attr('value', 'none').text("Lựa chọn quy chuẩn")); */
        $.each(data_purpose, function (key, value) {
            $('#purposeUpload')
                .append($("<option></option>")
                    .attr('value', value.id).text(value.name));
        });
    })
}
dom_purpose_upload_option()
