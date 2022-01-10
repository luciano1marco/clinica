function geocode_Input(endereco){
    var key1 = 'gVjrAmR56Ko4N40dvuYy';   
    var key2 = 'cSQuS02Wd0TLLqVo5GAM3ftR9LD5oppn';

    $.ajax({
        /* MAP Tiler CLOUD NEW*/
        url: "https://geocoder.tilehosting.com/br/q/["+endereco+"].js?key="+key1
        /* MAP Tiler CLOUD OLD */ 
        //url: "https://geocoder.tilehosting.com/br/q/["+endereco+"].js?key="+key1  
        /* MAPQUEST */      
        //url: "https://www.mapquestapi.com/geocoding/v1/address?key="+key2+'&location='+endereco      
    }).then(function(data) {     
        jQuery.each(data.results, function(index, itemData) {
        //geocode_Debug(index,itemData);

        var latitude    = itemData.lat;
        var longitude   = itemData.lon;
                               
        if(!testa_empty(latitude) && !testa_empty(longitude)){   
            var coords = new L.LatLng(latitude, longitude);                                        
            var existe_riogrande = max_bounds.contains(coords);
            
            if(existe_riogrande){                                      
                $("#latitude").val(latitude);
                $("#longitude").val(longitude);  
                              
                if(!testa_empty(latitude) && !testa_empty(longitude)){  
                    var coords = new L.LatLng(latitude, longitude);                           
                    // Marcador com Coordenadas
                    coords_Marker(coords); 
                    // Marcador com Geocode
                    //geocode_Marker(endereco);
                }            
            }//ESTA DENTRO DOS BOUNDS           
        }
        //TESTA LAT LNG        
    });  
});
}

function coords_Marker(coords){  
    // Limpa os Markers
    markers.clearLayers();
    // Se existe nos bounds de Rio Grande                                                
    var existe_riogrande = max_bounds.contains(coords);
    
    if(existe_riogrande){        
        // Cria um Marcador
        var pin = addMarker(coords.lat, coords.lng, 'Marcador');
        // Adiciona marcador ao markercluster
        markers.addLayer(pin);
        // Adiciona o markercluster ao mapa
        map.addLayer(markers);
        // Ajusta Bounds em torno do marcador
        ajustaBounds();
        // Se precisa desligar funções do map como se deslocar
        //freeze_map(true);

        // Leaflet PIP
        geocode_PIP(coords);
    }
}

function geocode_Marker(endereco){
    markers.clearLayers();
    // Sempre sai sem Ponto
    var tem_ponto = false; 

    var key1 = 'gVjrAmR56Ko4N40dvuYy';   
    var key2 = 'cSQuS02Wd0TLLqVo5GAM3ftR9LD5oppn';

    $.ajax({
        /* MAP Tiler CLOUD NEW*/
        url: "https://geocoder.tilehosting.com/br/q/["+endereco+"].js?key="+key1
        /* MAP Tiler CLOUD OLD */ 
        //url: "https://geocoder.tilehosting.com/br/q/["+endereco+"].js?key="+key1  
        /* MAPQUEST */      
        //url: "https://www.mapquestapi.com/geocoding/v1/address?key="+key2+'&location='+endereco      
    }).then(function(data) {             
        jQuery.each(data.results, function(index, itemData) {
        //geocode_Debug(index,itemData);

        latitude    = itemData.lat;
        longitude   = itemData.lon;
                   
        var coords = new L.LatLng(latitude, longitude);
       
        if(!testa_empty(latitude) && !testa_empty(longitude)){                                           
            var existe_riogrande = max_bounds.contains(coords);

            if(existe_riogrande){               
                var pin = addMarker(latitude,longitude,'TESTE');
                markers.addLayer(pin);

                map.addLayer(markers);
                ajustaBounds(false);
                //freeze_map(true);

                $("#latitude").val(latitude);
                $("#longitude").val(longitude);

                // Leaflet PIP
                geocode_PIP(coords);
            }
        }
    });  
});
}

function geocode_PIP(coords){  
    polygons.eachLayer(function(layer){
        var pointlayer = leafletPip.pointInLayer(coords, layer, true);

        if(!testa_empty(pointlayer)){                             
            var pdm  = pointlayer[0].options.title;        
            $("#pdm").val(pdm);
        }

      });
}

function geocode_Debug(index, itemData){   
    console.log(itemData);    
    console.log(itemData.lat);
    console.log(itemData.lon);
}

function poligonoSelecionado(handleData) {      
    var u_id = $('#unidadeplanejamento').val();

    $.ajax({
        url: dir_base + 'admin/aprovacaomultifamiliar/getPoligonos/' +u_id,  
        success: function(data) {    
            $.each(data, function(index, value) {                     
                $('#unidadenome').attr('value', value.nome)    
                $('#poligono').val(value.poligono);                
                mostrarPoligono();
            });     
        }
    });
}

function mostrarPoligono() {           
    let poligono = $('#poligono').val();
    let nome_unidade = $('#unidadenome').val();      
    // Limpa poligonos
    polygons.clearLayers();

    if(!testa_empty(poligono)){
        var geojson = JSON.parse(poligono);
                    
        //Feature Collection
        geojson.features[0]['properties']['name'] = nome_unidade;

        var estilo = {
            "color": "#FF0000",
            "weight": 5,
            "opacity": 0.65
        };
                   
        id = 1;          
        titulo = 'Sem Título';
       
        var regiao = Polygon(id, titulo, geojson, estilo);
        //LayerGroup
        polygons.addLayer(regiao);
        //Add Layer no Mapa
        polygons.addTo(map); 
        ajustaBounds(true);      
    }
}

function addMarker(lat, lng, titulo){
    //Icone      
    formato = 'circle';              
    css = 'font-size: 20px;';        
    icone = 'home';
    cor = 'red';  

    var icone_mapa = getBeautifyIcon(formato, icone, cor, css); 
    var coords = new L.LatLng(lat, lng);

    var marker = new Pin(1, titulo, coords, icone_mapa );                               
    marker.bindPopup(titulo);

    return marker;       
}

function carregarPDM() {      
    $.ajax({
        url: dir_base + 'admin/aprovacaomultifamiliar/getPoligonos/',  
        success: function(data) {     
            $.each(data, function(index, value) {           
                var id = value.id;
                var nome_unidade = value.nome;        
                var geojson = JSON.parse(value.poligono);

                var r = Math.floor(Math.random() * 256); 
                var g = Math.floor(Math.random() * 256); 
                var b = Math.floor(Math.random() * 256); 
                
                if(!testa_empty(geojson)){
                    var estilo = {
                        "color": 'rgb('+r+','+g+','+b+')',
                        "weight": 1,
                        "opacity": 0.65
                    };

                    var poligono = new Polygon(id, nome_unidade, geojson, estilo);  
                    polygons.addLayer(poligono);                   
                }
            });  
        map.addLayer(polygons);             
        }
    });
}