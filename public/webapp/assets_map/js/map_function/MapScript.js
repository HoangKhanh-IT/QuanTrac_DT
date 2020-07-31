/*---- Control Base Map ----*/
var Basemaps_Control = [
    L.tileLayer('https://mt1.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
        attribution: 'Google Terrain',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Bản đồ địa hình Google',
        iconURL: 'https://mt1.google.com/vt/lyrs=p&x=101&y=60&z=7'
    }),

    L.tileLayer('//{s}.tile.stamen.com/toner-lite/{z}/{x}/{y}.png', {
        attribution: 'Map tiles by',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Bản đồ đơn giản',
        /* optional label used for tooltip */
        iconURL: 'public/webapp/assets/images/b_tile.stamen.png'

    }),

    L.tileLayer('http://gis.chinhphu.vn/BaseMap/{z}/{x}/{y}.png', {
        attribution: 'Map tiles by gis.chinhphu.vn',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Bản đồ hành chính',
        iconURL: 'public/webapp/assets/images/gis_chinhphu.png'
    }),

    L.tileLayer('http://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}', {
        attribution: 'Google Satellite',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Ảnh vệ tinh Google',
        iconURL: 'http://mt0.google.com/vt/lyrs=s&hl=en&x=101&y=60&z=7'
    }),

    L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Map tiles by Esri',
        subdomains: 'abcd',
        maxZoom: 20,
        minZoom: 0,
        label: 'Ảnh vệ tinh ESRI',
        iconURL: 'http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/7/60/101'
    }),
]

/*---- Đọc WMS Geosever
var view_travinh_huyen = L.tileLayer.wms('http://10.151.46.88:8082/geoserver/quantrac_travinh/wms?', {
    layers: 'DiaPhanHuyen',
    tiled: true,
    format: 'image/png',
    transparent: true
}); ----*/

/*---- Đem biến map ra ngoài cấu trúc nested của getJSON để không bị lỗi invalidateSize bên main.js ----*/
var map = L.map('mymap', {
    center: [9.8095, 106.274],
    zoomSnap: 0.25,
    zoom: 10.5,
    /*** Một số laptop hiển thị bản đồ khác nhau ==> zoom lên khi load ==> Thay đổi mức zoom
    zoom: 10.75, ***/
    zoomControl: false,
});

/*---- GPS user ----*/
var gps = new L.Control.Gps({
    autoCenter: true,
    maxZoom: 11,
});

gps.on('gps:located', function(e) {
    e.marker.bindPopup(e.latlng.toString()).openPopup()
}).on('gps:disabled', function(e) {
    e.marker.closePopup()
});

gps.addTo(map);

/*---- Fullscreen Leaflet ----*/
L.control.fullscreen({
    position: 'topleft',
    title: 'Phóng to bản đồ',
    titleCancel: 'Thu nhỏ bản đồ ',
}).addTo(map);

/*---- Zoom Home ----*/
var zoomHome = L.Control.zoomHome();
zoomHome.addTo(map);

/*---- Biến tìm kiếm quan trắc cơ bản ----*/
var quantrac_search_advanced = [];
var quantrac_search_basic = [];

/*---- Tạo Pulse Marker ----*/
var pulse_marker;
var pulsingIcon = L.icon.pulse({
    iconSize: [13, 13],
    color: '#ff0000',
    fillColor: 'rgba(255,255,255,0)',
    heartbeat: 1
});

/*---- Hàm Zoom on Click marker ----*/
function markerOnClick(e) {
    var latLngs = [e.target.getLatLng()];
    var lat = latLngs[0]['lat'];
    var lng = latLngs[0]['lng'] - 0.01;
    var markerBounds = L.latLngBounds([lat, lng], [lat, lng]);
    map.fitBounds(markerBounds, {
        maxZoom: 15
    });
}

/*---- Dữ liệu không gian ----*/
var station_id;

