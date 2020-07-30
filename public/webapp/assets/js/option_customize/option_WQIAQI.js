/*----- DOM Option WQI/AQI Loại hình -----*/
function dom_obstype_WQIAQI_option() {
    $.getJSON("obstylesStat", function(data_category) {
        $('#loaihinh_WA')
            .append($("<option></option>")
                .attr('value', 'none').text("Lựa chọn loại hình"));
        $.each(data_category, function(key, value) {
            $('#loaihinh_WA')
                .append($("<option></option>")
                    .attr('value', value.id).text(value.name));
        });
    })
}
dom_obstype_WQIAQI_option();

/*----- DOM Option WQI/AQI Loại trạm -----*/
function dom_categories_WQIAQI_option() {
    $.getJSON("categories", function(data_category) {
        $('#loaitram_WA')
            .append($("<option></option>")
                .attr('value', 'none').text("Lựa chọn loại trạm"));
        $.each(data_category, function(key, value) {
            $('#loaitram_WA')
                .append($("<option></option>")
                    .attr('value', value.id).text(value.name));
        });
    })
}
dom_categories_WQIAQI_option();

/*----- DOM Option WQI/AQI Quận/Huyện -----*/
function dom_districts_WQIAQI_option() {
    $.getJSON("districts", function(data_district) {
        $('#district_WA')
            .append($("<option></option>")
                .attr('value', 'none').text("Lựa chọn quận huyện"));
        $.each(data_district, function(key, value) {
            $('#district_WA')
                .append($("<option></option>")
                    .attr('value', value.id).text(value.name));
        });
    })
}
dom_districts_WQIAQI_option();