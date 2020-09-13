/*----- DOM Option WQI/AQI Loại hình
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
dom_obstype_WQIAQI_option(); -----*/

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

/*----- Ràng buộc Option Loại hình và Chất lượng môi trường-----*/
$('#loaihinh_WA').change(function(){
    var loaihinh_val = $('#loaihinh_WA').val();
    if (loaihinh_val == 2) {
        $('#quality_WA').val("WQI");
    } else {
        $('#quality_WA').val("AQI");
    }
})

$('#quality_WA').change(function(){
    var loaihinh_val = $('#quality_WA').val();
    if (loaihinh_val == "WQI") {
        $('#loaihinh_WA').val(2);
    } else {
        $('#loaihinh_WA').val(1);
    }
})