function fnExcelReport(id_table) {
    var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
    tab_text = tab_text + '<x:Name>ketquathongke</x:Name>';
    tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
    tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
    tab_text = tab_text + "<table border='1px'>";

    tab_text = tab_text + $("#" + id_table).html();
    tab_text = tab_text + '</table></body></html>';

    var data_type = 'data:application/vnd.ms-excel';

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    /*** For IE ***/
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        if (window.navigator.msSaveBlob) {
            var blob = new Blob([tab_text], {type: "application/csv;charset=utf-8;"});
            navigator.msSaveBlob(blob, 'ketquathongke.xls');
        }
    }
    /*** for Chrome and Firefox ****/
    else {
        $('#exportExcel').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
        $('#exportExcel').attr('download', 'ketquathongke.xls');
    }
}

function fnPDFReport(id_table) {
    var sTable = document.getElementById(id_table).innerHTML;

    var style = "<style>";
    style = style + "table {width: 100%;font: 17px Arial;}";
    style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
    style = style + "padding: 2px 3px;text-align: center;}";
    style = style + "</style>";

    var win = window.open('', '', 'height=700,width=700');

    win.document.write('<html><head>');
    win.document.write('<title>ketquathongke</title>');
    win.document.write(style);
    win.document.write('</head>');
    win.document.write('<body>');
    win.document.write(sTable);
    win.document.write('</body></html>');
    win.document.close();
    win.print();
}

$("#exportExcel").click(function () {
    fnExcelReport("table_result_stat")
})

$("#exportPDF").click(function () {
    fnPDFReport("tab_stat")
})
