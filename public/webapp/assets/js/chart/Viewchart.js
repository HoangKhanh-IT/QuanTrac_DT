/*---- Chart cho từng trạm khi bấm vào từng trạm hoặc tìm kiếm trạm ----*/
function render_columnchart_quantrac(div_id, data_chart, name_title, key, data) {
    am4core.useTheme(am4themes_animated);
    am4core.ready(function () {

        /** Remove Logo **/
        $("g[opacity='0.3']").remove();
        $("g[opacity='0.4']").remove();
        var chart = am4core.create(div_id, am4charts.XYChart);
        chart.data = data_chart;

        chart.language.locale = am4lang_vi_VN;
        chart.logo.height = -500;
        chart.fontSize = 13;
        chart.dateFormatter.inputDateFormat = "HH:mm:ss, dd/MM/yyyy";

        /*** View Chart Column theo Date ***/
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.grid.template.location = 0;
        /*** Label thời gian nằm giữa column ***/
        dateAxis.renderer.labels.template.location = 0.5;
        dateAxis.renderer.minGridDistance = 50;
        /*** Thay đổi width chart do khoảng cách thời gian ***/
        dateAxis.baseInterval = {
            "timeUnit": "minute",
            "count": 5
        }
        dateAxis.tooltipDateFormat = "HH:mm:ss, dd/MM/yyyy";
        dateAxis.showOnInit = false;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "";

        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = data;
        series.dataFields.dateX = key;
        series.fill = "#007bff";
        series.fillOpacity = 0.3;
        series.yAxis = valueAxis;
        series.tooltipText = "Thời gian: {dateX}\n Giá trị: [bold font-size: 13]{valueY}[/]";

        var columnTemplate = series.columns.template;
        columnTemplate.strokeWidth = 2;
        columnTemplate.strokeOpacity = 1;

        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineY.opacity = 0;

        var title = chart.titles.create();
        title.text = name_title;
        title.fontSize = 25;
        title.fontFamily = "Arial";
        title.marginBottom = 30;

        chart.invalidateData();
    });
};

function render_linechart_quantrac(div_id, data_chart, name_title, key, data) {
    am4core.useTheme(am4themes_animated);
    am4core.ready(function () {

        /** Remove Logo **/
        $("g[opacity='0.3']").remove();
        $("g[opacity='0.4']").remove();
        var chart = am4core.create(div_id, am4charts.XYChart);
        chart.data = data_chart;

        chart.language.locale = am4lang_vi_VN;
        chart.logo.height = -500;
        chart.fontSize = 13;
        chart.dateFormatter.inputDateFormat = "HH:mm:ss, dd/MM/yyyy";

        /*** View Chart Line theo Date ***/
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.grid.template.location = 0;
        dateAxis.renderer.minGridDistance = 50;
        /*** Thay đổi width chart do khoảng cách thời gian ***/
        dateAxis.baseInterval = {
            "timeUnit": "second",
            "count": 1
        }
        dateAxis.tooltipDateFormat = "HH:mm:ss, dd/MM/yyyy";
        dateAxis.showOnInit = false;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "";

        var series = chart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = data;
        series.dataFields.dateX = key;
        series.strokeWidth = 2;
        series.tensionX = 1;
        series.stroke = "#007bff";
        series.fill = "#007bff";
        series.fillOpacity = 0.3;
        series.yAxis = valueAxis;
        series.tooltipText = "Thời gian: {dateX}\n Giá trị: [bold font-size: 13]{valueY}[/]";

        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineY.opacity = 0;

        var title = chart.titles.create();
        title.text = name_title;
        title.fontSize = 25;
        title.fontFamily = "Arial";
        title.marginBottom = 30;

        chart.invalidateData();
    });
};

