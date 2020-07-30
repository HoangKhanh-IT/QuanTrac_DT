/*----- DOM Option Thống kê Loại hình -----*/
function dom_obstype_stat_option() {
    $.getJSON("obstylesStat", function(data_category) {
        $('#loaihinh_stat')
            .append($("<option></option>")
                .attr('value', 'none').text("Lựa chọn loại hình"));
        $.each(data_category, function(key, value) {
            $('#loaihinh_stat')
                .append($("<option></option>")
                    .attr('value', value.id).text(value.name));
        });
    })
}
dom_obstype_stat_option();

/*----- DOM Option Thống kê Loại trạm -----*/
function dom_categories_stat_option() {
    $.getJSON("categories", function(data_category) {
        /* $('#loaitram_stat')
            .append($("<option></option>")
                .attr('value', 'none').text("Lựa chọn loại trạm")); */
        $.each(data_category, function(key, value) {
            $('#loaitram_stat')
                .append($("<option></option>")
                    .attr('value', value.id).text(value.name));
        });
    })
}
dom_categories_stat_option();

/*----- DOM Option Thống kê Quận/Huyện -----*/
function dom_districts_stat_option() {
    $.getJSON("districts", function(data_district) {
        $('#district_stat')
            .append($("<option></option>")
                .attr('value', 'none').text("Lựa chọn quận huyện"));
        $.each(data_district, function(key, value) {
            $('#district_stat')
                .append($("<option></option>")
                    .attr('value', value.id).text(value.name));
        });
    })
}
dom_districts_stat_option();

/*----- DOM Option Thống kê Quy chuẩn -----*/
function dom_standard_stat_option(obstype) {
    $.getJSON("standardStat", function(data_standard) {
        /* $('#district_stat')
            .append($("<option></option>")
                .attr('value', 'none').text("Lựa chọn quy chuẩn")); */
        $.each(data_standard, function(key, value) {
            if (obstype == value.obstypeid) {
                $('#standardtype')
                    .append($("<option></option>")
                        .attr('value', value.id).text(value.symbol));
            }
        });
    })
}