<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

    public function __construct() {
        parent::__construct();
        // Carrega helper URL
        //$this->load->helper("url");
        $this->load->helper('configuracao');
        $this->load->helper('utilidades');
    }
	public function index() {
        $cfg = configuracao();
        $php = configuracao_PHP();
        $this->load->library('calendar');
        /* Os dados da Model aqui */
        $sql = "SELECT  	
                        ag.id,
                        te.hora as hora,
                        dagenda,
                        descricao  as nome	     

                FROM agenda as ag

                inner join mesas as us
                on us.id = ag.idmesas

                inner join tempo as te
                on ag.hora = te.id

                ";

        $this->data['agend'] = R::getAll($sql);
      
        /* select para os psicologos */
        $sqlps = "SELECT d.id,
                        d.nome,
                        d.profissao,
                        d.descricao,
                        d.rede1,
                        d.rede2,
                        d.rede3,
                        d.rede4,
                        f.caminho as caminho
                  FROM dados as d

                  inner join fotos as f
                  on d.id = f.id_dados ";
        $this->data['dados'] = R::getAll($sqlps);
                
        /* Breadcrumbs */
        //$this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Nome do Botão Criar do INDEX */
        $this->data['texto_btn_create'] = 'Marcar Atendimento';

        /* Data */
        $this->data['error'] = NULL;


        // Caso sistema funcione apenas logado, descomentar a linha abaixo e importar o helper URL no construtor
        redirect("admin");
       $this->data['modulo_meiogeral'] = $this->load->view('public/includes/meiogeral.php', $this->data, TRUE);	
       $this->data['modulo_cabecalho'] = $this->load->view('public/includes/header.php', $cfg, TRUE);	
       $this->data['modulo_rodape'] = $this->load->view('public/includes/footer.php',$cfg, TRUE);      
       $this->data['modulo_menu'] = $this->load->view('public/includes/menu.php', $this->data, TRUE);	
       $this->data['modulo_meio'] = $this->load->view('public/includes/meio.php', $this->data, TRUE);	

        $this->load->view('public/home', $this->data);
	}
    public function getmesas() {
        $tipo = R::findAll("mesas");
		foreach ($tipo as $e) {
			$options[$e->id] = $e->descricao;
		}
		return $options;
    }
	public function gettempo() {
        $sql = "SELECT id,hora FROM tempo ";

        $options = array("0" => "Selecione uma Hora");
                
        $tem = R::getAll($sql);        

		foreach ($tem as $t) {   
            $options[$t['id']] = $t['hora'];           
        }
		return $options;
    }
    public function deleteyes($dt,$hr) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}
		
		$time = strtotime($dt);
		$dat = date('y-m-d',$time); 

		//var_dump($dat,$hr);
		//die;		
		
		$sql = "SELECT  t.id,
						t.hora as ht,
						ag.id as iddel,
						ag.hora as ha,
						ag.dagenda,
						ag.idpsico
				from tempo as t

				inner join agenda as ag
				on t.id = ag.hora

				where t.hora = '$hr' AND ag.dagenda = '$dat' "; 

		 $this->data['agend'] = R::getAll($sql);

		//var_dump($this->data['agend']);
		//die;

		 foreach ($this->data['agend'] as $pa){ }

		// var_dump($pa['iddel']);
		// die;

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("agenda", $pa['iddel']);
			R::trash($lixo);
		}
		redirect('admin/calendar', 'refresh');
	}
    public function create(){
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Atendimento", 'admin/calendar/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Marcar Hora';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('hora', 'hora', 'required');
		$this->form_validation->set_rules('dagenda', 'dagenda', 'required');
		$this->form_validation->set_rules('idmesas', 'idmesas', 'required');
		        
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$agend = R::dispense("agenda");
            $agend->hora = $this->input->post('hora');
            $agend->dagenda = $this->input->post('dagenda');
            $agend->idmesas = $this->input->post('idmesas');
            
			R::store($agend);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/calendar', 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

			$this->data['hora'] = array(
                'name'  => 'hora',
                'id'    => 'hora',
                'options' => $this->gettempo(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('hora'),
            );
			
            
            $this->data['dagenda'] = array(
                'name'  => 'dagenda',
                'id'    => 'dagenda',
                'type'  => 'Date',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('dagenda'),
            );

			$this->data['idmesas'] = array(
                'name'  => 'idmesas',
                'id'    => 'idmesas',
                'options' => $this->getmesas(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idmesas'),
            );
			
        }         
        /* Load Template */
        $this->template->admin_render('public/home/create', $this->data);
    }
}//fim da class
