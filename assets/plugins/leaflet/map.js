//Testa se possue os elementos para funcionar o MAPA
let centro = L.latLng(-32.0395, -52.1014);


//Boundbox de RG 
let sudoeste = L.latLng(-32.6625, -52.697222222222216),
    nordeste = L.latLng(-31.78388888888889, -52.06388888888888),
    max_bounds = L.latLngBounds(sudoeste, nordeste);

    
//Coleção dos marcadores  
let markers = L.markerClusterGroup({
    spiderfyOnMaxZoom: true,
    showCoverageOnHover: true,
    zoomToBoundsOnClick: true,
    freezeAtZoom: 20
});

//Coleção dos polígonos    
let polygons = new L.FeatureGroup();

var retangulo_bounds = L.rectangle(max_bounds, { color: 'blue', weight: 1 }).on('click', function(e) {});

function testaElementos() {
    let erro = '';

    if (!$("#map").length) {
        erro += 'Precisa de uma DIV com ID map para funcionar \n';
    }
    if (!$("#latitude").length) {
        erro += 'Precisa de uma INPUT com ID latitude para funcionar \n';
    }
    if (!$("#longitude").length) {
        erro += 'Precisa de um INPUT com ID longitude para funcionar \n';
    }

    return erro;
}

function initMap() {
    var testeForm = testaElementos();

    if (!testa_empty(testeForm)) {
        alert(testeForm);
    } else {
        map = L.map('map').setView(centro, 12);

        var token = 'pk.eyJ1IjoiZXplcXVpZWx2aWN0b3I4MyIsImEiOiJjanR5a2NqOW8xNzJ1M3ptZnpxeHZ5em03In0.nxzfPctBbtK-HejwzFqHPA';

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Prefeitura Municipal de Rio Grande',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: token
        }).addTo(map);

        map.on('popupopen', function(e) {
            var px = map.project(e.popup._latlng);
            // Pixel do popup
            px.y -= e.popup._container.clientHeight / 2
                // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
            map.panTo(map.unproject(px), { animate: true });
        });

    } //FIM ELSE
}

function Pin(id, titulo, coordenadas, icone) {
    let pin = new L.Marker(coordenadas, {
        draggable: false,
        id: id,
        title: titulo,
        icon: icone
    });

    pin.on('click', function(ev) {
        centerLeafletMapOnMarker(map, this);
    });

    return pin;
}

function Polygon(id, titulo, geoJson, estilo) {

    let polygon = new L.geoJson(geoJson, {
        id: id,
        title: titulo,       
        style: estilo,
        onEachFeature: onEachFeature
    });

    geojson = polygon;

    return polygon;
}


function centerLeafletMapOnMarker(map, marker) {
    var latLngs = [marker.getLatLng()];
    var markerBounds = L.latLngBounds(latLngs);
    map.fitBounds(markerBounds);
}

//Metodo de escolha de Icone Beautify
function getBeautifyIcon(forma, icone, cor, css) {
    var beautify_icon = L.BeautifyIcon.icon({
        iconShape: forma,
        icon: icone,
        iconSize: new L.Point(36, 36),
        iconAnchor: new L.Point(18, 36),
        borderColor: cor,
        textColor: cor,
        backgroundColor: 'white',
        borderWidth: '4',
        innerIconStyle: css
    });
    return beautify_icon;
}

function ajustaBounds(total = false) { 
    if (markers.getBounds().isValid()) {
        setTimeout(function() { //calls click event after a certain time
            map.fitBounds(markers.getBounds().pad(0.20)); //pad 20%       
        }, 1000);
    } //Fim valid   
    if(total == true){ 
        if (polygons.getBounds().isValid()) {
            setTimeout(function() { //calls click event after a certain time
                map.fitBounds(polygons.getBounds().pad(0.10)); //pad 10% 
            }, 1000);      
        } //Fim valid     
    }       
}

function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        fillOpacity: 0.8,
        opacity: 0.8
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();       
    }
}

function resetHighlight(e) {
    var layer = e.target;
    geojson.resetStyle(layer);
}

function zoomToFeature(e) {
    if (e.target.getBounds().isValid()) {
        map.fitBounds(e.target.getBounds());
    }
}

function flyto(e) {
    if (e.target.getBounds().isValid()) {
        center = e.target.getBounds().getCenter();

        setTimeout(function() {
            map.flyTo([center.lat, center.lng], 15, {
                animate: true,
                duration: 2 // in seconds
            });
        }, 1000);

    }
}

function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature,
        flyto
        //dblclick : flyto 
    });
    //Apelido na Layer para chamar mais facil
   
    layer.bindTooltip(feature.properties.name);
}

function freeze_map(status) {
    if (status == true) {
        map.dragging.disable();
        map.touchZoom.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();
        map.boxZoom.disable();
        map.keyboard.disable();
        if (map.tap) map.tap.disable();
        document.getElementById('map').style.cursor = 'default';
    } else {
        map.dragging.enable();
        map.touchZoom.enable();
        map.doubleClickZoom.enable();
        map.scrollWheelZoom.enable();
        map.boxZoom.enable();
        map.keyboard.enable();
        if (map.tap) map.tap.enable();
        document.getElementById('map').style.cursor = 'grab';
    }
}


function testa_empty(val) {
    if (val === undefined)
        return true;
    if (typeof(val) == 'function' || typeof(val) == 'number' || typeof(val) == 'boolean' || Object.prototype.toString.call(val) === '[object Date]')
        return false;
    if (val == null || val.length === 0) // null or 0 length array
        return true;
    if (typeof(val) == "object") {
        // empty object

        var r = true;

        for (var f in val) {
            r = false;
        }
        return r;
    }
    return false;
}