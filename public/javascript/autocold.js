$(document).ready(function(){
//alert('AUTOC');

$("input[name='faixaetaria']").on("propertychange change click keyup input paste blur", function(){
    console.log("yeh thats worked!");
});

function auto_faixaidade(){
    var faixaetaria = new Array();

    $("input[name='faixaetaria']").each(function(){       
        //console.log($(this).val());
        faixaetaria.push($(this).val());   
    });

    var i = Math.floor(Math.random() * faixaetaria.length); 
    var v = faixaetaria[i];
    //console.log(v);

    $("input[name='faixaetaria']").val([v]);
}

function auto_familiar(){
    var familiar = new Array();

    $("input[name='familiar']").each(function(){       
        //console.log($(this).val());
        familiar.push($(this).val());   
    });

    var i = Math.floor(Math.random() * familiar.length); 
    var v = familiar[i];
    //console.log(v);

    $("input[name='familiar']").val([v]);
}

function auto_deficiente(){
    var deficiente = new Array();

    $("input[name='deficiente']").each(function(){       
        //console.log($(this).val());
        deficiente.push($(this).val());   
    });
    
    var i = Math.floor(Math.random() * deficiente.length); 
    var v = deficiente[i];
    //console.log(v);

    $("input[name='deficiente']").val([v]);
   
    if(v == 1){         
        $("#panelgrp_deficiencias").show();
    }
    else{
        $("#panelgrp_deficiencias").hide();
    }       
}

function auto_deficiencias(){
    var deficiencias = new Array();

    $("input[name='deficiencias[]']").each(function(){       
        //console.log($(this).val());
        deficiencias.push($(this).val());   
    });
    
    var f = Math.floor(Math.random() * 4); 

    for(var c = 0 ; c <= f ; c++){
        var i = Math.floor(Math.random() * deficiencias.length);  
        var v = deficiencias[i];
       
        $("input[name='deficiencias[]'][value="+v+"]").prop("checked",true);
    }    
}

function auto_sexo(){
    var sexo = new Array();

    $("input[name='sexo']").each(function(){       
        //console.log($(this).val());
        sexo.push($(this).val());   
    });

    var i = Math.floor(Math.random() * sexo.length); 
    var v = sexo[i];
    //console.log(v);

    $("input[name='sexo']").val([v]);
}

function auto_temveiculo(){
    var temveiculo = new Array();

    $("input[name='temveiculo']").each(function(){       
        //console.log($(this).val());
        temveiculo.push($(this).val());   
    });

    var i = Math.floor(Math.random() * temveiculo.length); 
    var v = temveiculo[i];
    //console.log(v);

    if(v == 1){
        $("#panelgrp_qtdveiculo").show();
        $("#panel_qtdveiculo").show();
    }
    else{
        $("#panelgrp_qtdveiculo").hide();
        $("#panel_qtdveiculo").hide();
    }

    $("input[name='temveiculo']").val([v]);
}

function auto_qtdveiculos(){
    var qtdveiculos = new Array();

    $("input[name='qtdveiculos']").each(function(){       
        //console.log($(this).val());
        qtdveiculos.push($(this).val());   
    });

    var i = Math.floor(Math.random() * qtdveiculos.length); 
    var v = qtdveiculos[i];
    //console.log(v);

    $("input[name='qtdveiculos']").val([v]);
}

function auto_tembicicleta(){
    var tembicicleta = new Array();

    $("input[name='tembicicleta']").each(function(){       
        //console.log($(this).val());
        tembicicleta.push($(this).val());   
    });

    var i = Math.floor(Math.random() * tembicicleta.length); 
    var v = tembicicleta[i];
    //console.log(v);

    if(v == 1){
        $("#panelgrp_qtdbike").show();
        $("#panel_qtdbike").show();
    }
    else{
        $("#panelgrp_qtdbike").hide();
        $("#panel_qtdbike").hide();
    }

    $("input[name='tembicicleta']").val([v]);
}

function auto_qtdbikes(){
    var qtdbikes = new Array();

    $("input[name='qtdbikes']").each(function(){       
        //console.log($(this).val());
        qtdbikes.push($(this).val());   
    });

    var i = Math.floor(Math.random() * qtdbikes.length); 
    var v = qtdbikes[i];
    //console.log(v);

    $("input[name='qtdbikes']").val([v]);
}

function auto_temfilhoestudante(){
    var temfilhoestudante = new Array();

    $("input[name='temfilhoestudante']").each(function(){       
        //console.log($(this).val());
        temfilhoestudante.push($(this).val());   
    });

    var i = Math.floor(Math.random() * temfilhoestudante.length); 
    var v = temfilhoestudante[i];
    //console.log(v);

    $("input[name='temfilhoestudante']").val([v]);

    if(v == 1){
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

function auto_qtdfilhos(){
    var qtdfilhos = new Array();

    $("input[name='qtdfilhos']").each(function(){       
        //console.log($(this).val());
        qtdfilhos.push($(this).val());   
    });

    var i = Math.floor(Math.random() * qtdfilhos.length); 
    var v = qtdfilhos[i];
    //console.log(v);

    var escolas = getEscola();
    
    $("input[name='qtdfilhos']").val([v]);
    $("input[name='qtdfilhos']").blur();
    
    for(var i = 1 ; i<= 10; i++){         
        var id_div = 'escolafilho'+i;

        if( i <= v){
            $('#' + id_div).show();
            var j = Math.floor(Math.random() * escolas.length);              
            var escola =escolas[j].value;     
           
            $("input[name='escolafilho["+i+"]']").val(escola);
        } 
        else{   
            $('#' + id_div).hide();     
        } 
    }
}

function auto_transportefilhoescola(){
    var transportefilhoescola = new Array();

    $("input[name='transportefilhoescola']").each(function(){       
        //console.log($(this).val());
        transportefilhoescola.push($(this).val());   
    });

    var i = Math.floor(Math.random() * transportefilhoescola.length); 
    var v = transportefilhoescola[i];
    //console.log(v);

    $("input[name='transportefilhoescola']").val([v]);

    var vclass = ".opcao_transporte_escola";

    switch(v) {
        case 'ciclista':            $(vclass +"#ciclista").show();
                                    auto_localbikefilho();
                                    break; 
        case 'onibus_1linha':       $(vclass +"#onibus1linha").show();
                                    auto_onibus1linhafilho();
                                    break;     
        case 'onibus_2linha':       $(vclass +"#onibus2linha").show();
                                    auto_onibus2linhafilho();
                                    break;    
        case 'carro_motorista':     $(vclass +"#carro_motorista").show();
                                    auto_localcarrofilho();
                                    break;
        case 'carro_passageiro':    $(vclass +"#carro_motorista").show();
                                    auto_localcarrofilho();
                                    break;
        case 'carro_taxi':          $(vclass +"#carro_taxi").show();
                                    auto_apptaxifilho();
                                    break;    
        case 'carro_app':           $(vclass +"#carro_app").show();
                                    auto_apptranspfilho();
                                    break;
        case 'outros':              $(vclass +"#outros").show();
                                    auto_outrotranspfilho();
                                    break;         
    }
}

function auto_localbikefilho(){
    var localbikefilho = new Array();

    $("input[name='localbikefilho']").each(function(){       
        //console.log($(this).val());
        localbikefilho.push($(this).val());   
    });

    var i = Math.floor(Math.random() * localbikefilho.length); 
    var v = localbikefilho[i];
    console.log(v);

    $("input[name='localbikefilho']").val([v]);
}

function auto_onibus1linhafilho(){
    var tempoonibusfilho1 = new Array();

    $("input[name='tempoonibusfilho1']").each(function(){       
        //console.log($(this).val());
        tempoonibusfilho1.push($(this).val());   
    });

    var i = Math.floor(Math.random() * tempoonibusfilho1.length); 
    var v = tempoonibusfilho1[i];
    //console.log(v);

    var gstr = makeid(10);

    $("input[name='tempoonibusfilho1']").val([v]);

    $("input[name='linhaonibusfilho']").val([gstr]);
}

function auto_onibus2linhafilho(){
    var tempoonibusfilho2 = new Array();

    $("input[name='tempoonibusfilho2']").each(function(){       
        //console.log($(this).val());
        tempoonibusfilho2.push($(this).val());   
    });

    var i = Math.floor(Math.random() * tempoonibusfilho2.length); 
    var v = tempoonibusfilho2[i];
   
    $("input[name='tempoonibusfilho2']").val([v]);

    var gstr1 = makeid(10);
    $("input[name='linhaonibus1filho']").val([gstr1]);
    var gstr2 = makeid(10);
    $("input[name='linhaonibus2filho']").val([gstr2]);
    var gstr3 = makeid(10);
    $("input[name='trocalinhaonibusfilho']").val([gstr3]);
}

function auto_localcarrofilho(){
    var localcarrofilho = new Array();

    $("input[name='localcarrofilho']").each(function(){       
        //console.log($(this).val());
        localcarrofilho.push($(this).val());   
    });

    var i = Math.floor(Math.random() * localcarrofilho.length); 
    var v = localcarrofilho[i];
   
    $("input[name='localcarrofilho']").val([v]);
}

function auto_apptaxifilho(){
    var apptaxifilho = new Array();

    $("input[name='apptaxifilho']").each(function(){       
        //console.log($(this).val());
        apptaxifilho.push($(this).val());   
    });

    var i = Math.floor(Math.random() * apptaxifilho.length); 
    var v = apptaxifilho[i];
    //console.log(v);

    $("input[name='apptaxifilho']").val([v]);
}

function auto_apptranspfilho(){
    var gstr1 = makeid(10);
    $("input[name='apptranspfilho']").val([gstr1]);
}

function auto_outrotranspfilho(){
    var gstr1 = makeid(10);
    $("input[name='outrotranspfilho']").val([gstr1]);
}

function auto_transportetrabalho(){
    var transportetrabalho = new Array();

    $("input[name='transportetrabalho']").each(function(){       
        //console.log($(this).val());
        transportetrabalho.push($(this).val());   
    });

    var i = Math.floor(Math.random() * transportetrabalho.length); 
    var v = transportetrabalho[i];
    //console.log(v);

    $("input[name='transportetrabalho']").val([v]);

    var vclass = ".opcao_transporte_trabalho";

    switch(v) {
        case 'ciclista':            $(vclass +"#ciclista").show();
                                    auto_localbiketrabalho();
                                    break; 
        case 'onibus_1linha':       $(vclass +"#onibus1linha").show();
                                    auto_onibus1linhatrabalho();
                                    break;     
        case 'onibus_2linha':       $(vclass +"#onibus2linha").show();
                                    auto_onibus2linhatrabalho();
                                    break;    
        case 'carro_motorista':     $(vclass +"#carro_motorista").show();
                                    auto_localcarrotrabalho();
                                    break;
        case 'carro_passageiro':    $(vclass +"#carro_motorista").show();
                                    auto_localcarrotrabalho();
                                    break;
        case 'carro_taxi':          $(vclass +"#carro_taxi").show();
                                    auto_apptaxitrabalho();
                                    break;    
        case 'carro_app':           $(vclass +"#carro_app").show();
                                    auto_apptransptrabalho();
                                    break;
        case 'outros':              $(vclass +"#outros").show();
                                    auto_outrotransptrabalho();
                                    break;         
    }
}

function auto_localbiketrabalho(){
    var localbiketrabalho = new Array();

    $("input[name='localbiketrabalho']").each(function(){       
        //console.log($(this).val());
        localbiketrabalho.push($(this).val());   
    });

    var i = Math.floor(Math.random() * localbiketrabalho.length); 
    var v = localbiketrabalho[i];
    //console.log(v);

    $("input[name='localbiketrabalho']").val([v]);
}

function auto_onibus1linhatrabalho(){
    var tempoonibustrabalho1 = new Array();

    $("input[name='tempoonibustrabalho1']").each(function(){       
        //console.log($(this).val());
        tempoonibustrabalho1.push($(this).val());   
    });

    var i = Math.floor(Math.random() * tempoonibustrabalho1.length); 
    var v = tempoonibustrabalho1[i];
    //console.log(v);

    var gstr = makeid(10);

    $("input[name='tempoonibustrabalho1']").val([v]);

    $("input[name='linhaonibustrabalho']").val([gstr]);
}

function auto_onibus2linhatrabalho(){
    var tempoonibustrabalho2 = new Array();

    $("input[name='tempoonibustrabalho2']").each(function(){       
        //console.log($(this).val());
        tempoonibustrabalho2.push($(this).val());   
    });

    var i = Math.floor(Math.random() * tempoonibustrabalho2.length); 
    var v = tempoonibustrabalho2[i];
   
    $("input[name='tempoonibustrabalho2']").val([v]);

    var gstr1 = makeid(10);
    $("input[name='linhaonibus1trabalho']").val([gstr1]);
    var gstr2 = makeid(10);
    $("input[name='linhaonibus2trabalho']").val([gstr2]);
    var gstr3 = makeid(10);
    $("input[name='trocalinhaonibustrabalho']").val([gstr3]);
}

function auto_localcarrotrabalho(){
    var localcarrotrabalho = new Array();

    $("input[name='localcarrotrabalho']").each(function(){       
        //console.log($(this).val());
        localcarrotrabalho.push($(this).val());   
    });

    var i = Math.floor(Math.random() * localcarrotrabalho.length); 
    var v = localcarrotrabalho[i];
   
    $("input[name='localcarrotrabalho']").val([v]);
}

function auto_apptaxitrabalho(){
    var apptaxitrabalho = new Array();

    $("input[name='apptaxitrabalho']").each(function(){       
        //console.log($(this).val());
        apptaxitrabalho.push($(this).val());   
    });

    var i = Math.floor(Math.random() * apptaxitrabalho.length); 
    var v = apptaxitrabalho[i];
    //console.log(v);

    $("input[name='apptaxitrabalho']").val([v]);
}

function auto_apptransptrabalho(){
    var gstr1 = makeid(10);
    $("input[name='apptransptrabalho']").val([gstr1]);
}

function auto_outrotransptrabalho(){
    var gstr1 = makeid(10);
    $("input[name='outrotransptrabalho']").val([gstr1]);
}

function auto_rendafamiliar(){
    var rendafamiliar = new Array();

    $("input[name='rendafamiliar']").each(function(){       
        //console.log($(this).val());
        rendafamiliar.push($(this).val());   
    });

    var i = Math.floor(Math.random() * rendafamiliar.length); 
    var v = rendafamiliar[i];
    //console.log(v);

    $("input[name='rendafamiliar']").val([v]);
}

function auto_vctrabalha(){
    var vctrabalha = new Array();

    $("input[name='vctrabalha']").each(function(){       
        //console.log($(this).val());
        vctrabalha.push($(this).val());   
    });

    var i = Math.floor(Math.random() * vctrabalha.length); 
    var v = vctrabalha[i];
    //console.log(v);
    
    $("input[name='vctrabalha']").val([v]);

    if(v == 1){
        $("#panelgrp_trabalha").show();
        $("#panelgrp_transporte_trabalho").show();            
    }
    else{
        $("#panelgrp_trabalha").hide();
        $("#panelgrp_transporte_trabalho").hide();            
    }    
}

function auto_cep(){    
    //var cep1 = generateRandomInteger(96200,96224);
    //var cep2 = generateRandomInteger(001,999);   
    //var cep2 = leftPad(cep2, 3);
    //var cep = cep1 + ' - '+cep2; 

    var n = generateRandomInteger(001,999);  

    var cep = cep_riogrande[Math.floor(Math.random() * cep_riogrande.length)];
   
    $("input[name='cep']").val(cep);    
    $("input[name='cep']").blur();  

    setTimeout(function() {
        if(!testa_empty($("input[name='rua']").val())){
            var rua = $("input[name='rua']").val();   
            //$("input[name='rua']").val(rua+', '+n);
            $("input[name='rua']").val(rua);
        }  
    }, 1000);
   
}

function auto_cep_trabalho(){    
    //var cep1 = generateRandomInteger(96200,96224);
    //var cep2 = generateRandomInteger(001,999);   
    //var cep2 = leftPad(cep2, 3);
    //var cep = cep1 + ' - '+cep2; 

    var n = generateRandomInteger(001,999);  
    
    var ceptrabalho = cep_riogrande[Math.floor(Math.random() * cep_riogrande.length)];
       
    $("input[name='cep_trabalho']").val(ceptrabalho);    
    $("input[name='cep_trabalho']").blur();  

    setTimeout(function() {
        if(!testa_empty($("input[name='rua_trabalho']").val())){
            var ruatrabalho = $("input[name='rua_trabalho']").val();   
            //$("input[name='rua_trabalho']").val(rua_t+', '+n);
            $("input[name='rua_trabalho']").val(ruatrabalho);
        }  
    }, 1000);
   
}

function auto_ocupacao(){
    var ocupacao = new Array();

    $("input[name='ocupacao']").each(function(){       
        //console.log($(this).val());
        ocupacao.push($(this).val());   
    });

    var i = Math.floor(Math.random() * ocupacao.length); 
    var v = ocupacao[i];
    //console.log(v);

    $("input[name='ocupacao']").val([v]);
}

function auto_horario(){
    var v = generateRandomInteger(1,6);

    var m1 = generateHora('manha');
    var m2 = generateHora('manha');

    var t1 = generateHora('tarde');
    var t2=  generateHora('tarde');

    var n1 = generateHora('noite');
    var n2 = generateHora('noite');

    switch(v) {
        case 1:             $("input[name='trabalho_manha']").prop("checked",true);                           
                            $("#trabalho_manha_inicio").show();
                            $("#trabalho_manha_termino").show();
                            $("input[name='trabalho_manha_inicio']").val([m1]);
                            $("input[name='trabalho_manha_termino']").val([m2]);               
                            break;
        case 2:             $("input[name='trabalho_tarde']").prop("checked",true);                            
                            $("#trabalho_tarde_inicio").show();
                            $("#trabalho_tarde_termino").show();
                            $("input[name='trabalho_tarde_inicio']").val([t1]);
                            $("input[name='trabalho_tarde_termino']").val([t2]);     
                            break;
        case 3:             $("input[name='trabalho_noite']").prop("checked",true);                          
                            $("#trabalho_noite_inicio").show();
                            $("#trabalho_noite_termino").show();
                            $("input[name='trabalho_noite_inicio']").val([n1]);
                            $("input[name='trabalho_noite_termino']").val([n2]);     
                            break;
        case 4:             $("input[name='trabalho_manha']").prop("checked",true);
                            $("input[name='trabalho_tarde']").prop("checked",true);
                            $("#trabalho_manha_inicio").show();
                            $("#trabalho_manha_termino").show();
                            $("input[name='trabalho_manha_inicio']").val([m1]);
                            $("input[name='trabalho_manha_termino']").val([m2]);   
                            $("#trabalho_tarde_inicio").show();
                            $("#trabalho_tarde_termino").show();
                            $("input[name='trabalho_tarde_inicio']").val([t1]);
                            $("input[name='trabalho_tarde_termino']").val([t2]);        
                            break;
        case 5:             $("input[name='trabalho_tarde']").prop("checked",true);
                            $("input[name='trabalho_noite']").prop("checked",true);
                            $("#trabalho_tarde_inicio").show();
                            $("#trabalho_tarde_termino").show();
                            $("input[name='trabalho_tarde_inicio']").val([t1]);
                            $("input[name='trabalho_tarde_termino']").val([t2]);    
                            $("#trabalho_noite_inicio").show();
                            $("#trabalho_noite_termino").show();
                            $("input[name='trabalho_noite_inicio']").val([n1]);
                            $("input[name='trabalho_noite_termino']").val([n2]);     
                            break;      
        case 6:             $("input[name='trabalho_manha']").prop("checked",true);
                            $("input[name='trabalho_tarde']").prop("checked",true);
                            $("input[name='trabalho_noite']").prop("checked",true);
                            $("#trabalho_manha_inicio").show();
                            $("#trabalho_manha_termino").show();
                            $("input[name='trabalho_manha_inicio']").val([m1]);
                            $("input[name='trabalho_manha_termino']").val([m2]);      
                            $("#trabalho_tarde_inicio").show();
                            $("#trabalho_tarde_termino").show();
                            $("input[name='trabalho_tarde_inicio']").val([t1]);
                            $("input[name='trabalho_tarde_termino']").val([t2]);   
                            $("input[name='trabalho_noite']").prop("checked",true);                          
                            $("#trabalho_noite_inicio").show();
                            $("#trabalho_noite_termino").show();
                            $("input[name='trabalho_noite_inicio']").val([n1]);
                            $("input[name='trabalho_noite_termino']").val([n2]);       
                            break;                               
    }
}

function auto_localsaidatrabalho(){
    var localsaidatrabalho = new Array();

    $("input[name='localsaidatrabalho']").each(function(){       
        //console.log($(this).val());
        localsaidatrabalho.push($(this).val());   
    });

    var i = Math.floor(Math.random() * localsaidatrabalho.length); 
    var v = localsaidatrabalho[i];
    //console.log(v);

    $("input[name='localsaidatrabalho']").val([v]);
}

function auto_tempodeslocamentotrabalho(){
    var tempodeslocamentotrabalho = new Array();

    $("input[name='tempodeslocamentotrabalho']").each(function(){       
        //console.log($(this).val());
        tempodeslocamentotrabalho.push($(this).val());   
    });

    var i = Math.floor(Math.random() * tempodeslocamentotrabalho.length); 
    var v = tempodeslocamentotrabalho[i];
    //console.log(v);

    $("input[name='tempodeslocamentotrabalho']").val([v]);
    
}

function auto_vcestuda(){
    var vcestuda = new Array();

    $("input[name='vcestuda']").each(function(){       
        //console.log($(this).val());
        vcestuda.push($(this).val());   
    });

    var i = Math.floor(Math.random() * vcestuda.length); 
    var v = vcestuda[i];  
    //console.log(v);

    $("input[name='vcestuda']").val([v]);

    if(v == 1){            
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

function auto_localensino(){
    var localensino = new Array();

    $("input[name='localensino']").each(function(){       
        //console.log($(this).val());
        localensino.push($(this).val());   
    });

    var i = Math.floor(Math.random() * localensino.length); 
    var v = localensino[i];
    //console.log(v);

    $("input[name='localensino']").val([v]);
}

function auto_escolavcestuda(){
    var gstr1 = makeid(10);
    $("input[name='escolavcestuda']").val([gstr1]);
}

function auto_nivelensino(){
    var nivelensino = new Array();

    $("input[name='nivelensino']").each(function(){       
        //console.log($(this).val());
        nivelensino.push($(this).val());   
    });

    var i = Math.floor(Math.random() * nivelensino.length); 
    var v = nivelensino[i];
    //console.log(v);

    $("input[name='nivelensino']").val([v]);
}

function auto_horario_aula(){
    var v = generateRandomInteger(1,6);

    var m1 = generateHora('manha');
    var m2 = generateHora('manha');

    var t1 = generateHora('tarde');
    var t2=  generateHora('tarde');

    var n1 = generateHora('noite');
    var n2 = generateHora('noite');

    switch(v) {
        case 1:             $("input[name='aula_manha']").prop("checked",true);                           
                            $("#aula_manha_inicio").show();
                            $("#aula_manha_termino").show();
                            $("input[name='aula_manha_inicio']").val([m1]);
                            $("input[name='aula_manha_termino']").val([m2]);               
                            break;
        case 2:             $("input[name='aula_tarde']").prop("checked",true);                            
                            $("#aula_tarde_inicio").show();
                            $("#aula_tarde_termino").show();
                            $("input[name='aula_tarde_inicio']").val([t1]);
                            $("input[name='aula_tarde_termino']").val([t2]);     
                            break;
        case 3:             $("input[name='aula_noite']").prop("checked",true);                          
                            $("#aula_noite_inicio").show();
                            $("#aula_noite_termino").show();
                            $("input[name='aula_noite_inicio']").val([n1]);
                            $("input[name='aula_noite_termino']").val([n2]);     
                            break;
        case 4:             $("input[name='aula_manha']").prop("checked",true);
                            $("input[name='aula_tarde']").prop("checked",true);
                            $("#aula_manha_inicio").show();
                            $("#aula_manha_termino").show();
                            $("input[name='aula_manha_inicio']").val([m1]);
                            $("input[name='aula_manha_termino']").val([m2]);   
                            $("#aula_tarde_inicio").show();
                            $("#aula_tarde_termino").show();
                            $("input[name='aula_tarde_inicio']").val([t1]);
                            $("input[name='aula_tarde_termino']").val([t2]);        
                            break;
        case 5:             $("input[name='aula_tarde']").prop("checked",true);
                            $("input[name='aula_noite']").prop("checked",true);
                            $("#aula_tarde_inicio").show();
                            $("#aula_tarde_termino").show();
                            $("input[name='aula_tarde_inicio']").val([t1]);
                            $("input[name='aula_tarde_termino']").val([t2]);    
                            $("#aula_noite_inicio").show();
                            $("#aula_noite_termino").show();
                            $("input[name='aula_noite_inicio']").val([n1]);
                            $("input[name='aula_noite_termino']").val([n2]);     
                            break;      
        case 6:             $("input[name='aula_manha']").prop("checked",true);
                            $("input[name='aula_tarde']").prop("checked",true);
                            $("input[name='aula_noite']").prop("checked",true);
                            $("#aula_manha_inicio").show();
                            $("#aula_manha_termino").show();
                            $("input[name='aula_manha_inicio']").val([m1]);
                            $("input[name='aula_manha_termino']").val([m2]);      
                            $("#aula_tarde_inicio").show();
                            $("#aula_tarde_termino").show();
                            $("input[name='aula_tarde_inicio']").val([t1]);
                            $("input[name='aula_tarde_termino']").val([t2]);   
                            $("input[name='aula_noite']").prop("checked",true);                          
                            $("#aula_noite_inicio").show();
                            $("#aula_noite_termino").show();
                            $("input[name='aula_noite_inicio']").val([n1]);
                            $("input[name='aula_noite_termino']").val([n2]);       
                            break;                               
    }
  
}

function auto_transporteaula(){
    var transporteaula = new Array();

    $("input[name='transporteaula']").each(function(){       
        //console.log($(this).val());
        transporteaula.push($(this).val());   
    });

    var i = Math.floor(Math.random() * transporteaula.length); 
    var v = transporteaula[i];
    //console.log(v);

    $("input[name='transporteaula']").val([v]);

    var vclass = ".opcao_transporte_aula";

    switch(v) {
        case 'ciclista':            $(vclass +"#ciclista").show();
                                    auto_localbikeaula();
                                    break; 
        case 'onibus_1linha':       $(vclass +"#onibus1linha").show();
                                    auto_onibus1linhaaula();
                                    break;     
        case 'onibus_2linha':       $(vclass +"#onibus2linha").show();
                                    auto_onibus2linhaaula();
                                    break;    
        case 'carro_motorista':     $(vclass +"#carro_motorista").show();
                                    auto_localcarroaula();
                                    break;
        case 'carro_passageiro':    $(vclass +"#carro_motorista").show();
                                    auto_localcarroaula();
                                    break;
        case 'carro_taxi':          $(vclass +"#carro_taxi").show();
                                    auto_apptaxiaula();
                                    break;    
        case 'carro_app':           $(vclass +"#carro_app").show();
                                    auto_apptranspaula();
                                    break;
        case 'outros':              $(vclass +"#outros").show();
                                    auto_outrotranspaula();
                                    break;         
    }
}


function auto_localbikeaula(){
    var localbikeaula = new Array();

    $("input[name='localbikeaula']").each(function(){       
        //console.log($(this).val());
        localbikeaula.push($(this).val());   
    });

    var i = Math.floor(Math.random() * localbikeaula.length); 
    var v = localbikeaula[i];
    //console.log(v);

    $("input[name='localbikeaula']").val([v]);
}

function auto_onibus1linhaaula(){
    var tempoonibusaula1 = new Array();

    $("input[name='tempoonibusaula1']").each(function(){       
        //console.log($(this).val());
        tempoonibusaula1.push($(this).val());   
    });

    var i = Math.floor(Math.random() * tempoonibusaula1.length); 
    var v = tempoonibusaula1[i];
    //console.log(v);

    var gstr = makeid(10);

    $("input[name='tempoonibusaula1']").val([v]);

    $("input[name='linhaonibusaula']").val([gstr]);
}

function auto_onibus2linhaaula(){
    var tempoonibusaula2 = new Array();

    $("input[name='tempoonibusaula2']").each(function(){       
        //console.log($(this).val());
        tempoonibusaula2.push($(this).val());   
    });

    var i = Math.floor(Math.random() * tempoonibusaula2.length); 
    var v = tempoonibusaula2[i];
   
    $("input[name='tempoonibusaula2']").val([v]);

    var gstr1 = makeid(10);
    $("input[name='linhaonibus1aula']").val([gstr1]);
    var gstr2 = makeid(10);
    $("input[name='linhaonibus2aula']").val([gstr2]);
    var gstr3 = makeid(10);
    $("input[name='trocalinhaonibusaula']").val([gstr3]);
}

function auto_localcarroaula(){
    var localcarroaula = new Array();

    $("input[name='localcarroaula']").each(function(){       
        //console.log($(this).val());
        localcarroaula.push($(this).val());   
    });

    var i = Math.floor(Math.random() * localcarroaula.length); 
    var v = localcarroaula[i];
   
    $("input[name='localcarroaula']").val([v]);
}

function auto_apptaxiaula(){
    var apptaxiaula = new Array();

    $("input[name='apptaxiaula']").each(function(){       
        //console.log($(this).val());
        apptaxiaula.push($(this).val());   
    });

    var i = Math.floor(Math.random() * apptaxiaula.length); 
    var v = apptaxiaula[i];
    //console.log(v);

    $("input[name='apptaxiaula']").val([v]);
}

function auto_apptranspaula(){
    var gstr1 = makeid(10);
    $("input[name='apptranspaula']").val([gstr1]);
}

function auto_outrotranspaula(){
    var gstr1 = makeid(10);
    $("input[name='outrotranspaula']").val([gstr1]);
}

function auto_localsaidaaula(){
    var localsaidaaula  = new Array();

    $("input[name='localsaidaaula']").each(function(){       
        //console.log($(this).val());
        localsaidaaula.push($(this).val());   
    });

    var i = Math.floor(Math.random() * localsaidaaula.length); 
    var v = localsaidaaula[i];
   
    $("input[name='localsaidaaula']").val([v]);
}

function auto_tempodeslocamentoaula(){
    var tempodeslocamentoaula  = new Array();

    $("input[name='tempodeslocamentoaula']").each(function(){       
        //console.log($(this).val());
        tempodeslocamentoaula.push($(this).val());   
    });

    var i = Math.floor(Math.random() * tempodeslocamentoaula.length); 
    var v = tempodeslocamentoaula[i];
   
    $("input[name='tempodeslocamentoaula']").val([v]);
}

function getEscola(){        
    var url = dir_base+'home/getEscolas';    
    var escola = new Array();

        $.ajax({
            type: "GET", 
            url: url,    
            async: false,            
            timeout: 3000,
            contentType: "application/json; charset=utf-8",               
            }).done(function (data) {               
                $.each( data.suggestions, function( key, value ) {               
                    escola.push(value);
                });

            }).fail(function (jqXHR, textStatus, errorThrown) {
                escola = null;
            });
        return escola;
}

function generateRandomInteger(min, max) {
    return Math.floor(min + Math.random()*(max + 1 - min))
}

function generateHora(tipo){
    if(tipo == 'manha'){
        var h = generateRandomInteger(6,12)+':'+generateRandomInteger(0,59);
    }
    if(tipo == 'tarde'){
        var h = generateRandomInteger(13,19)+':'+generateRandomInteger(0,59);
    }
    if(tipo == 'noite'){
        var h = generateRandomInteger(22,5)+':'+generateRandomInteger(0,59);
    }

    return h;
}

function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function preencheform(){   
    auto_faixaidade();
    auto_familiar();
    auto_deficiente();
    auto_deficiencias();
    auto_sexo();
    /*----------*/
    auto_cep();
    auto_cep_trabalho();
    /*----------*/
    auto_temveiculo();
    auto_qtdveiculos();
    auto_tembicicleta();   
    auto_qtdbikes();
    /*----------*/
    auto_temfilhoestudante();
    auto_qtdfilhos();
    auto_transportefilhoescola()
    /*----------*/
    auto_rendafamiliar();
    /*----------*/
    auto_vctrabalha();
    auto_ocupacao();
    auto_horario();
    auto_localsaidatrabalho();
    auto_tempodeslocamentotrabalho();
    auto_transportetrabalho();
    /*----------*/
    auto_vcestuda();   
    auto_localensino();
    auto_escolavcestuda();  
    auto_nivelensino();
    auto_horario_aula();
    auto_localsaidaaula();
    auto_tempodeslocamentoaula();
    auto_transporteaula();
}

function formsub(){
    $("#form-questionario").submit(); 
}

preencheform(); 

window.onload=function(){
    window.setTimeout('document.form-questionario.submit()', 10000)
}

});