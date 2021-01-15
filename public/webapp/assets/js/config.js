var protocol = "http://";
/*----- Host Server -----*/
var hostIP = "localhost:882";
var sApp = "travinhqt_laravel";

var hostGeoserver = "localhost:8080/";
var wmts = "geoserver/gwc/service/wmts?";
var layer_workspace = "layer=quantrac_dongthap:";
var services = "&style=" +
    "&tilematrixset=EPSG:900913" +
    "&Service=WMTS" +
    "&Request=GetTile" +
    "&Version=1.0.0" +
    "&Format=image/png" +
    "&TileMatrix=EPSG:900913:{z}&TileCol={x}&TileRow={y}";


