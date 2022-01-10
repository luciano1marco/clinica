$(document).ready(function(){

    //Seta lingua do Moment JS
    moment.locale('pt-br');   

    if ($('.select2').length > 0) {
        $('.select2').select2({       
            theme: 'flat'
        });
    }

    if ($('.select2_multiple').length > 0) {
        $('.select2_multiple').select2({
            minimumResultsForSearch: 20,
            theme: 'flat' //Classic Default
        });
    }

    if ($('#horainiciotrabalho').length > 0) {
        $('#horainiciotrabalho').datetimepicker({
            //format: 'LT'
            format: 'HH:mm'
        });        
        
        $('#horainiciotrabalho').mask('00:00');
    }

    if ($('#horaterminotrabalho').length > 0) {
        $('#horaterminotrabalho').datetimepicker({
            //format: 'LL',
            format: 'HH:mm',            
        });

        $('#horaterminotrabalho').mask('00:00');
    }
    
    if ($('#horainicioaula').length > 0) {
        $('#horainicioaula').datetimepicker({
            //format: 'LT'
            format: 'HH:mm'
        });

        $('#horainicioaula').mask('00:00');
    }

    if ($('#horaterminoaula').length > 0) {
        $('#horaterminoaula').datetimepicker({
            //format: 'LT'
            format: 'HH:mm'
        });

        $('#horaterminoaula').mask('00:00');
    }

    if ($('.datetimepicker').length > 0) {    
        $('.datetimepicker').datetimepicker({
            //format: 'LT'
            format: 'HH:mm'
        });

        $('.datetimepicker').mask('00:00');
    }
  
    $('.escola_auto').autocomplete({
        serviceUrl: dir_base+'home/getEscolas',
        minChars: 3       
    });


    $("#trabalho_manha_inicio").hide();
    $("#trabalho_manha_termino").hide();
    $("#trabalho_tarde_inicio").hide();
    $("#trabalho_tarde_termino").hide();
    $("#trabalho_noite_inicio").hide();
    $("#trabalho_noite_termino").hide();    

    $("#aula_manha_inicio").hide();
    $("#aula_manha_termino").hide();
    $("#aula_tarde_inicio").hide();
    $("#aula_tarde_termino").hide();
    $("#aula_noite_inicio").hide();
    $("#aula_noite_termino").hide();    

    $("input[name='trabalho_manha']").on('ifToggled', function(event){
        var val = $(this).val();
        if(val == 1){
            $("#trabalho_manha_inicio").toggle();
            $("#trabalho_manha_termino").toggle();
            $("#trabalho_manha_inicio").val(null);
            $("#trabalho_manha_termino").val(null);
        }         
    });

    $("input[name='trabalho_tarde']").on('ifToggled', function(event){
        var val = $(this).val();
        if(val == 1){
            $("#trabalho_tarde_inicio").toggle();
            $("#trabalho_tarde_termino").toggle();
            $("#trabalho_tarde_inicio").val(null);
            $("#trabalho_tarde_termino").val(null);
        }         
    });

    $("input[name='trabalho_noite']").on('ifToggled', function(event){
        var val = $(this).val();
        if(val == 1){
            $("#trabalho_noite_inicio").toggle();
            $("#trabalho_noite_termino").toggle();
            $("#trabalho_noite_inicio").val(null);
            $("#trabalho_noite_termino").val(null);
        }         
    });

    $("input[name='aula_manha']").on('ifToggled', function(event){
        var val = $(this).val();
        if(val == 1){
            $("#aula_manha_inicio").toggle();
            $("#aula_manha_termino").toggle();
            $("#aula_manha_inicio").val(null);
            $("#aula_manha_termino").val(null);
        }         
    });

    $("input[name='aula_tarde']").on('ifToggled', function(event){
        var val = $(this).val();
        if(val == 1){
            $("#aula_tarde_inicio").toggle();
            $("#aula_tarde_termino").toggle();
            $("#aula_tarde_inicio").val(null);
            $("#aula_tarde_termino").val(null);
        }         
    });

    $("input[name='aula_noite']").on('ifToggled', function(event){
        var val = $(this).val();
        if(val == 1){
            $("#aula_noite_inicio").toggle();
            $("#aula_noite_termino").toggle();
            $("#aula_noite_inicio").val(null);
            $("#aula_noite_termino").val(null);
        }         
    });
   
    $("input[name='deficiente']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
     
        if(val == 1){         
            $("#panelgrp_deficiencias").show();
        }
        else{
            $("#panelgrp_deficiencias").hide();
        }       
    });

    if ($("input[name='deficiente']").is(':checked')){
        var selectedOption = $("input:radio[name=deficiente]:checked").val()
      
        if(selectedOption == 1){              
            $("#panelgrp_deficiencias").show();
        }
        else{   
            $("#panelgrp_deficiencias").hide();      
        }
    }

    $("input[name='temveiculo']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
      
        if(val == 1){         
            $("#panelgrp_qtdveiculo").show();
        }
        else{
            $("#panelgrp_qtdveiculo").hide();
        }       
    });
    if ($("input[name='temveiculo']").is(':checked')){
        var selectedOption = $("input:radio[name=temveiculo]:checked").val()
      
        if(selectedOption == 1){              
            $("#panelgrp_qtdveiculo").show();
            $("#panel_qtdveiculo").show();
        }
        else{   
            $("#panelgrp_qtdveiculo").hide();   
            $("#panel_qtdveiculo").hide(); 
        }
    }

    //acesso-------------------------------------------------
    $("input[name='temacesso']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
      
        if(val == 1){         
            $("#panelgrp_qtdacesso").show();
            
        }
        else{
            $("#panelgrp_qtdacesso").hide();
            
        }       
    });

    if ($("input[name='temacesso']").is(':checked')){
        var selectedOption = $("input:radio[name=temacesso]:checked").val()
      
        if(selectedOption == 1){              
            $("#panelgrp_qtdacesso").show();
            $("#panel_qtdacesso").show();
        }
        else{   
            $("#panelgrp_qtdacesso").hide();   
            $("#panel_qtdacesso").hide();
        }
    }
    //fim acesso
    

    $("input[name='tembicicleta']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
      
        if(val == 1){         
            $("#panelgrp_qtdbike").show();
        }
        else{
            $("#panelgrp_qtdbike").hide();
        }       
    });

    if ($("input[name='tembicicleta']").is(':checked')){
        var selectedOption = $("input:radio[name=tembicicleta]:checked").val()
      
        if(selectedOption == 1){              
            $("#panelgrp_qtdbike").show();
        }
        else{   
            $("#panelgrp_qtdbike").hide();      
        }
    }

    $("input[name='qtdfilhos']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
       
        for(var i = 1 ; i<= 10; i++){         
            var id_div = 'escolafilho'+i;

            if( i <= val){
                $('#' + id_div).show();     
            } 
            else{   
                $('#' + id_div).hide();     
            } 
        }
    });
   
    if ($("input[name='qtdfilhos']").is(':checked')){
        var val = $("input:radio[name=qtdfilhos]:checked").val();

        for(var i = 1 ; i<= 10; i++){         
            var id_div = 'escolafilho'+i;

            if( i <= val){
                $('#' + id_div).show();     
            } 
            else{   
                $('#' + id_div).hide();     
            } 
        }   
    }
   
    $("input[name='temfilhoestudante']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
       
        if(val == 1){
            $("#panelgrp_qtdfilho_estudante").show();
            $("#panelgrp_transporteescola").show();  
            $("#panel_perguntaescola").show();              
        }
        else{
            $("#panelgrp_qtdfilho_estudante").hide();
            $("#panelgrp_transporteescola").hide();
            $("#panel_perguntaescola").hide();
        }       
    });

    if ($("input[name='temfilhoestudante']").is(':checked')){
        var selectedOption = $("input:radio[name=temfilhoestudante]:checked").val()
      
        if(selectedOption == 1){              
            $("#panelgrp_qtdfilho_estudante").show();
            $("#panelgrp_transporteescola").show();  
            $("#panel_perguntaescola").show();      
        }
        else{   
            $("#panelgrp_qtdfilho_estudante").hide();
            $("#panelgrp_transporteescola").hide();
            $("#panel_perguntaescola").hide();            
        }
    }

    $("input[name='vctrabalha']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
         
        if(val == 1){
            $("#panelgrp_trabalha").show();
            $("#panelgrp_transporte_trabalho").show();            
        }
        else{
            $("#panelgrp_trabalha").hide();
            $("#panelgrp_transporte_trabalho").hide();            
        }       
    });

    if ($("input[name='vctrabalha']").is(':checked')){
        var selectedOption = $("input:radio[name=vctrabalha]:checked").val()
      
        if(selectedOption == 1){              
            $("#panelgrp_trabalha").show();
            $("#panelgrp_transporte_trabalho").show();       
        }
        else{   
            $("#panelgrp_trabalha").hide();
            $("#panelgrp_transporte_trabalho").hide();            
        }
    }

    $("input[name='vcestuda']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
      
        if(val == 1){            
            $("#panelgrp_voce_estudante").show();
            $("#panelgrp_transporte_aula").show();  
            $("#panelgrp_perguntaensino").show();              
        }
        else{
            $("#panelgrp_voce_estudante").hide();
            $("#panelgrp_transporte_aula").hide();
            $("#panelgrp_perguntaensino").hide();
        }       
    });

    if ($("input[name='vcestuda']").is(':checked')){
        var selectedOption = $("input:radio[name=vcestuda]:checked").val()
      
        if(selectedOption == 1){              
            $("#panelgrp_voce_estudante").show();
            $("#panelgrp_transporte_aula").show();  
            $("#panelgrp_perguntaensino").show();     
        }
        else{   
            $("#panelgrp_voce_estudante").hide();
            $("#panelgrp_transporte_aula").hide();
            $("#panelgrp_perguntaensino").hide();  
        }
    }

    $("input[name='transportefilhoescola']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
      
        var vclass = ".opcao_transporte_escola";
      
        $(vclass).each(function(i, obj) {  
            // Pega as divs dos paineis opcionais         
            var obj_div = $(obj).attr('id');  
            // Esconde todas menos a selecionada
            if(val !== obj_div){
                $('#' + obj_div + vclass).hide();
            }
           
        });
        // Mostra a ativa, mantenha o nome do painel igual o ID do select
        switch(val) {
            case 'ciclista':            $(vclass +"#ciclista").show();
                break; 
            case 'onibus_1linha':       $(vclass +"#onibus1linha").show();
                break;     
            case 'onibus_2linha':       $(vclass +"#onibus2linha").show();
                break;    
            case 'carro_motorista':     $(vclass +"#carro_motorista").show();
                break;
            case 'carro_passageiro':    $(vclass +"#carro_motorista").show();
                break;
            case 'carro_taxi':          $(vclass +"#carro_taxi").show();
                break;    
            case 'carro_app':           $(vclass +"#carro_app").show();
                break;
            case 'outros':              $(vclass +"#outros").show();
                break;         
        }

    });

    if ($("input[name='transportefilhoescola']").is(':checked')){
        var selectedOption = $("input:radio[name=transportefilhoescola]:checked").val()
      
        var vclass = ".opcao_transporte_escola";
      
        $(vclass).each(function(i, obj) {  
            // Pega as divs dos paineis opcionais         
            var obj_div = $(obj).attr('id');  
            // Esconde todas menos a selecionada
            if(selectedOption !== obj_div){
                $('#' + obj_div + vclass).hide();
            }
           
        });

        // Mostra a ativa, mantenha o nome do painel igual o ID do select
        switch(selectedOption) {
            case 'ciclista':            $(vclass +"#ciclista").show();
                break; 
            case 'onibus_1linha':       $(vclass +"#onibus1linha").show();
                break;     
            case 'onibus_2linha':       $(vclass +"#onibus2linha").show();
                break;    
            case 'carro_motorista':     $(vclass +"#carro_motorista").show();
                break;
            case 'carro_passageiro':    $(vclass +"#carro_motorista").show();
                break;
            case 'carro_taxi':          $(vclass +"#carro_taxi").show();
                break;    
            case 'carro_app':           $(vclass +"#carro_app").show();
                break;
            case 'outros':              $(vclass +"#outros").show();
                break;             
        }
    }

    $("input[name='transportetrabalho']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
      
        var vclass = ".opcao_transporte_trabalho";
      
        $(vclass).each(function(i, obj) {  
            // Pega as divs dos paineis opcionais         
            var obj_div = $(obj).attr('id');  
            // Esconde todas menos a selecionada
            if(val !== obj_div){
                $('#' + obj_div + vclass).hide();
            }
           
        });
        // Mostra a ativa, mantenha o nome do painel igual o ID do select
        switch(val) {
            case 'ciclista':            $(vclass +"#ciclista").show();
                break; 
            case 'onibus_1linha':       $(vclass +"#onibus1linha").show();
                break;     
            case 'onibus_2linha':       $(vclass +"#onibus2linha").show();
                break;    
            case 'carro_motorista':     $(vclass +"#carro_motorista").show();
                break;
            case 'carro_passageiro':    $(vclass +"#carro_motorista").show();
                break;
            case 'carro_taxi':          $(vclass +"#carro_taxi").show();
                break;    
            case 'carro_app':           $(vclass +"#carro_app").show();
                break;
            case 'outros':              $(vclass +"#outros").show();
                break;            
        }

    });

    if ($("input[name='transportetrabalho']").is(':checked')){
        var selectedOption = $("input:radio[name=transportetrabalho]:checked").val()
      
        var vclass = ".opcao_transporte_trabalho";
      
        $(vclass).each(function(i, obj) {  
            // Pega as divs dos paineis opcionais         
            var obj_div = $(obj).attr('id');  
            // Esconde todas menos a selecionada
            if(selectedOption !== obj_div){
                $('#' + obj_div + vclass).hide();
            }
           
        });

        // Mostra a ativa, mantenha o nome do painel igual o ID do select
        switch(selectedOption) {
            case 'ciclista':            $(vclass +"#ciclista").show();
                break; 
            case 'onibus_1linha':       $(vclass +"#onibus1linha").show();
                break;     
            case 'onibus_2linha':       $(vclass +"#onibus2linha").show();
                break;    
            case 'carro_motorista':     $(vclass +"#carro_motorista").show();
                break;
            case 'carro_passageiro':    $(vclass +"#carro_motorista").show();
                break;
            case 'carro_taxi':          $(vclass +"#carro_taxi").show();
                break;    
            case 'carro_app':           $(vclass +"#carro_app").show();
                break;
            case 'outros':              $(vclass +"#outros").show();
                break;              
        }
    }

    $("input[name='transporteaula']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
           
        var vclass = ".opcao_transporte_aula";
      
        $(vclass).each(function(i, obj) {  
            // Pega as divs dos paineis opcionais         
            var obj_div = $(obj).attr('id');  
            // Esconde todas menos a selecionada
            if(val !== obj_div){
                $('#' + obj_div + vclass).hide();
            }
           
        });
        // Mostra a ativa, mantenha o nome do painel igual o ID do select
        switch(val) {
            case 'ciclista':            $(vclass +"#ciclista").show();
                break; 
            case 'onibus_1linha':       $(vclass +"#onibus1linha").show();
                break;     
            case 'onibus_2linha':       $(vclass +"#onibus2linha").show();
                break;    
            case 'carro_motorista':     $(vclass +"#carro_motorista").show();
                break;
            case 'carro_passageiro':    $(vclass +"#carro_motorista").show();
                break;
            case 'carro_taxi':          $(vclass +"#carro_taxi").show();
                break;    
            case 'carro_app':           $(vclass +"#carro_app").show();
                break;
            case 'outros':              $(vclass +"#outros").show();
                break;              
        }

    });

    if ($("input[name='transporteaula']").is(':checked')){
        var selectedOption = $("input:radio[name=transporteaula]:checked").val()
      
        var vclass = ".opcao_transporte_aula";
      
        $(vclass).each(function(i, obj) {  
            // Pega as divs dos paineis opcionais         
            var obj_div = $(obj).attr('id');  
            // Esconde todas menos a selecionada
            if(selectedOption !== obj_div){
                $('#' + obj_div + vclass).hide();
            }
           
        });

        // Mostra a ativa, mantenha o nome do painel igual o ID do select
        switch(selectedOption) {
            case 'ciclista':            $(vclass +"#ciclista").show();
                break; 
            case 'onibus_1linha':       $(vclass +"#onibus1linha").show();
                break;     
            case 'onibus_2linha':       $(vclass +"#onibus2linha").show();
                break;    
            case 'carro_motorista':     $(vclass +"#carro_motorista").show();
                break;
            case 'carro_passageiro':    $(vclass +"#carro_motorista").show();
                break;
            case 'carro_taxi':          $(vclass +"#carro_taxi").show();
                break;    
            case 'carro_app':           $(vclass +"#carro_app").show();
                break;
            case 'outros':              $(vclass +"#outros").show();
                break;                                          
        }
    }
    
    $('#cep').mask('99999-999');   
    $('#cep_trabalho').mask('99999-999');   

    $("#cep, #rua, #bairro, #cidade, #estado").blur(function() {
        var val = $(this).val();

        setTimeout(
            function() 
            {              
                var rua     = $('#rua').val();
                var bairro  = $('#bairro').val();
                var cidade  = $('#cidade').val();
                var estado  = $('#estado').select2().val(); 

                var geocoder = rua+','+cidade+'-'+estado;
                $('#geocoder').val(geocoder); 

                tipo = 'home';

                // Apenas o INPUT do geo
                geocode_Input(geocoder, tipo);
                // Geocoder com Marcador
                //geocode_Marker(geocoder);
                  
            }, 2000);           
    });

    $("#cep_trabalho, #rua_trabalho, #bairro_trabalho, #cidade_trabalho, #estado_trabalho").blur(function() {
        var val = $(this).val();

        setTimeout(
            function() 
            {              
                var rua_trabalho    = $('#rua_trabalho').val();
                var bairro_trabalho = $('#bairro_trabalho').val();
                var cidade_trabalho = $('#cidade_trabalho').val();
                var estado_trabalho = $('#estado_trabalho').select2().val(); 

                var geocoder = rua_trabalho+','+cidade_trabalho+'-'+estado_trabalho;
                $('#geocoder_trabalho').val(geocoder); 

                tipo = 'trabalho';
                
                // Apenas o INPUT do geo
                geocode_Input(geocoder, tipo);
                // Geocoder com Marcador
                //geocode_Marker(geocoder);
            }, 2000);           
    });
    
    $("#cep").blur(function() {
        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#estado").val("...");
               
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#estado").val(dados.uf);         
                        $('#estado').select2().trigger('change');     
                        
                        var geocoder = dados.logradouro+','+dados.localidade+'-'+dados.uf;
                        //console.log(geocoder);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    $("#cep_trabalho").blur(function() {
        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua_trabalho").val("...");
                $("#bairro_trabalho").val("...");
                $("#cidade_trabalho").val("...");
                $("#estado_trabalho").val("...");
               
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua_trabalho").val(dados.logradouro);
                        $("#bairro_trabalho").val(dados.bairro);
                        $("#cidade_trabalho").val(dados.localidade);
                        $("#estado_trabalho").val(dados.uf);         
                        $('#estado_trabalho').select2().trigger('change');           
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep_trabalho();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep_trabalho();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep_trabalho();
        }
    });

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");       
    }

    function limpa_formulário_cep_trabalho() {
        // Limpa valores do formulário de cep.
        $("#rua_trabalho").val("");
        $("#bairro_trabalho").val("");
        $("#cidade_trabalho").val("");
        $("#estado_trabalho").val("");       
    }

    // Geocoder que preenche Inputs
    function geocode_Input(endereco, tipo){
        var key1 = 'gVjrAmR56Ko4N40dvuYy';   

        $.ajax({
            url: "https://geocoder.tilehosting.com/br/q/["+endereco+"].js?key="+key1
            //url: "https://geocoder.tilehosting.com/br/q/["+endereco+"].js?key="+key1  
        }).then(function(data) {       
            jQuery.each(data.results, function(index, itemData) {
            //geocode_Debug(index,itemData);

            latitude    = itemData.lat;
            longitude   = itemData.lon;
                                  
            if(!testa_empty(latitude) && !testa_empty(longitude)){   
                var coords = new L.LatLng(latitude, longitude);                                        
                var existe_riogrande = max_bounds.contains(coords);
                
                // Se existe dentro do BoundBox de RG

                /*
                //Boundbox de RG 
                let sudoeste = L.latLng(-32.6625, -52.697222222222216),
                    nordeste = L.latLng(-31.78388888888889, -52.06388888888888),
                    max_bounds = L.latLngBounds(sudoeste, nordeste);
                */

                if(existe_riogrande){    
                    if(tipo == 'home'){                                   
                        if ($("#latitude").length){ 
                            $("#latitude").val(latitude);
                        }
                        if ($("#longitude").length){ 
                            $("#longitude").val(longitude);                    
                        }
                        coords_Marker(coords, 'casa', 'home'); 
                    }   
                    if(tipo == 'trabalho'){                       
                        if ($("#latitude_trabalho").length){ 
                            $("#latitude_trabalho").val(latitude);
                        }
                        if ($("#longitude_trabalho").length){ 
                            $("#longitude_trabalho").val(longitude);                    
                        }
                        coords_Marker(coords, 'trabalho', 'briefcase'); 
                    }                
                }
            }        
        });  
    });
    }

    function coords_Marker(coords, tipo = 'casa', icone = 'home'){          
        // Se existe nos bounds de Rio Grande                                                
        var existe_riogrande = max_bounds.contains(coords);
       
        if(existe_riogrande){        
            // Cria um Marcador           
            var pin = addMarker(coords.lat, coords.lng, 'Marcador', icone);
            // Adiciona marcador ao markercluster
            markers.addLayer(pin);
            // Adiciona o markercluster ao mapa
            map.addLayer(markers);
            // Ajusta Bounds em torno do marcador
            ajustaBounds();

            // Se precisa desligar funções do map como se deslocar
            //freeze_map(true);
    
            // Leaflet PIP
            geocode_PIP(coords, tipo);        
        }
    }

    // Geocoder que adiciona marcadores
    function geocode_Marker(endereco){
        markers.clearLayers();
        var key1 = 'gVjrAmR56Ko4N40dvuYy';   

        $.ajax({
            url: "https://geocoder.tilehosting.com/br/q/["+endereco+"].js?key="+key1
            //url: "https://geocoder.tilehosting.com/br/q/["+endereco+"].js?key="+key1  
        }).then(function(data) {            
            jQuery.each(data.results, function(index, itemData) {
            //geocode_Debug(index,itemData);

            latitude    = itemData.lat;
            longitude   = itemData.lon;

            var titulo = 'PONTO';
            var naotemponto = true;
                        
            var coords = new L.LatLng(latitude, longitude);

            if(naotemponto){
            if(!testa_empty(latitude) && !testa_empty(longitude)){                                           
                var existe_riogrande = max_bounds.contains(coords);
                
                if(existe_riogrande){                  
                    var pin = addMarker(latitude, longitude, titulo);
                    markers.addLayer(pin);
                    map.addLayer(markers);

                    naotemponto = false;

                    ajustaBounds();
                    freeze_map(true);                                       
                }
            }
        }
        // FIM temponto
        });  
    });
    }

    function geocode_PIP(coords, tipo){  
        polygons.eachLayer(function(layer){
            var pointlayer = leafletPip.pointInLayer(coords, layer, true);
    
            if(!testa_empty(pointlayer)){                             
                var pdm  = pointlayer[0].options.title;        
                
                if(tipo == 'casa'){                                   
                    if ($("#pdm").length){ 
                        $("#pdm").val(pdm);
                    }                   
                }   
                if(tipo == 'trabalho'){                       
                    if ($("#pdm_trabalho").length){ 
                        $("#pdm_trabalho").val(pdm);
                    } 
                }                     
            }    
        });
    }

    function geocode_Debug(index, itemData){   
        console.log(itemData);    
        console.log(itemData.lat);
        console.log(itemData.lon);
    }

    function addMarker(lat, lng, titulo, icone){
        //Icone      
        var formato = 'circle';              
        var css = 'font-size: 20px; margin-top: -6px; margin-left: -6px';    
        var icone = icone;
        var cor = 'red';  
    
        var icone_mapa = getBeautifyIcon(formato, icone, cor, css); 
        var coords = new L.LatLng(lat, lng);
    
        var marker = new Pin(1, titulo, coords, icone_mapa );                               
        marker.bindPopup(titulo);
    
        return marker;       
    }

    function carregarPDM() {      
        $.ajax({
            url: dir_base + 'admin/questionario/getPoligonos',
            success: function(data) {     
                $.each(data, function(index, value) {           
                    var id = value.id;
                    var nome_unidade = value.titulo;        
                    var geojson = JSON.parse(value.poligono);
    
                    var r = Math.floor(Math.random() * 256); 
                    var g = Math.floor(Math.random() * 256); 
                    var b = Math.floor(Math.random() * 256); 

                    // Override no Nome do GeoJSON
                    geojson.properties.name = nome_unidade;
                    
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

    setTimeout(function() {
        carregarPDM();
    }, 1000);
});