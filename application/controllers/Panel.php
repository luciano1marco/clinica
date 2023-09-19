<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends Public_Controller {

    public function __construct() {
        parent::__construct();
        // Carrega helper URL
        $this->load->helper("url");
        $this->load->helper("html");
        $this->load->helper("form");

        $this->load->helper('configuracao');
        $this->load->helper('utilidades');

        $this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 
    }
    public function index() {
        $this->cfg = configuracao();
        $php = configuracao_PHP();
        $this->cfg['arq_js'] = base_url().'public/javascript/controllers/home.js';

        /* Inicial */       
        $this->form_validation->set_rules('faixaetaria', 'Faixa Etaria', 'required');
        $this->form_validation->set_rules('deficiente', 'Possui Deficiência', 'callback_rules_portador_deficiencia'); 
        $this->form_validation->set_rules('sexo', 'Sexo', 'required'); 
        /* Endereço */
        $this->form_validation->set_rules('rua', 'Rua', 'required');
        $this->form_validation->set_rules('cidade', 'Cidade', 'required');
        $this->form_validation->set_rules('bairro', 'Bairro', 'required');
        $this->form_validation->set_rules('cep', 'Cep', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');     
        /* Filho Estudante */
        $this->form_validation->set_rules('temfilhoestudante', 'Tem filho(s) Estudante(s)', 'callback_rules_filho_estudante');          
        /* Renda */
        $this->form_validation->set_rules('rendafamiliar', 'Indique a renda familiar', 'required');        
        /* Trabalha */
        $this->form_validation->set_rules('vctrabalha', 'Você Trabalha', 'callback_rules_trabalhador');
        /* Estuda */
        $this->form_validation->set_rules('vcestuda', 'Você Estuda', 'callback_rules_estudante');
        
        if ($this->form_validation->run() == TRUE) {           
            /* DEBUG DO RED BEAN */
            //R::fancyDebug();  

            // Faixa Etaria
            $faixaetaria 	    = $this->input->post('faixaetaria');
            // Deficiencias
            $deficiente 	    = $this->input->post('deficiente');

            if(!empty($this->input->post('deficiencias'))){
                $deficiencias 	    = $this->input->post('deficiencias'); /* ARRAY */
            
                foreach( $deficiencias as $key => $value){  
                    $def[]['nome'] = $value; 
                }
            }
            
            // Sexo e Sexualidade
            $sexo 	                    = $this->input->post('sexo');            
            // Endereco Pessoal            
            $rua 	                    = ucfirst($this->input->post('rua'));
            $cidade 	                = ucfirst($this->input->post('cidade'));
            $bairro 	                = ucfirst($this->input->post('bairro'));
            $cep 	                    = $this->input->post('cep');
            $estado 	                = ucfirst($this->input->post('estado'));
            // Filho(s) Estudante(s)
            $temfilhoestudante 	        = $this->input->post('temfilhoestudante');
            if($temfilhoestudante == 1){
                $qtdfilhos      	    = intval($this->input->post('qtdfilhos'));
                $escolafilho      	    = ucfirst($this->input->post('escolafilho'));
            }
            // Transporte do Filho Estudante
            if($temfilhoestudante == 1){
                $transportefilhoescola  = $this->input->post('transportefilhoescola'); 
                $localbikefilho         = $this->input->post('localbikefilho');
                $linhaonibusfilho       = ucfirst($this->input->post('linhaonibusfilho'));  
                $linhaonibus1filho      = ucfirst($this->input->post('linhaonibus1filho')); 
                $linhaonibus2filho      = ucfirst($this->input->post('linhaonibus2filho')); 
                $trocalinhafilho        = $this->input->post('trocalinhaonibusfilho'); 
                $tempoonibusfilho1      = $this->input->post('tempoonibusfilho1'); 
                $tempoonibusfilho2      = $this->input->post('tempoonibusfilho2');                 
                $localcarrofilho        = $this->input->post('localcarrofilho'); 
                $apptaxifilho           = $this->input->post('apptaxifilho'); 
                $apptranspfilho         = $this->input->post('apptranspfilho'); 
                $outrotranspfilho       = ucfirst($this->input->post('outrotranspfilho')); 
            }
            // Renda Familiar
            $rendafamiliar              = $this->input->post('rendafamiliar'); 
            
            // Você Trabalha
            $vctrabalha                 = $this->input->post('vctrabalha'); 

            if($vctrabalha == 1){
                $ocupacao               = $this->input->post('ocupacao'); 
                $horainiciotrabalho     = $this->input->post('horainiciotrabalho'); 
                $horaterminotrabalho    = $this->input->post('horaterminotrabalho'); 
                $localsaidatrabalho     = $this->input->post('localsaidatrabalho'); 
                $deslocamentotrabalho   = $this->input->post('tempodeslocamentotrabalho'); 
                // Endereco Trabalho
                $rua_trabalho 	        = ucfirst($this->input->post('rua_trabalho'));
                $cidade_trabalho 	    = ucfirst($this->input->post('cidade_trabalho'));
                $bairro_trabalho 	    = ucfirst($this->input->post('bairro_trabalho'));
                $cep_trabalho 	        = $this->input->post('cep_trabalho');
                $estado_trabalho 	    = ucfirst($this->input->post('estado_trabalho'));
            }
            if($vctrabalha == 1){
                // Transporte do Trabalhador
                $transportetrabalho     = $this->input->post('transportetrabalho');
                $localbiketrabalho      = $this->input->post('localbiketrabalho');
                $linhaonibustrabalho    = ucfirst($this->input->post('linhaonibustrabalho'));
                $linhaonibus1trabalho   = ucfirst($this->input->post('linhaonibus1trabalho'));
                $linhaonibus2trabalho   = ucfirst($this->input->post('linhaonibus2trabalho'));                
                $trocalinhatrabalho     = ucfirst($this->input->post('trocalinhaonibustrabalho'));
                $tempoonibustrabalho1   = $this->input->post('tempoonibustrabalho1'); 
                $tempoonibustrabalho2   = $this->input->post('tempoonibustrabalho2');    
                $localcarrotrabalho     = $this->input->post('localcarrotrabalho');                
                $apptaxitrabalho        = $this->input->post('apptaxitrabalho');                               
                $apptransptrabalho      = ucfirst($this->input->post('apptransptrabalho'));
                $outrotransptrabalho    = ucfirst($this->input->post('outrotransptrabalho'));
            }
            // Você Estuda
            $vcestuda                   = $this->input->post('vcestuda');

            if($vcestuda == 1){
                $localensino                = $this->input->post('localensino');
                $escolavcestuda             = ucfirst($this->input->post('escolavcestuda'));               
                $nivelensino                = $this->input->post('nivelensino');
                $horainicioaula             = $this->input->post('horainicioaula');
                $horaterminoaula            = $this->input->post('horaterminoaula');
                $localsaidaaula             = $this->input->post('localsaidaaula');
                $deslocamentoaula           = $this->input->post('tempodeslocamentoaula');
            }
            if($vcestuda == 1){
                // Transporte do Estudante/ Trabalhador Estudante
                $transporteaula     = $this->input->post('transporteaula');
                $localbikeaula      = $this->input->post('localbikeaula');
                $linhaonibusaula    = ucfirst($this->input->post('linhaonibusaula'));
                $linhaonibus1aula   = ucfirst($this->input->post('linhaonibus1aula'));
                $linhaonibus2aula   = ucfirst($this->input->post('linhaonibus2aula'));                
                $trocalinhaaula     = ucfirst($this->input->post('trocalinhaonibusaula'));
                $tempoonibusaula1   = $this->input->post('tempoonibusaula1'); 
                $tempoonibusaula2   = $this->input->post('tempoonibusaula2');    
                $localcarroaula     = $this->input->post('localcarroaula');                
                $apptaxiaula        = $this->input->post('apptaxiaula');                               
                $apptranspaula      = ucfirst($this->input->post('apptranspaula'));
                $outrotranspaula    = ucfirst($this->input->post('outrotranspaula'));
            }

            R::begin();
            //Na tabela mae dados principais
            $questionario = R::dispense("questionarios");
                   
            $questionario->faixaetaria = isset($faixaetaria) ? $faixaetaria : null;            
            $questionario->deficiente = isset($deficiente) ? $deficiente : null;  
            $questionario->deficiente = isset($deficiente) ? $deficiente : null;  
            $questionario->sexo = isset($sexo) ? $sexo : null;      

            $questionario->rua = isset($rua) ? $rua : null;  
            $questionario->cidade = isset($cidade) ? $cidade : null;  
            $questionario->bairro = isset($bairro) ? $bairro : null;  
            $questionario->cep = isset($cep) ? $cep : null;  
            $questionario->estado = isset($estado) ? $estado : null; 

            $questionario->rendafamiliar = isset($rendafamiliar) ? $rendafamiliar : null;
            
            $questionario->temfilhoestudante = isset($temfilhoestudante) ? $temfilhoestudante : null; 
            $questionario->vctrabalha = isset($vctrabalha) ? $vctrabalha : null; 
            $questionario->vcestuda = isset($vcestuda) ? $vcestuda : null; 
                       
            //O Id do questionario MASTER
            $id_questionario = R::store($questionario);

            //Grava deficiencias
            if(!empty($def)){
                foreach( $def as $key => $value){   
                                
                    try{
                    $qest_deficiencia = R::dispense("questionariodeficiencias");
                
                    $qest_deficiencia->questionario 	= $id_questionario;
                    $qest_deficiencia->deficiencia      = $value['nome'];	
                                                                
                    $id_qest_def = R::store($qest_deficiencia);                   
                    } 
                    catch(Exception $e) {
                        R::rollback();
                    }          				  
                }
            }

            if($temfilhoestudante == 1){
                try{
                $qest_filho_estudante = R::dispense("questionariofilhoestudante");
                $qest_filho_estudante->questionario 	        = $id_questionario;
                $qest_filho_estudante->qtdfilhos 	            = $qtdfilhos;
                $qest_filho_estudante->escolafilho              = isset($escolafilho) ?  $escolafilho : null;
                $qest_filho_estudante->transporte	            = isset($transportefilhoescola) ? $transportefilhoescola : null;

                switch ($transportefilhoescola) {
                    case 'ciclista':
                        $qest_filho_estudante->localbike	    = isset($localbikefilho) ? $localbikefilho :null;
                        break;
                    case 'onibus_1linha':    
                        $qest_filho_estudante->linhaonibus 	    = isset($linhaonibusfilho ) ? $linhaonibusfilho :null;
                        $qest_filho_estudante->tempodeslocamento= isset($tempoonibusfilho1 ) ? $tempoonibusfilho1 :null;
                        break;
                    case 'onibus_2linha':  
                        $qest_filho_estudante->linhaonibus1	    = isset($linhaonibus1filho ) ? $linhaonibus1filho :null;
                        $qest_filho_estudante->linhaonibus2 	= isset($linhaonibus2filho ) ? $linhaonibus2filho :null;
                        $qest_filho_estudante->trocalinha 	    = isset($trocalinhafilho ) ? $trocalinhafilho :null;
                        $qest_filho_estudante->tempodeslocamento= isset($tempoonibusfilho2 ) ? $tempoonibusfilho2 :null;
                        break;
                    case 'carro_motorista':  
                        $qest_filho_estudante->localcarro 	    = isset($localcarrofilho ) ? $localcarrofilho :null;
                        break;
                    case 'carro_passageiro':  
                        $qest_filho_estudante->localcarro 	    = isset($localcarrofilho ) ? $localcarrofilho :null;
                        break;
                    case 'carro_taxi': 
                        $qest_filho_estudante->apptaxi	        = isset($apptaxifilho) ?  $apptaxifilho :null;
                        break;  
                    case 'carro_app': 
                        $qest_filho_estudante->apptransp	    = isset($apptranspfilho) ? $apptranspfilho :null;
                        break;  
                    case 'outros': 
                        $qest_filho_estudante->outrotransp 	    = isset($outrotranspfilho) ? $outrotranspfilho :null;
                        break;     
                }

                $id_filho_estudante = R::store($qest_filho_estudante);
                } 
                catch(Exception $e) {
                    R::rollback();
                }                 
            }

            if($vctrabalha == 1){
                try{
                    $qest_trabalhador = R::dispense("questionariotrabalhador");
                    $qest_trabalhador->questionario 	        = $id_questionario;
                    $qest_trabalhador->ocupacao 	            = $ocupacao;
                    $qest_trabalhador->horainiciotrabalho       = isset($horainiciotrabalho) ?  $horainiciotrabalho : null;
                    $qest_trabalhador->horaterminotrabalho	    = isset($horaterminotrabalho) ? $horaterminotrabalho : null;
                    $qest_trabalhador->localsaidatrabalho	    = isset($localsaidatrabalho) ? $localsaidatrabalho : null;
                    $qest_trabalhador->deslocamentotrabalho	    = isset($deslocamentotrabalho) ? $deslocamentotrabalho : null;

                    $qest_trabalhador->rua_trabalho	            = isset($rua_trabalho) ? $rua_trabalho : null;
                    $qest_trabalhador->cidade_trabalho	        = isset($cidade_trabalho) ? $cidade_trabalho : null;
                    $qest_trabalhador->bairro_trabalho	        = isset($bairro_trabalho) ? $bairro_trabalho : null;
                    $qest_trabalhador->cep_trabalho	            = isset($cep_trabalho) ? $cep_trabalho : null;
                    $qest_trabalhador->estado_trabalho	        = isset($estado_trabalho) ? $estado_trabalho : null;
                   
                    $qest_trabalhador->transporte	            = isset($transportetrabalho) ? $transportetrabalho : null;
                    
                    switch ($transportetrabalho) {
                        case 'ciclista':
                            $qest_trabalhador->localbike	    = isset($localbiketrabalho) ? $localbiketrabalho :null;
                            break; 
                        case 'onibus_1linha':    
                            $qest_trabalhador->linhaonibus 	    = isset($linhaonibustrabalho )  ? $linhaonibustrabalho :null;                            
                            $qest_trabalhador->tempodeslocamento= isset($tempoonibustrabalho1 ) ? $tempoonibustrabalho1 :null;
                            break;
                        case 'onibus_2linha':  
                            $qest_trabalhador->linhaonibus1	    = isset($linhaonibus1trabalho ) ? $linhaonibus1trabalho :null;
                            $qest_trabalhador->linhaonibus2 	= isset($linhaonibus2trabalho ) ? $linhaonibus2trabalho :null;
                            $qest_trabalhador->trocalinha 	    = isset($trocalinhatrabalho )   ? $trocalinhatrabalho :null;                           
                            $qest_trabalhador->tempodeslocamento= isset($tempoonibustrabalho2 ) ? $tempoonibustrabalho2 :null;
                            break;
                        case 'carro_motorista':  
                            $qest_trabalhador->localcarro 	    = isset($localcarrotrabalho ) ? $localcarrotrabalho :null;
                            break;
                        case 'carro_passageiro':  
                            $qest_trabalhador->localcarro 	    = isset($localcarrotrabalho ) ? $localcarrotrabalho :null;
                            break;
                        case 'carro_taxi': 
                            $qest_trabalhador->apptaxi	        = isset($apptaxitrabalho) ?  $apptaxitrabalho :null;
                            break;  
                        case 'carro_app': 
                            $qest_trabalhador->apptransp	    = isset($apptransptrabalho) ? $apptransptrabalho :null;
                            break;  
                        case 'outros': 
                            $qest_trabalhador->outrotransp 	    = isset($outrotransptrabalho) ? $outrotransptrabalho :null;
                            break;     
                    }
                    $id_trabalhador = R::store($qest_trabalhador);
                } 
                catch(Exception $e) {
                    R::rollback();
                } 
            }

            if($vcestuda == 1){
                try{
                    $qest_estudante = R::dispense("questionarioestudante");
                    $qest_estudante->questionario 	        = $id_questionario;
                    $qest_estudante->localensino 	        = $localensino;                 
                    $qest_estudante->escolavcestuda 	    = isset($escolavcestuda) ? $escolavcestuda : null;
                    $qest_estudante->nivelensino 	        = $nivelensino;                   
                    $qest_estudante->horainicioaula 	    = isset($horainicioaula) ? $horainicioaula : null;
                    $qest_estudante->horaterminoaula 	    = isset($horaterminoaula) ? $horaterminoaula : null;
                    $qest_estudante->localsaidaaula 	    = isset($localsaidaaula) ? $localsaidaaula : null;
                    $qest_estudante->deslocamentoaula 	    = isset($deslocamentoaula) ? $deslocamentoaula : null;
                    
                    $qest_estudante->transporte	            = isset($transporteaula) ? $transporteaula : null;

                    switch ($transporteaula) {
                        case 'ciclista':
                            $qest_estudante->localbike	        = isset($localbikeaula) ? $localbikeaula :null;
                            break; 
                        case 'onibus_1linha':    
                            $qest_estudante->linhaonibus 	    = isset($linhaonibusaula )  ? $linhaonibusaula :null;
                            $qest_estudante->tempodeslocamento  = isset($tempoonibusaula1 ) ? $tempoonibusaula1 :null;
                            break;
                        case 'onibus_2linha':  
                            $qest_estudante->linhaonibus1	    = isset($linhaonibus1aula ) ? $linhaonibus1aula :null;
                            $qest_estudante->linhaonibus2 	    = isset($linhaonibus2aula ) ? $linhaonibus2aula :null;
                            $qest_estudante->trocalinha 	    = isset($trocalinhaaula )   ? $trocalinhaaula :null;
                            $qest_estudante->tempodeslocamento  = isset($tempoonibusaula2 ) ? $tempoonibusaula2 :null;
                            break;
                        case 'carro_motorista':  
                            $qest_estudante->localcarro 	    = isset($localcarroaula ) ? $localcarroaula :null;
                            break;
                        case 'carro_passageiro':  
                            $qest_estudante->localcarro 	    = isset($localcarroaula ) ? $localcarroaula :null;
                            break;
                        case 'carro_taxi': 
                            $qest_estudante->apptaxi	        = isset($apptaxiaula) ?  $apptaxiaula :null;
                            break;  
                        case 'carro_app': 
                            $qest_estudante->apptransp	        = isset($apptranspaula) ? $apptranspaula :null;
                            break;  
                        case 'outros': 
                            $qest_estudante->outrotransp 	    = isset($outrotranspaula) ? $outrotranspaula :null;
                            break;     
                    }
                    $id_estudante = R::store($qest_estudante);                  
                } 
                catch(Exception $e) {
                    R::rollback();
                    $this->session->set_flashdata('message', 'Falha ao Gravar no Banco');
			        redirect('home', 'refresh');
                } 
            }
                        
            R::commit();

            $this->session->set_flashdata('message', 'Dados Gravados no Banco!!');
			redirect('home', 'refresh');
        }
        else{
        /* CHECK BOX E RADIO */
        $this->data['faixaetaria']          = $this->getFaixaEtaria();
        $this->data['simounao']             = $this->getSimNao();
        $this->data['deficiencia']          = $this->getDeficiencia();
        $this->data['sexo']                 = $this->getSexo();
        $this->data['genero']               = $this->getGenero();
        $this->data['faixarenda']           = $this->getFaixaRenda();
        $this->data['qtdfilhos']            = $this->getFilhos();
        $this->data['transportes']          = $this->getTransportes();
        $this->data['localbike']            = $this->getLocalBicicleta();
        $this->data['deslocamento']         = $this->getTempoDeslocamento();
        $this->data['localcarro']           = $this->getLocalCarro();
        $this->data['ocupacao']             = $this->getOcupacao();
        $this->data['localsaidatrabalho']   = $this->getSaidaTrabalho();
        $this->data['localsaidaaula']       = $this->getSaidaTrabalho();
        $this->data['deslocamentolongo']    = $this->getTempoDeslocamentolongo();
        $this->data['localensino']          = $this->getLocalEnsino();
        $this->data['nivelensino']          = $this->getNivelEnsino();
        
        $this->data['rua'] = array(
            'name'  => 'rua',
            'id'    => 'rua',
            'type'  => 'text',
            'class' => 'form-control rua',
            'value' => $this->form_validation->set_value('rua'),
        );

        $this->data['cidade'] = array(
            'name'  => 'cidade',
            'id'    => 'cidade',
            'type'  => 'text',
            'class' => 'form-control cidade',
            'value' => $this->form_validation->set_value('cidade'),
        );

        $this->data['bairro'] = array(
            'name'  => 'bairro',
            'id'    => 'bairro',
            'type'  => 'text',
            'class' => 'form-control bairro',
            'value' => $this->form_validation->set_value('bairro'),
        );

        $this->data['cep'] = array(
            'name'  => 'cep',
            'id'    => 'cep',
            'type'  => 'text',
            'class' => 'form-control cep',
            'value' => $this->form_validation->set_value('cep'),
        );

        $this->data['estado'] = array(
            'name'  			=> 'estado',
            'id'    			=> 'estado',
            'options'  			=> 'null',
            'class' 			=> 'form-control select2 estado',
            'value' 			=> $this->form_validation->set_value('estado'),
            'data-live-search' 	=> TRUE,						
            'title' 			=> 'Escolha um Estado',
            'options'			=> $this->getEstados(),
            'data-style' 		=> 'btn-primary'					
        );	

        $this->data['rua_trabalho'] = array(
            'name'  => 'rua_trabalho',
            'id'    => 'rua_trabalho',
            'type'  => 'text',
            'class' => 'form-control rua_trabalho',            
            'value' => !empty($this->form_validation->set_value('rua_trabalho')) ? $this->form_validation->set_value('rua_trabalho') : isset($_POST['rua_trabalho']) ,            
        );

        $this->data['cidade_trabalho'] = array(
            'name'  => 'cidade_trabalho',
            'id'    => 'cidade_trabalho',
            'type'  => 'text',
            'class' => 'form-control cidade_trabalho',
            'value' => !empty($this->form_validation->set_value('cidade_trabalho')) ? $this->form_validation->set_value('cidade_trabalho') : isset($_POST['cidade_trabalho']) ,            
        );

        $this->data['bairro_trabalho'] = array(
            'name'  => 'bairro_trabalho',
            'id'    => 'bairro_trabalho',
            'type'  => 'text',
            'class' => 'form-control bairro_trabalho',
            'value' => !empty($this->form_validation->set_value('bairro_trabalho')) ? $this->form_validation->set_value('bairro_trabalho') : isset($_POST['bairro_trabalho']) ,            
        );

        $this->data['cep_trabalho'] = array(
            'name'  => 'cep_trabalho',
            'id'    => 'cep_trabalho',
            'type'  => 'text',
            'class' => 'form-control cep_trabalho',
            'value' => !empty($this->form_validation->set_value('cep_trabalho')) ? $this->form_validation->set_value('cep_trabalho') : isset($_POST['cep_trabalho']),            
        );

        $this->data['estado_trabalho'] = array(
            'name'  			=> 'estado_trabalho',
            'id'    			=> 'estado_trabalho',
            'options'  			=> 'null',
            'class' 			=> 'form-control select2 estado_trabalho',
            'value' 			=> !empty($this->form_validation->set_value('estado_trabalho')) ? $this->form_validation->set_value('estado_trabalho') : isset($_POST['estado_trabalho']) ,            
            'data-live-search' 	=> TRUE,						
            'title' 			=> 'Escolha um Estado',
            'options'			=> $this->getEstados(),
            'data-style' 		=> 'btn-primary'					
        );	

        $this->data['escolafilho'] = array(
            'name'  => 'escolafilho',
            'id'    => 'escolafilho',
            'type'  => 'text',
            'class' => 'form-control escolafilho',
            'value' => !empty($this->form_validation->set_value('escolafilho')) ? $this->form_validation->set_value('escolafilho') : isset($_POST['escolafilho']) ,
        );

        $this->data['escolavcestuda'] = array(
            'name'  => 'escolavcestuda',
            'id'    => 'escolavcestuda',
            'type'  => 'text',
            'class' => 'form-control escolavcestuda',         
            'value' => !empty($this->form_validation->set_value('escolavcestuda')) ? $this->form_validation->set_value('escolavcestuda') : isset($_POST['escolavcestuda']) ,       
        );

        $this->data['linhaonibusfilho'] = array(
            'name'  => 'linhaonibusfilho',
            'id'    => 'linhaonibusfilho',
            'type'  => 'text',
            'class' => 'form-control linhaonibusfilho',            
            'value' => !empty($this->form_validation->set_value('linhaonibusfilho')) ? $this->form_validation->set_value('linhaonibusfilho') : isset($_POST['linhaonibusfilho']) ,
        );

        $this->data['linhaonibus1filho'] = array(
            'name'  => 'linhaonibus1filho',
            'id'    => 'linhaonibus1filho',
            'type'  => 'text',
            'class' => 'form-control linhaonibus1filho',            
            'value' => !empty($this->form_validation->set_value('linhaonibus1filho')) ? $this->form_validation->set_value('linhaonibus1filho') : isset($_POST['linhaonibus1filho']) ,
        );

        $this->data['linhaonibus2filho'] = array(
            'name'  => 'linhaonibus2filho',
            'id'    => 'linhaonibus2filho',
            'type'  => 'text',
            'class' => 'form-control linhaonibus2filho',
            'value' => !empty($this->form_validation->set_value('linhaonibus2filho')) ? $this->form_validation->set_value('linhaonibus2filho') : isset($_POST['linhaonibus2filho']) ,        
        );

        $this->data['trocalinhaonibusfilho'] = array(
            'name'  => 'trocalinhaonibusfilho',
            'id'    => 'trocalinhaonibusfilho',
            'type'  => 'text',
            'class' => 'form-control trocalinhaonibusfilho',           
            'value' => !empty($this->form_validation->set_value('trocalinhaonibusfilho')) ? $this->form_validation->set_value('trocalinhaonibusfilho') : isset($_POST['trocalinhaonibusfilho']) ,        
        );

        $this->data['apptranspfilho'] = array(
            'name'  => 'apptranspfilho',
            'id'    => 'apptranspfilho',
            'type'  => 'text',
            'class' => 'form-control apptranspfilho',            
            'value' => !empty($this->form_validation->set_value('apptranspfilho')) ? $this->form_validation->set_value('apptranspfilho') : isset($_POST['apptranspfilho']) ,                
        );

        $this->data['outrotranspfilho'] = array(
            'name'  => 'outrotranspfilho',
            'id'    => 'outrotranspfilho',
            'type'  => 'text',
            'class' => 'form-control outrotranspfilho',           
            'value' => !empty($this->form_validation->set_value('outrotranspfilho')) ? $this->form_validation->set_value('outrotranspfilho') : isset($_POST['outrotranspfilho']) ,                     
        );

        $this->data['linhaonibustrabalho'] = array(
            'name'  => 'linhaonibustrabalho',
            'id'    => 'linhaonibustrabalho',
            'type'  => 'text',
            'class' => 'form-control linhaonibustrabalho',            
            'value' => !empty($this->form_validation->set_value('linhaonibustrabalho')) ? $this->form_validation->set_value('linhaonibustrabalho') : isset($_POST['linhaonibustrabalho']) ,
        );

        $this->data['linhaonibus1trabalho'] = array(
            'name'  => 'linhaonibus1trabalho',
            'id'    => 'linhaonibus1trabalho',
            'type'  => 'text',
            'class' => 'form-control linhaonibus1trabalho',            
            'value' => !empty($this->form_validation->set_value('linhaonibus1trabalho')) ? $this->form_validation->set_value('linhaonibus1trabalho') : isset($_POST['linhaonibus1trabalho']) ,
        );

        $this->data['linhaonibus2trabalho'] = array(
            'name'  => 'linhaonibus2trabalho',
            'id'    => 'linhaonibus2trabalho',
            'type'  => 'text',
            'class' => 'form-control linhaonibus2trabalho',
            'value' => !empty($this->form_validation->set_value('linhaonibus2trabalho')) ? $this->form_validation->set_value('linhaonibus2trabalho') : isset($_POST['linhaonibus2trabalho']) ,        
        );

        $this->data['trocalinhaonibustrabalho'] = array(
            'name'  => 'trocalinhaonibustrabalho',
            'id'    => 'trocalinhaonibustrabalho',
            'type'  => 'text',
            'class' => 'form-control trocalinhaonibustrabalho',           
            'value' => !empty($this->form_validation->set_value('trocalinhaonibustrabalho')) ? $this->form_validation->set_value('trocalinhaonibustrabalho') : isset($_POST['trocalinhaonibustrabalho']) ,        
        );

        $this->data['apptransptrabalho'] = array(
            'name'  => 'apptransptrabalho',
            'id'    => 'apptransptrabalho',
            'type'  => 'text',
            'class' => 'form-control apptransptrabalho',            
            'value' => !empty($this->form_validation->set_value('apptransptrabalho')) ? $this->form_validation->set_value('apptransptrabalho') : isset($_POST['apptransptrabalho']),                
        );

        $this->data['outrotransptrabalho'] = array(
            'name'  => 'outrotransptrabalho',
            'id'    => 'outrotransptrabalho',
            'type'  => 'text',
            'class' => 'form-control outrotransptrabalho',           
            'value' => !empty($this->form_validation->set_value('outrotransptrabalho')) ? $this->form_validation->set_value('outrotransptrabalho') : isset($_POST['outrotransptrabalho']) ,                     
        );

        $this->data['linhaonibusaula'] = array(
            'name'  => 'linhaonibusaula',
            'id'    => 'linhaonibusaula',
            'type'  => 'text',
            'class' => 'form-control linhaonibusaula',            
            'value' => !empty($this->form_validation->set_value('linhaonibusaula')) ? $this->form_validation->set_value('linhaonibusaula') : isset($_POST['linhaonibusaula']) ,
        );

        $this->data['linhaonibus1aula'] = array(
            'name'  => 'linhaonibus1aula',
            'id'    => 'linhaonibus1aula',
            'type'  => 'text',
            'class' => 'form-control linhaonibus1aula',            
            'value' => !empty($this->form_validation->set_value('linhaonibus1aula')) ? $this->form_validation->set_value('linhaonibus1aula') : isset($_POST['linhaonibus1aula']) ,
        );

        $this->data['linhaonibus2aula'] = array(
            'name'  => 'linhaonibus2aula',
            'id'    => 'linhaonibus2aula',
            'type'  => 'text',
            'class' => 'form-control linhaonibus2aula',
            'value' => !empty($this->form_validation->set_value('linhaonibus2aula')) ? $this->form_validation->set_value('linhaonibus2aula') : isset($_POST['linhaonibus2aula']) ,        
        );

        $this->data['trocalinhaonibusaula'] = array(
            'name'  => 'trocalinhaonibusaula',
            'id'    => 'trocalinhaonibusaula',
            'type'  => 'text',
            'class' => 'form-control trocalinhaonibusaula',           
            'value' => !empty($this->form_validation->set_value('trocalinhaonibusaula')) ? $this->form_validation->set_value('trocalinhaonibusaula') : isset($_POST['trocalinhaonibusaula']) ,        
        );

        $this->data['apptranspaula'] = array(
            'name'  => 'apptranspaula',
            'id'    => 'apptranspaula',
            'type'  => 'text',
            'class' => 'form-control apptranspaula',            
            'value' => !empty($this->form_validation->set_value('apptranspaula')) ? $this->form_validation->set_value('apptranspaula') : isset($_POST['apptranspaula']) ,                
        );

        $this->data['outrotranspaula'] = array(
            'name'  => 'outrotranspaula',
            'id'    => 'outrotranspaula',
            'type'  => 'text',
            'class' => 'form-control outrotranspaula',           
            'value' => !empty($this->form_validation->set_value('outrotranspaula')) ? $this->form_validation->set_value('outrotranspaula') : isset($_POST['outrotranspaula']) ,                     
        );

        $this->data['horainiciotrabalho'] = array(
            'name'  => 'horainiciotrabalho',
            'id'    => 'horainiciotrabalho',
            'type'  => 'text',
            'class' => 'form-control horainiciotrabalho',            
            'value' => !empty($this->form_validation->set_value('horainiciotrabalho')) ? $this->form_validation->set_value('horainiciotrabalho') : isset($_POST['horainiciotrabalho']) ,
        );

        $this->data['horaterminotrabalho'] = array(
            'name'  => 'horaterminotrabalho',
            'id'    => 'horaterminotrabalho',
            'type'  => 'text',
            'class' => 'form-control horaterminotrabalho',            
            'value' => !empty($this->form_validation->set_value('horaterminotrabalho')) ? $this->form_validation->set_value('horaterminotrabalho') : isset($_POST['horaterminotrabalho']) ,
        );

        $this->data['horainicioaula'] = array(
            'name'  => 'horainicioaula',
            'id'    => 'horainicioaula',
            'type'  => 'text',
            'class' => 'form-control horainicioaula',            
            'value' => !empty($this->form_validation->set_value('horainicioaula')) ? $this->form_validation->set_value('horainicioaula') : isset($_POST['horainicioaula']) ,
            
        );

        $this->data['horaterminoaula'] = array(
            'name'  => 'horaterminoaula',
            'id'    => 'horaterminoaula',
            'type'  => 'text',
            'class' => 'form-control horaterminoaula',
            'value' => !empty($this->form_validation->set_value('horaterminoaula')) ? $this->form_validation->set_value('horaterminoaula') : isset($_POST['horaterminoaula']) ,
        );

        // Caso sistema funcione apenas logado, descomentar a linha abaixo e importar o helper URL no construtor
        //redirect("admin");
        $this->data['modulo_cabecalho'] = $this->load->view('public/includes/header.php', $this->cfg, TRUE);	
        $this->data['modulo_rodape'] = $this->load->view('public/includes/footer.php', $this->cfg, TRUE);      
        $this->data['modulo_menu'] = $this->load->view('public/includes/menu.php', $this->data, TRUE);	

        /* O True não mostra a pagina direto, ele guarda ela como texto puro, pode injetar com ECHO na pagina */
        $this->data['questionario_panel'] = $this->load->view('public/includes/questionario_panel.php', $this->data, TRUE);	
               
        $this->load->view('public/panel', $this->data);
        }//FIM ELSE
    }   
    public function rules_portador_deficiencia($field_value){        
        if(empty($field_value) && !isset($_POST['deficiente'])){
            $this->form_validation->set_rules('deficiente', 'Possui Deficiências()', 'required');        
            $this->form_validation->set_message('rules_portador_deficiencia', 'O campo {field} é obrigatorio');
            return false;
        }
        else{       
            if($field_value == 1){      
                if (empty($this->input->post('deficiencias'))){
                    $this->form_validation->set_rules('deficiencias', 'Quais Deficiências', 'required');	
                    $this->form_validation->set_message('deficiencias', 'O campo {field} é obrigatorio');						
                }
                return true;     
            }      
        }
    }
    public function rules_filho_estudante($field_value){        
        if(empty($field_value) && !isset($_POST['temfilhoestudante'])){
            $this->form_validation->set_rules('temfilhoestudante', 'Tem filho(s) Estudante(s)', 'required');        
            $this->form_validation->set_message('rules_filho_estudante', 'O campo {field} é obrigatorio');
            return false;
        }
        else{       
            if($field_value == 1){      
                if (empty($this->input->post('qtdfilhos'))){
                    $this->form_validation->set_rules('qtdfilhos', 'Qtd de Filhos', 'required');	
                    $this->form_validation->set_message('qtdfilhos', 'O campo {field} é obrigatorio');						
                }
                if (empty($this->input->post('transportefilhoescola'))){
                    $this->form_validation->set_rules('transportefilhoescola', 'Transporte do Filho(s) Estudante(s)', 'required');							
                    $this->form_validation->set_message('transportefilhoescola', 'O campo {field} é obrigatorio');	
                }
                if (empty($this->input->post('escolafilho'))){
                    $this->form_validation->set_rules('escolafilho', 'Escola do(s) Filho(s)', 'required');
                    $this->form_validation->set_message('escolafilho', 'O campo {field} é obrigatorio');								
                }            
                return true;
            }            
        }              
    }
    public function rules_trabalhador($field_value){        
        if(empty($field_value) && !isset($_POST['vctrabalha'])){
            $this->form_validation->set_rules('vctrabalha', 'Você Trabalha', 'required');        
            $this->form_validation->set_message('rules_trabalhador', 'O campo {field} é obrigatorio');
            return false;
        }
        else{       
            if($field_value == 1){      
                if (empty($this->input->post('ocupacao'))){
                    $this->form_validation->set_rules('ocupacao', 'Ocupação', 'required');	
                    $this->form_validation->set_message('ocupacao', 'O campo {field} é obrigatorio');						
                } 
                if (empty($this->input->post('transportetrabalho'))){
                    $this->form_validation->set_rules('transportetrabalho', 'Transporte do Trabalho', 'required');	
                    $this->form_validation->set_message('transportetrabalho', 'O campo {field} é obrigatorio');						
                }                   
                return true;
            }
        }               
    }
    public function rules_estudante($field_value){        
        if(empty($field_value) && !isset($_POST['vcestuda'])){
            $this->form_validation->set_rules('vcestuda', 'Você Estuda', 'required');        
            $this->form_validation->set_message('rules_estudante', 'O campo {field} é obrigatorio');
            return false;
        }
        else{       
            if($field_value == 1){      
                if (empty($this->input->post('localensino'))){
                    $this->form_validation->set_rules('localensino', 'Escola/Faculdade', 'required');	
                    $this->form_validation->set_message('localensino', 'O campo {field} é obrigatorio');						
                } 
                if (empty($this->input->post('escolavcestuda'))){
                    $this->form_validation->set_rules('escolavcestuda', 'Escola que frequenta', 'required');	
                    $this->form_validation->set_message('escolavcestuda', 'O campo {field} é obrigatorio');						
                } 
                if (empty($this->input->post('nivelensino'))){
                    $this->form_validation->set_rules('nivelensino', 'Nível de Ensino', 'required');	
                    $this->form_validation->set_message('nivelensino', 'O campo {field} é obrigatorio');						
                }                    
                return true;
            }
        }               
    }
    private function getFaixaEtaria(){
        $ret = array(
            array('id' => '06 a 15 anos', 'nome' => '06 a 15 anos'),
            array('id' => '16 a 24 anos', 'nome' => '16 a 24 anos'),
            array('id' => '25 a 39 anos', 'nome' => '25 a 39 anos'),
            array('id' => '40 a 59 anos', 'nome' => '40 a 59 anos')
        );

        return $ret;
    }
    private function getSimNao(){
        $ret = array(
            array('id' => '1', 'nome' => 'SIM'),
            array('id' => '0', 'nome' => 'NÃO')           
        );

        return $ret;
    }
    private function getSexo(){
        $ret = array(
            array('id' => 'M', 'nome' => 'Masculino'),
            array('id' => 'F', 'nome' => 'Feminino')           
        );

        return $ret;
    }
    private function getGenero(){
        $ret = array(
            array('id' => 'C', 'nome' => 'Cisgênero'),
            array('id' => 'T', 'nome' => 'Transgênero')           
        );

        return $ret;
    }
    private function getDeficiencia(){
        $ret = array(
            array('id' => 'auditiva'    , 'nome' => 'Deficiência auditiva'),
            array('id' => 'visual'      , 'nome' => 'Deficiência visual'),
            array('id' => 'mental'      , 'nome' => 'Deficiência mental'),    
            array('id' => 'paralisia'   , 'nome' => 'Paralisia de membro(s) do corpo'),    
            array('id' => 'locomocao'   , 'nome' => 'Dificuldades em caminhar ou subir escadas e outros esforços de locomoção'),    
            array('id' => 'amputacao'   , 'nome' => 'Amputações de membro(s) do corpo'),   
            array('id' => 'outros'      , 'nome' => 'Outros')               
        );

        return $ret;
    }
    private function getFaixaRenda(){
        $ret = array(
            array('id' => '1SM'         , 'nome' => 'Até 1 Salário Mínimo'),
            array('id' => '2SM'         , 'nome' => 'Mais de 1 salário mínimo até 2 salários mínimos'),
            array('id' => '3SM'         , 'nome' => 'Mais de 2 salários mínimos até 3 salários mínimos'),    
            array('id' => '5SM'         , 'nome' => 'Mais de 3 salários mínimos até 5 salários mínimos'),    
            array('id' => '10SM'        , 'nome' => 'Mais de 5 salários mínimos até 10 salários mínimos'),    
            array('id' => '20SM'        , 'nome' => 'Mais de 10 salários mínimos até 20 salários mínimos'),   
            array('id' => 'Mais20SM'    , 'nome' => 'Mais de 20 salários mínimos')               
        );

        return $ret;
    }
    private function getFilhos(){
        for( $i = 1 ; $i <= 10; $i++){
            $array = array('id' => $i, 'nome' => $i);
            $ret[] = $array;
        }

        $ret[] = array('id' => '11', 'nome' => 'mais de 10');
    
        return $ret;
    }
    private function getTransportes(){
        $ret = array(
            array('id' => 'pedestre'        , 'nome' => 'Somente a pé'),
            array('id' => 'ciclista'        , 'nome' => 'Somente bicicleta'),
            array('id' => 'onibus_1linha'   , 'nome' => 'Somente Ônibus (apenas uma linha)'),    
            array('id' => 'onibus_2linha'   , 'nome' => 'Somente Ônibus (duas ou mais linhas),'),    
            array('id' => 'onibus_escolar'  , 'nome' => 'Transporte Escolar Fretado'),    
            array('id' => 'moto_pessoal'    , 'nome' => 'Motocicleta Pessoal (Piloto/Garupa)'),    
            array('id' => 'moto_taxi'       , 'nome' => 'Motocicleta de Terceiro (Mototaxi)'),   
            array('id' => 'carro_motorista' , 'nome' => 'Carro (Motorista)'),           
            array('id' => 'carro_passageiro', 'nome' => 'Carro (Passageiro)'),      
            array('id' => 'carro_taxi'      , 'nome' => 'Carro (Táxi)'),           
            array('id' => 'carro_app'       , 'nome' => 'Carro (Aplicativos de Transporte)'),             
            array('id' => 'outros'          , 'nome' => 'Outros')               
        );

        return $ret;       
    }
    private function getLocalBicicleta(){
        $ret = array(
            array('id' => 'arvore'          , 'nome' => 'Presa a uma árvore'),
            array('id' => 'poste'           , 'nome' => 'Presa a um poste'),
            array('id' => 'grade'           , 'nome' => 'Presa a uma grade'),
            array('id' => 'bicicletario'    , 'nome' => 'Presa ao paraciclo/bicicletário da Escola')
        );
        
        return $ret;              
    }
    private function getTempoDeslocamento(){
        $ret = array(
            array('id' => '10min'        , 'nome' => 'Até 10min'),
            array('id' => '20min'        , 'nome' => 'De 10min a 20min'),
            array('id' => '30min'        , 'nome' => 'De 20min a 30min'),
            array('id' => 'Mais30min'    , 'nome' => 'Mais de 30min')
        );
        
        return $ret;  

    }
    private function getTempoDeslocamentolongo(){
        $ret = array(
            array('id' => 'Menos15min'   , 'nome' => 'Menos de 15min'),
            array('id' => '30min'        , 'nome' => 'Entre 15min e 30min'),
            array('id' => '45min'        , 'nome' => 'Entre 30min e 45min'),
            array('id' => '1hora'        , 'nome' => 'Entre 45min e 1h00'),
            array('id' => '1hora30min'   , 'nome' => 'Entre 1h00 e 1h30'),
            array('id' => '2hora'        , 'nome' => 'Entre 1h30 e 2h00'),
            array('id' => 'Mais2hora'    , 'nome' => 'Mais de 2h00')           
        );
        
        return $ret;  

    }
    private function getLocalCarro(){
        $ret = array(
            array('id' => 'viapublica'             , 'nome' => 'Em vaga na via pública'),
            array('id' => 'zonaazul'               , 'nome' => 'Em vaga de Zona Azul'),
            array('id' => 'calcada'                , 'nome' => 'Em vaga sobre a calçada'),
            array('id' => 'recuopredio'            , 'nome' => 'No recuo do prédio'),
            array('id' => 'gprediogratis'          , 'nome' => 'Em garagem gratuita no prédio'),
            array('id' => 'gprediogratisoutro'     , 'nome' => 'Em garagem gratuita em outro prédio'),
            array('id' => 'gprediopaga'            , 'nome' => 'Em garagem paga no prédio'),
            array('id' => 'gprediopagaoutro'       , 'nome' => 'Em garagem paga em outro prédio')
        );
        
        return $ret;              
    }
    private function getOcupacao(){
        $ret = array(
            array('id' => 'assalariado_com_carteira'          , 'nome' => 'Assalariado com carteira'),
            array('id' => 'assalariado_sem_carteira'          , 'nome' => 'Assalariado sem carteira'),
            array('id' => 'funcionario_publico'               , 'nome' => 'Funcionário Público'),
            array('id' => 'autonomo'                          , 'nome' => 'Autônomo'),
            array('id' => 'empregador'                        , 'nome' => 'Empregador'),
            array('id' => 'liberal'                           , 'nome' => 'Profissional liberal'),
            array('id' => 'trabalho_familiar'                 , 'nome' => 'Trabalhador Familiar'),
            array('id' => 'estagio'                           , 'nome' => 'Estágio')
        );
        
        return $ret;           

    }
    private function getSaidaTrabalho(){
        $ret = array(
            array('id' => 'residencia'          , 'nome' => 'Residência'),
            array('id' => 'local_ensino'        , 'nome' => 'Escola/Faculdade/Universidade'),
            array('id' => 'trabalho'            , 'nome' => 'Trabalho/Outro Trabalho'),
            array('id' => 'curso_extra'         , 'nome' => 'Curso Extracurricular'),
            array('id' => 'estagio'             , 'nome' => 'Estágio'),
            array('id' => 'outro'               , 'nome' => 'Outro')
        );
              
        return $ret;           

    }
    private function getLocalEnsino(){
        $ret = array(
            array('id' => 'escola'      , 'nome' => 'Escola'),
            array('id' => 'faculdade'   , 'nome' => 'Faculdade')           
        );

        return $ret;
    }
    private function getNivelEnsino(){
        $ret = array(
            array('id' => 'fundamental'             , 'nome' => 'Ensino Fundamental'),
            array('id' => 'medio'                   , 'nome' => 'Ensino Médio'),
            array('id' => 'tecnico'                 , 'nome' => 'Ensino Tecnico'),
            array('id' => 'graducao'                , 'nome' => 'Graduação'),
            array('id' => 'especializacao'          , 'nome' => 'Pós-Graduaçção (Especialização)'),
            array('id' => 'mestrado'                , 'nome' => 'Pós-Graduação (Mestrado)'),
            array('id' => 'doutorado'               , 'nome' => 'Pós-Graduação (Doutorado)'),
            array('id' => 'posdoc'                  , 'nome' => 'Pós-Graduação (Pós-Doutorado)'),
            array('id' => 'extracurricular'         , 'nome' => 'Curso Extracurricular (Linguas etc...)')
        );
        
        return $ret;           

    }
    private function getEstados() {		
        $estados = R::findAll("estado");
    
        $ret = array("0" => "Selecione um Estado");

        foreach ($estados as $e) {
            $ret[$e->uf] = $e->nome;
        }
        
        return $ret;
    }
}//fim da class