/*---- Group Chart của nhiều trạm quan trắc ----*/
function render_groupColumnchart_quantrac(div_id, data_chart, name_title, unit, key) {
    am4core.useTheme(am4themes_animated);
    am4core.ready(function () {

        /** Remove Logo **/
        $("g[opacity='0.3']").remove();
        $("g[opacity='0.4']").remove();
        var chart = am4core.create(div_id, am4charts.XYChart);
        chart.data = data_chart;

        chart.language.locale = am4lang_vi_VN;
        chart.logo.height = -9999;
        chart.fontSize = 13;
        chart.dateFormatter.inputDateFormat = "HH:mm:ss, dd/MM/yyyy";

        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.grid.template.location = 0;
        /*** Label thời gian nằm giữa column ***/
        dateAxis.renderer.labels.template.location = 0.5;
        dateAxis.renderer.minGridDistance = 50;
        dateAxis.baseInterval = {
            "timeUnit": "minute",
            "count": 5
        }
        dateAxis.tooltipDateFormat = "HH:mm:ss, dd/MM/yyyy";

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "(" + unit + ")";

        function createSeries(field, name, color) {
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = field;
            series.dataFields.dateX = key;
            series.name = name;
            series.stroke = color;
            series.fill = color;
            series.fillOpacity = 0.3;
            series.tooltipText = "Trạm quan trắc: [bold font-size: 13]{name}\n" +
                "Thời gian: [bold font-size: 13]{dateX}\n " +
                "Giá trị: [bold font-size: 13]{valueY} " + unit + "[/]";
        }

        /*** Tạo Column Series theo từng trạm với mỗi thông số ***/
        var color =  ["#ffb157", "#007bff", "#1ab400", "#b43c29", "#7d61b4"];
        var length = Object.keys(data_chart[0]).length;
        for (var i = 0; i < length; i++) {
            if (Object.keys(data_chart[0])[i] != 'time' &&
                Object.keys(data_chart[0])[i] != 'time_js') {
                for (var j = 0; j < data_quantrac_selected.length; j++) {
                    if (data_quantrac_selected[j].id == Object.keys(data_chart[0])[i])
                        createSeries(Object.keys(data_chart[0])[j],
                            data_quantrac_selected[j].name, color[j]);
                }
            }
        }

        chart.cursor = new am4charts.XYCursor();

        chart.legend = new am4charts.Legend();
        chart.legend.position = "right";
        chart.legend.fontSize = 15;

        var markerTemplate = chart.legend.markers.template;
        markerTemplate.width = 30;
        markerTemplate.height = 30;

        var title = chart.titles.create();
        title.text = name_title;
        title.fontSize = 25;
        title.fontFamily = "Arial";
        title.marginBottom = 30;

        /*** Delay Time Export ***/
        chart.exporting.timeoutDelay = 500;

        chart.exporting.menu = new am4core.ExportMenu();
        chart.exporting.menu.align = "left";
        chart.exporting.menu.verticalAlign = "top";
        chart.exporting.menu.items = [{
            "label": "XUẤT FILE",
            "menu": [
                {"type": "png", "label": "PNG"},
                {"type": "xlsx", "label": "Excel"},
                {"type": "pdf", "label": "PDF"}
            ]
        }];

        chart.scrollbarX = new am4core.Scrollbar();
        chart.scrollbarX.parent = chart.bottomAxesContainer;
    });
}