/*** Modal cho Search Nâng cao ***/
function Modal_Feature_Advanced(feat, layer) {
    Feature_info_modal(feat, layer)

    /*** Tạo mảng quantrac_search_advanced ***/
    quantrac_search_advanced.push({
        name: feat.properties.name,
        quanhuyen: feat.properties.districtName,
        loaihinh: feat.properties.obstype_namelist,
        loaitram: feat.properties.categoryName,
        loaidiadanh: feat.properties.locationType,
        diadanh: feat.properties.locationName,
        source: 'quantrac_search_advanced',
        id: L.stamp(layer),
        lat: feat.geometry.coordinates[1],
        lng: feat.geometry.coordinates[0]
    })
}

/*** Modal cho Search Cơ bản ***/
function Modal_Feature_Basic(feat, layer) {
    Feature_info_modal(feat, layer)

    /*** Tạo mảng quantrac_search_basic ***/
    quantrac_search_basic.push({
        name: feat.properties.name,
        quanhuyen: feat.properties.districtName,
        loaihinh: feat.properties.obstype_namelist,
        loaitram: feat.properties.categoryName,
        loaidiadanh: feat.properties.locationType,
        diadanh: feat.properties.locationName,
        source: 'quantrac_search_basic',
        id: L.stamp(layer),
        lat: feat.geometry.coordinates[1],
        lng: feat.geometry.coordinates[0]
    })
}

/*---- Hiển thị ký hiệu trạm quan trắc theo loại hình ----*/
function Modal_Feature_Style(feat, latlng) {
    /*** Trạm quan trắc đất ***/
    if (feat.properties.obstype_namefirst == "Đất") {
        /*** Tạo Label cho các trạm quan trắc ***/
        var label_tram_dat = '<p class="tram_dat_label"><b>Trạm ' + feat.properties.name + '</b></p>';
        return L.marker(latlng, {
            icon: L.divIcon({
                html: "<i class='icon-checkbox-unchecked2 tram_dat_symbol'></i>",
                popupAnchor: [0, 0],
                iconAnchor: [8, 8],
                className: 'mouse_pointer tram_dat_divIcon'
            }),
            /*** Hover điểm quan trắc ***/
            title: feat.properties.name,
            riseOnHover: true
                /*** Tooltip cho các trạm quan trắc ***/
        }).bindTooltip(label_tram_dat, {
            permanent: true,
            direction: "center",
            opacity: 1
        }).openTooltip().on('click', markerOnClick)

        /*** Trạm quan trắc Nước mặt ***/
    } else if (feat.properties.obstype_namefirst == "Nước mặt") {
        var label_tram_nuocmat = '<p class="tram_nuocmat_label"><b>Trạm ' + feat.properties.name + '</b></p>';
        return L.marker(latlng, {
            icon: L.divIcon({
                html: "<i class='icon-wave2 tram_nuocmat_symbol'></i>",
                popupAnchor: [0, 0],
                iconAnchor: [8, 8],
                className: 'mouse_pointer tram_nuocmat_divIcon'
            }),
            title: feat.properties.name,
            riseOnHover: true
        }).bindTooltip(label_tram_nuocmat, {
            permanent: true,
            direction: "center",
            opacity: 0
        }).openTooltip().on('click', markerOnClick)

        /*** Trạm quan trắc Nước ngầm ***/
    } else if (feat.properties.obstype_namefirst == "Nước ngầm") {
        var label_tram_nuocngam = '<p class="tram_nuocngam_label"><b>Trạm ' + feat.properties.name + '</b></p>';
        return L.marker(latlng, {
            icon: L.divIcon({
                html: "<i class='icon-graph tram_nuocngam_symbol'></i>",
                popupAnchor: [0, 0],
                iconAnchor: [8, 8],
                className: 'mouse_pointer tram_nuocngam_divIcon'
            }),
            title: feat.properties.name,
            riseOnHover: true
        }).bindTooltip(label_tram_nuocngam, {
            permanent: true,
            direction: "center",
            opacity: 0
        }).openTooltip().on('click', markerOnClick)

        /*** Trạm quan trắc Nước thải ***/
    } else if (feat.properties.obstype_namefirst == "Nước thải" ||
        feat.properties.obstype_namefirst == "Nước thải sinh hoạt" ||
        feat.properties.obstype_namefirst == "Nước thải y tế" ||
        feat.properties.obstype_namefirst == "Nước thải công nghiệp, làng nghề") {
        var label_tram_nuocthai = '<p class="tram_nuocthai_label"><b>Trạm ' + feat.properties.name + '</b></p>';
        return L.marker(latlng, {
            icon: L.divIcon({
                html: "<i class='icon-alert tram_nuocthai_symbol'></i>",
                popupAnchor: [0, 0],
                iconAnchor: [8, 8],
                className: 'mouse_pointer tram_nuocthai_divIcon'
            }),
            title: feat.properties.name,
            riseOnHover: true
        }).bindTooltip(label_tram_nuocthai, {
            permanent: true,
            direction: "center",
            opacity: 0
        }).openTooltip().on('click', markerOnClick)

        /*** Trạm quan trắc Không khí ***/
    } else if (feat.properties.obstype_namefirst == "Không khí" ||
        feat.properties.obstype_namefirst == "Không khí khu đô thị" ||
        feat.properties.obstype_namefirst == "Khí thải khu công nghiệp, cụm công nghiệp" ||
        feat.properties.obstype_namefirst == "Không khí xung quanh") {
        var label_tram_khongkhi = '<p class="tram_khongkhi_label"><b>Trạm ' + feat.properties.name + '</b></p>';
        return L.marker(latlng, {
            icon: L.divIcon({
                html: "<i class='glyphicon glyphicon-cloud tram_khongkhi_symbol'></i>",
                popupAnchor: [0, 0],
                iconAnchor: [8, 8],
                className: 'mouse_pointer tram_khongkhi_divIcon'
            }),
            title: feat.properties.name,
            riseOnHover: true
        }).bindTooltip(label_tram_khongkhi, {
            permanent: true,
            direction: "center",
            opacity: 1
        }).openTooltip().on('click', markerOnClick)

    } else if (feat.properties.obstype_namefirst == "Nước biển ven bờ") {
        var label_tram_nuocbien = '<p class="tram_nuocbien_label"><b>Trạm ' + feat.properties.name + '</b></p>';
        return L.marker(latlng, {
            icon: L.divIcon({
                html: "<i class='icon-air tram_nuocbien_symbol'></i>",
                popupAnchor: [0, 0],
                iconAnchor: [8, 8],
                className: 'mouse_pointer tram_nuocbien_divIcon'
            }),
            title: feat.properties.name,
            riseOnHover: true
        }).bindTooltip(label_tram_nuocbien, {
            permanent: true,
            direction: "center",
            opacity: 1
        }).openTooltip().on('click', markerOnClick)
    }
}

