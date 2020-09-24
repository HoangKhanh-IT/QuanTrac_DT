/*---- Hiển thị thông tin trạm quan trắc ----*/
function Feature_info_modal(feat, layer) {
    /*** Kiểm tra trạm quan trắc có năm thành lập hay không ***/
    var establishdate_qt = "";
    if (feat.properties.establishdate != null) {
        day = feat.properties.establishdate.split("-")[2]
        month = feat.properties.establishdate.split("-")[1]
        year = feat.properties.establishdate.split("-")[0]
        establishdate_qt = day + "/" + month + "/" + year
    } else {
        establishdate_qt = "Chưa cập nhật";
    }

    /*** Kiểm tra trạm quan trắc có tổ chức/doanh nghiệp hay không ***/
    var organizationName_qt = "";
    var enterpriseName_qt = "";
    if (feat.properties.organizationName != null) {
        organizationName_qt = feat.properties.organizationName
    } else {
        organizationName_qt = "Chưa cập nhật";
    }

    if (feat.properties.enterpriseName != null) {
        enterpriseName_qt = feat.properties.enterpriseName
    } else {
        enterpriseName_qt = "Chưa cập nhật";
    }

    /*** Kiểm tra trạm quan trắc đang hoạt động hay không ***/
    var active_qt = "";
    if (feat.properties.active == "Y") {
        active_qt = "&nbsp;Trạng thái</th><td>" + "<span class='badge bg-info bg-active-qt'>" +
            'Đang hoạt động' + "</span>" + "</td></tr>"
    } else {
        active_qt = "&nbsp;Trạng thái</th><td>" + "<span class='badge bg-active-qt'>" +
            'Ngừng hoạt động' + "</span>" + "</td></tr>"
    }

    /*** Thông tin trạm quan trắc ***/
    var content_info = "<table class='table table-striped table-bordered table-condensed table-responsive'>" +
        "<tr><th class='blue' style='white-space: nowrap'>" +
        "<i class='icon-home4' style='font-size: 14px;" +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Tên trạm</th><td colspan='3' style='font-weight: bold; " +
        "text-align: center'>Trạm " + feat.properties.name + "</td></tr>";

    if (feat.properties.categoryID != 2 && feat.properties.categoryID != 4) {
        content_info += "<tr><th class='brown' style='white-space: nowrap'>" +
            "<i class='fa fa-building' style='font-size: 14px; " +
            "margin-top: -2px; margin-left: 1px;'></i>" +
            "&nbsp;Doanh nghiệp</th><td colspan='3' style='text-align: center'>" +
            enterpriseName_qt + "</td></tr>"
    }

    content_info += "<th class='brown' style='white-space: nowrap'>" +
        "<i class='icon-lab' style='font-size: 16px; margin-top: -2px'></i>" +
        "&nbsp;Loại hình</th><td>" + feat.properties.obstype_namelist + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='icon-server' style='font-size: 16px; margin-top: -2px'></i>" +
        "&nbsp;Loại trạm</th><td>" + feat.properties.categoryName + "</td></tr>" +
        "<tr><th class='brown' style='white-space: nowrap'>" +
        "<i class='mdi mdi-location-enter' style='font-size: 16px; margin-top: -2px'></i>" +
        "&nbsp;Địa danh</th><td>" + feat.properties.locationName + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='mdi mdi-map-legend' style='font-size: 16px; margin-top: -2px'></i>" +
        "&nbsp;Loại địa danh</th><td>" + feat.properties.locationTypeName + "</td></tr>" +
        "<tr><th class='brown' style='white-space: nowrap'>" +
        "<i class='icon-location3' style='font-size: 16px; margin-top: -2px'></i>" +
        "&nbsp;Địa điểm</th><td>" + feat.properties.districtName + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='icon-office' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Tổ chức</th><td>" + organizationName_qt + "</td></tr>" +
        "<tr><th class='brown' style='white-space: nowrap'>" +
        "<i class='icon-watch2' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Thành lập</th><td>" + establishdate_qt + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='icon-connection' style='font-size: 12px; margin-top: -2px'></i>" +
        active_qt +
        "<table>";

    layer.on({
        click: function (e) {
            if (feat.properties.categoryName == "Tự động"
                || feat.properties.categoryName == "Doanh nghiệp") {
                $(".feature-title").html("Trạm " + feat.properties.name);
                $(".info_qt").html(content_info);

                var detail_chart_1h, detail_chart_8h, detail_chart_24h;
                detail_chart_1h = process_detail_DOMchart(feat, 1);
                detail_chart_8h = process_detail_DOMchart(feat, 8);
                detail_chart_24h = process_detail_DOMchart(feat, 24);

                /*** DOM số liệu mới nhất (cần kiểm tra) ***/
                var length = detail_chart_24h.length;
                var content_data_qt = '';
                if (length == 0) {
                    content_data_qt = '<p style="font-size: 16px;' +
                        'text-align: center; font-weight: bold; color: #ff0000">Không có dữ liệu mới nhất</p>';
                } else {
                    /*** Dữ liệu đã được Sort theo thời gian nên có thể lấy dòng cuối cùng - thời gian sớm nhất ***/
                    content_data_qt = "<table class='table table-striped table-bordered table-condensed'>";
                    content_data_qt += "<tr><th class='blue' style='text-align: center'>Thời gian</th>" +
                        "<td style='text-align: center'>" + detail_chart_24h[length - 1].time + "</td></tr>";

                    for (var i = 0; i < Object.keys(detail_chart_24h[length - 1]).length; i++) {
                        if (Object.keys(detail_chart_24h[length - 1])[i] != "time" &&
                            Object.keys(detail_chart_24h[length - 1])[i] != "time_js" &&
                            Object.keys(detail_chart_24h[length - 1])[i] != "data") {

                            var name = Object.keys(detail_chart_24h[length - 1])[i];
                            var value = Object.values(detail_chart_24h[length - 1])[i];
                            content_data_qt += "<tr><th class='blue' style='text-align: center'>" + name +
                                "</th><td style='text-align: center; font-weight: bold; " + value + "</td></tr>";
                        }
                    }
                    content_data_qt += "</table>";
                }
                $("#data_qt").html(content_data_qt);

                /*** View Chart cho trạm tự động ***/
                /*** Reset Option ***/
                $("#filter_typechart").val('filter_column_chart');
                $("#filter_time").val('filter_1h_chart');

                /*** Kiểm tra dữ liệu DOM chart có dữ liệu trong 1 giờ hay không ***/
                if (detail_chart_1h.length == 0) {
                    $("#chart_para").css("display", "none");
                    $("#info_dom_chart").css("display", "block");
                    $("#info_dom_chart").html("Không có dữ liệu trong 1 giờ gần nhất")
                } else {
                    $("#chart_para").css("display", "block");
                    $("#info_dom_chart").css("display", "none");
                    onChange_option(detail_chart_1h);
                    render_chart($("#filter_parameters").val(), detail_chart_1h, $("#filter_typechart").val());
                }

                /*** Onchange Filter Time ***/
                var item_time = $("#filter_time").val();
                $("#filter_time").change(function () {
                    item_time = $("#filter_time").val();

                    if (item_time == "filter_1h_chart") {
                        if (detail_chart_1h.length == 0) {
                            /*** Thay đổi giữa ID chart_para và ID info_dom_chart ***/
                            $("#chart_para").css("display", "none");
                            $("#info_dom_chart").css("display", "block");
                            $("#info_dom_chart").html("Không có dữ liệu trong 1 giờ gần nhất")
                        } else {
                            $("#chart_para").css("display", "block");
                            $("#info_dom_chart").css("display", "none");
                            render_chart($("#filter_parameters").val(), detail_chart_1h, $("#filter_typechart").val());
                            onChange_option(detail_chart_1h);
                        }
                    } else if (item_time == "filter_8h_chart") {
                        if (detail_chart_8h.length == 0) {
                            $("#chart_para").css("display", "none");
                            $("#info_dom_chart").css("display", "block");
                            $("#info_dom_chart").html("Không có dữ liệu trong 8 giờ gần nhất")
                        } else {
                            $("#chart_para").css("display", "block");
                            $("#info_dom_chart").css("display", "none");
                            render_chart($("#filter_parameters").val(), detail_chart_8h, $("#filter_typechart").val());
                            onChange_option(detail_chart_8h);
                        }
                    } else {
                        if (detail_chart_24h.length == 0) {
                            $("#chart_para").css("display", "none");
                            $("#info_dom_chart").css("display", "block");
                            $("#info_dom_chart").html("Không có dữ liệu trong 24 giờ gần nhất")
                        } else {
                            $("#chart_para").css("display", "block");
                            $("#info_dom_chart").css("display", "none");
                            render_chart($("#filter_parameters").val(), detail_chart_24h, $("#filter_typechart").val());
                            onChange_option(detail_chart_24h);
                        }
                    }
                })

                $("#featureModal").modal("show");
            } else {
                /*** Get Staion ID ***/
                station_id = feat.properties.id;
                $(".feature-title").html("Trạm " + feat.properties.name);
                $(".info_qt").html(content_info);

                $("#featureModal-btd").modal("show");
            }
            pulse_marker = L.marker([feat.geometry.coordinates[1],
                feat.geometry.coordinates[0]], {
                icon: pulsingIcon
            }).addTo(map);
        }
    });

    /*** Modal off function ***/
    $('.closemodal').click(function () {
        map.removeLayer(pulse_marker)
    });
}