function render_groupLinechart_quantrac(div_id, data_chart, name_title, unit, key) {
    am4core.useTheme(am4themes_animated);
    am4core.ready(function () {

        /** Remove Logo **/
        $("g[opacity='0.3']").remove();
        $("g[opacity='0.4']").remove();
        var chart = am4core.create(div_id, am4charts.XYChart);
        chart.data = data_chart;

        chart.language.locale = am4lang_vi_VN;
        chart.logo.height = -9999;
        chart.fontSize = 13;
        chart.dateFormatter.inputDateFormat = "HH:mm:ss, dd/MM/yyyy";

        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.grid.template.location = 0;
        /*** Label thời gian nằm giữa column ***/
        dateAxis.renderer.labels.template.location = 0.5;
        dateAxis.renderer.minGridDistance = 50;
        dateAxis.baseInterval = {
            "timeUnit": "minute",
            "count": 5
        }
        dateAxis.tooltipDateFormat = "HH:mm:ss, dd/MM/yyyy";

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "(" + unit + ")";

        function createSeries(field, name, color, bullet) {
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = field;
            series.dataFields.dateX = key;
            series.name = name;
            series.strokeWidth = 2;
            series.tensionX = 0.7;
            series.stroke = color;
            series.fill = color;
            series.fillOpacity = 0.3;
            series.tooltipText = "Trạm quan trắc: [bold font-size: 13]{name}\n" +
                "Thời gian: [bold font-size: 13]{dateX}\n " +
                "Giá trị: [bold font-size: 13]{valueY}[/] " + unit + "[/]";

            var interfaceColors = new am4core.InterfaceColorSet();

            switch (bullet) {
                case "triangle":
                    var bullet_1 = series.bullets.push(new am4charts.Bullet());
                    bullet_1.width = 12;
                    bullet_1.height = 12;
                    bullet_1.horizontalCenter = "middle";
                    bullet_1.verticalCenter = "middle";

                    var triangle = bullet_1.createChild(am4core.Triangle);
                    triangle.stroke = interfaceColors.getFor("background");
                    triangle.strokeWidth = 2;
                    triangle.direction = "top";
                    triangle.width = 12;
                    triangle.height = 12;
                    break;
                case "rectangle":
                    var bullet_2 = series.bullets.push(new am4charts.Bullet());
                    bullet_2.width = 12;
                    bullet_2.height = 12;
                    bullet_2.horizontalCenter = "middle";
                    bullet_2.verticalCenter = "middle";

                    var rectangle = bullet_2.createChild(am4core.Rectangle);
                    rectangle.stroke = interfaceColors.getFor("background");
                    rectangle.strokeWidth = 2;
                    rectangle.direction = "top";
                    rectangle.width = 12;
                    rectangle.height = 12;

                    var shadow = new am4core.DropShadowFilter();
                    shadow.dx = 2;
                    shadow.dy = 2;
                    rectangle.filters.push(shadow);
                    break;
                case "circle":
                    var bullet_3 = series.bullets.push(new am4charts.Bullet());
                    bullet_3.width = 12;
                    bullet_3.height = 12;
                    bullet_3.horizontalCenter = "left";
                    bullet_3.verticalCenter = "left";

                    var circle = bullet_3.createChild(am4core.Circle);
                    circle.stroke = interfaceColors.getFor("background");
                    circle.strokeWidth = 2;
                    circle.direction = "top";
                    circle.width = 12;
                    circle.height = 12;
                    break;
                case "arrow":
                    var bullet_4 = series.bullets.push(new am4charts.Bullet());
                    bullet_4.width = 12;
                    bullet_4.height = 12;
                    bullet_4.horizontalCenter = "middle";
                    bullet_4.verticalCenter = "bottom";

                    var arrow = bullet_4.createChild(am4core.Triangle);
                    arrow.stroke = interfaceColors.getFor("background");
                    arrow.strokeWidth = 2;
                    arrow.direction = "top";
                    arrow.width = 12;
                    arrow.height = 15;
                    break;
                case "square":
                    var bullet_5 = series.bullets.push(new am4charts.Bullet());
                    bullet_5.width = 12;
                    bullet_5.height = 12;
                    bullet_5.horizontalCenter = "middle";
                    bullet_5.verticalCenter = "middle";

                    var square = bullet_5.createChild(am4core.Rectangle);
                    square.stroke = interfaceColors.getFor("background");
                    square.strokeWidth = 2;
                    square.direction = "top";
                    square.width = 12;
                    square.height = 12;
                    break;
            }
        }

        /*** Tạo Column Series theo từng trạm với mỗi thông số ***/
        var bullet = ["triangle", "rectangle", "circle", "arrow", "square"]
        var color =  ["#ffb157", "#007bff", "#1ab400", "#b43c29", "#7d61b4"];
        var length = Object.keys(data_chart[0]).length;
        for (var i = 0; i < length; i++) {
            if (Object.keys(data_chart[0])[i] != 'time' &&
                Object.keys(data_chart[0])[i] != 'time_js') {
                for (var j = 0; j < data_quantrac_selected.length; j++) {
                    if (data_quantrac_selected[j].id == Object.keys(data_chart[0])[i])
                        createSeries(Object.keys(data_chart[0])[j],
                            data_quantrac_selected[j].name, color[j], bullet[j]);
                }
            }
        }

        chart.cursor = new am4charts.XYCursor();

        chart.legend = new am4charts.Legend();
        chart.legend.position = "right";
        chart.legend.fontSize = 15;

        var markerTemplate = chart.legend.markers.template;
        markerTemplate.width = 30;
        markerTemplate.height = 30;

        var title = chart.titles.create();
        title.text = name_title;
        title.fontSize = 25;
        title.fontFamily = "Arial";
        title.marginBottom = 30;

        /*** Delay Time Export ***/
        chart.exporting.timeoutDelay = 500;

        chart.exporting.menu = new am4core.ExportMenu();
        chart.exporting.menu.align = "left";
        chart.exporting.menu.verticalAlign = "top";
        chart.exporting.menu.items = [{
            "label": "XUẤT FILE",
            "menu": [
                {"type": "png", "label": "PNG"},
                {"type": "xlsx", "label": "Excel"},
                {"type": "pdf", "label": "PDF"}
            ]
        }];

        chart.scrollbarX = new am4core.Scrollbar();
        chart.scrollbarX.parent = chart.bottomAxesContainer;
    });
}