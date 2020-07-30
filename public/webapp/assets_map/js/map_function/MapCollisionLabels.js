/*---- Hàm Collison Labels ----*/
var i = 0;
var hideLabel = function (label) {
    label.labelObject.style.opacity = 0;
};
var showLabel = function (label) {
    label.labelObject.style.opacity = 1;
};
labelEngine = new labelgun.default(hideLabel, showLabel);

view_data_quantrac.eachLayer(function (label) {
    label.added = true;
    addLabel(label, i);
    i++;
});
view_data_quantrac.addTo(map);
map.on("zoomend", function () {
    resetLabels(view_data_quantrac);
});
resetLabels(view_data_quantrac);

function resetLabels(markers) {
    var i = 0;
    markers.eachLayer(function (label) {
        addLabel(label, ++i);
    });
    labelEngine.update();
}

function addLabel(layer, id) {
    var label = layer.getTooltip()._source._tooltip._container;
    if (label) {
        var rect = label.getBoundingClientRect();
        var bottomLeft = map.containerPointToLatLng([rect.left, rect.bottom]);
        var topRight = map.containerPointToLatLng([rect.right, rect.top]);
        var boundingBox = {
            bottomLeft: [bottomLeft.lng, bottomLeft.lat],
            topRight: [topRight.lng, topRight.lat]
        };
        labelEngine.ingestLabel(
            boundingBox, id, parseInt(Math.random() * (5 - 1) + 1), label, false
        );
        if (!layer.added) {
            layer.addTo(map);
            layer.added = true;
        }
    }
}