/*---- Hiển thị thông tin bảng điện tử ----*/
function Feature_info_Electric(feat, layer) {
    var note_electricBoard = "";
    if (feat.properties.note != null) {
        note_electricBoard = feat.properties.note
    } else {
        note_electricBoard = "Chưa cập nhật";
    }

    /*** Thông tin bảng điện tử ***/
    var content_info = "<table class='table table-striped table-bordered table-condensed table-responsive'>" +
        "<tr style='background-color: #000'><th style='white-space: nowrap; color: yellow; text-align: center'>" +
        "<i class='icon-home4' style='font-size: 14px;" +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Tên bảng điện tử</th><td style='font-weight: bold; color: #66df66; " +
        "text-align: center'>Bảng điện tử " + feat.properties.name + "</td></tr>";

    content_info += "<tr style='background-color: #000'><th style='white-space: nowrap; color: yellow; text-align: center'>" +
        "<i class='icon-office' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Trạm quan trắc</th><td style='color: #66df66; text-align: center'>" + feat.properties.stationName + "</td></tr>";

    /*** DOM json detail ***/
    var detail = feat.properties.total_detail;
    for (var j = detail.length - 1; j >= 0; j--) {
        data = detail[j].data;

        var detail_daytime = detail[j].time.split(", ");
        var detail_day = detail_daytime[1];
        var detail_time = detail_daytime[0];

        /*** Chuyển detail time sang time mặc định trong JS ***/
        var string_day = detail_day.split("/");

        /*** Gộp thành chuỗi rồi chuyển sang dạng thời gian mặc định ***/
        var data_day_time = new Date(string_day[2] + "/" + string_day[1] + "/" + string_day[0] +
            " " + detail_time);

        detail[j]['time_js'] = data_day_time;
    }

    var new_detail = detail;
    sortResults(new_detail, 'time_js', true);

    content_info += "<tr style='background-color: #000'><th style='white-space: nowrap; color: yellow; text-align: center'>" +
        "<i class='icon-watch2' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Thời gian</th><td style='color: #66df66; text-align: center'>" + new_detail[new_detail.length - 1].time + "</td></tr>";

    for (var i = 0; i < new_detail[new_detail.length - 1].data.length - 1; i++) {
        var spidID = Object.keys(new_detail[new_detail.length - 1].data[i]);
        var value = Object.values(new_detail[new_detail.length - 1].data[i]);

        for (var k_para_sample = 0; k_para_sample < total_std_param.length; k_para_sample++) {
            if (parseInt(spidID) == total_std_param[k_para_sample].id) {
                if (total_std_param[k_para_sample].unitName != null) {
                    result_standard = value[0].v.toString() + " " + total_std_param[k_para_sample].unitName;
                } else {
                    result_standard = value[0].v.toString();
                }

                if (value[0].inlimit == "N") {
                    content_info += "<tr style='background-color: #000'>" +
                                    "<th style='white-space: nowrap; color: yellow; text-align: center'>" +
                                    total_std_param[k_para_sample].parameterName +
                                    "</th><td style='color: #66df66; text-align: center; font-weight: bold'>" + result_standard + "</td></tr>"
                } else {
                    content_info += "<tr style='background-color: #000'>" +
                                    "<th style='white-space: nowrap; color: yellow; text-align: center'>" +
                                    total_std_param[k_para_sample].parameterName +
                                    "</th><td style='color: red; text-align: center; font-weight: bold'>" + result_standard + "</td></tr>"
                }
            }
        }
    }

    content_info += "</table>";

    /*** Get Electric Board ID ***/
    layer.on({
        click: function (e) {
            $(".feature-title").html("Bảng điện tử " + feat.properties.name);
            $(".info_eletric").html(content_info);
            $("#featureModal-eletric").modal("show");
        }
    })

    /*** Modal off function
    $('.closemodal').click(function () {
        map.removeLayer(pulse_marker)
    }); ***/
}

