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
   
    if ($('.datetimepicker').length > 0) {    
        $('.datetimepicker').datetimepicker({
            //format: 'LT'
            format: 'HH:mm'
        });

        $('.datetimepicker').mask('00:00');
    }
  
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

  
    $("input[name='tempresencial']").on('ifChecked ifToggled', function(event){
        var val = $(this).val();
      
        if(val == 1){         
            $("#panelgrp_qtdpresencial").show();
        }
        else{
            $("#panelgrp_qtdpresencial").hide();
        }       
    });

    if ($("input[name='tempresencial']").is(':checked')){
        var selectedOption = $("input:radio[name=tempresencial]:checked").val()
      
        if(selectedOption == 1){              
            $("#panelgrp_qtdpresencial").show();
            $("#panel_qtdpresencial").show();
        }
        else{   
            $("#panelgrp_qtdpresencial").hide();   
            $("#panel_qtdpresencial").hide(); 
        }
    }    
});