/*** Khi load trang hay F5 sẽ không gọi service 'call_obser_station.php' - Dữ liệu trống ***/
view_data_quantrac = new L.GeoJSON.AJAX(null, {
    onEachFeature: Modal_Feature_Advanced,
    pointToLayer: Modal_Feature_Style
})
view_data_quantrac.addTo(map);

/*** Khi load trang hay F5 sẽ gọi service 'call_obser_station.php' không chứa điều kiện - Search Cơ bản ***/
var url_search_basic = "obserStation?loaihinh[]=0&loaitram=1=1&quanhuyen=1=1" +
    "&loaidiadanh=1=1&diadanh=1=1"
$.getJSON(url_search_basic, function(search_basic) {
    L.geoJSON(search_basic, {
        onEachFeature: Modal_Feature_Basic,
        pointToLayer: function(feat, latlng) {
            return L.marker(latlng, { opacity: 0 }).on('click', markerOnClick);
        },
    }).addTo(map)
})

/*** Tạo hàm Refresh Option, số lần chạm là 0 sẽ không thay đổi ***/
count_click = 0;

function Refresh_Option() {
    count_click++;
    if (count_click > 0) {
        view_data_quantrac.refresh(url_search_basic);
    }
}

map.addControl(
    L.control.basemaps({
        basemaps: Basemaps_Control,
        tileX: 0,
        /* tile X coordinate */
        tileY: 0,
        /* tile Y coordinate */
        tileZ: 1 /* tile zoom level */
    })
);

/*---- Add layer Geoserver ----*/
/*** var ggm = new L.Google('ROADMAP');
 ggm.addTo(map);
view_travinh_huyen.addTo(map); ***/
