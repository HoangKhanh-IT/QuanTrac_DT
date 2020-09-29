var protocol = "http://";
/*----- Host Server -----*/
var hostIP = "10.151.46.88";
var sApp = "travinhqt_laravel";

var hostGeoserver = "gisportal.vn/";
var wmts = "geoserver/gwc/service/wmts?";
var layer_workspace = "layer=quantrac_travinh:";
var services = "&style=" +
    "&tilematrixset=EPSG:900913" +
    "&Service=WMTS" +
    "&Request=GetTile" +
    "&Version=1.0.0" +
    "&Format=image/png" +
    "&TileMatrix=EPSG:900913:{z}&TileCol={x}&TileRow={y}";