/*---- Hiển thị thông tin bảng điện tử ----*/
function Feature_info_Discharge(feat, layer) {
    /*** Kiểm tra trạm quan trắc có năm thành lập hay không ***/
    var standardSymbol = "";
    if (feat.properties.standardSymbol != null) {
        standardSymbol = feat.properties.standardSymbol;
    } else {
        standardSymbol = "Chưa cập nhật";
    }

    var operatingtime = "";
    if (feat.properties.operatingtime != null) {
        operatingtime = feat.properties.operatingtime;
    } else {
        operatingtime = "Chưa cập nhật";
    }

    /*** Thông tin điểm xả thải ***/
    var content_info = "<table class='table table-striped table-bordered table-condensed table-responsive'>" +
        "<tr><th class='blue' style='white-space: nowrap'>" +
        "<i class='icon-home4' style='font-size: 14px;" +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Doanh nghiệp</th><td style='font-weight: bold; " +
        "text-align: center'>" + feat.properties.enterpriseName + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='icon-home7' style='font-size: 16px; margin-top: -2px'></i>" +
        "&nbsp;Tên cơ sở</th><td>" + feat.properties.establishmentname + "</td></tr>";

    content_info += "<tr><th class='brown' style='white-space: nowrap'>" +
        "<i class='mdi mdi-numeric' style='font-size: 16px; margin-top: -2px'></i>" +
        "&nbsp;Số quy định</th><td>" + feat.properties.decisionnumber + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='fa fa-calendar-day' style='font-size: 16px; margin-top: -2px'></i>" +
        "&nbsp;Ngày cấp phép</th><td>" + feat.properties.licensedate + "</td></tr>" +

        "<tr><th class='brown' style='white-space: nowrap'>" +
        "<i class='mdi mdi-timeline' style='font-size: 16px; margin-top: -2px'></i>" +
        "&nbsp;Thời hạn</th><td>" + feat.properties.period + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='mdi mdi-timer-3' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Hạn giấy phép</th><td>" + feat.properties.licenseterm + "</td></tr>" +

        "<tr><th class='brown' style='white-space: nowrap'>" +
        "<i class='icon-location3' style='font-size: 16px; margin-top: -2px'></i>" +
        "&nbsp;Vị trí</th><td>" + feat.properties.location + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='fa fa-times-rectangle' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Thời gian vận hành</th><td>" + operatingtime + "</td></tr>" +

        "<tr><th class='brown' style='white-space: nowrap'>" +
        "<i class='mdi mdi-snowflake-melt' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Phương thức xả thải</th><td>" + feat.properties.dischargemethod + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='glyphicon glyphicon-forward' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Lưu lượng xả thải</th><td>" + feat.properties.flowrate + "</td></tr>" +

        "<tr><th class='brown' style='white-space: nowrap'>" +
        "<i class='mdi mdi-quality-medium' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Quy chuẩn</th><td>" + standardSymbol + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='icon-reply' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Nguồn tiếp nhận</th><td>" + feat.properties.sourcereception + "</td><tr>" +

        "<tr><th class='brown' style='white-space: nowrap'>" +
        "<i class='mdi mdi-arrow-right-drop-circle-outline' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Lưu vực sông</th><td>" + feat.properties.basinName + "</td>" +
        "<th class='brown' style='white-space: nowrap'>" +
        "<i class='mdi mdi-account-group' style='font-size: 14px; " +
        "margin-top: -2px; margin-left: 1px;'></i>" +
        "&nbsp;Loại giấy phép</th><td>" + feat.properties.licensetype + "</td></tr>" +
        "</table>";

    /*** Get Discharge Point ID ***/
    layer.on({
        click: function (e) {
            $(".feature-title").html("Nguồn thải của " + feat.properties.enterpriseName);
            $(".info_discharge").html(content_info);
            $("#featureModal-discharge").modal("show");
        }
    })
}
