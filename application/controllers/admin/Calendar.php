<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class calendar extends Admin_Controller {

	public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('pacientes'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');


	}
	public function index($id = null)	{  
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
        }
        else
        {
			$user_id = $this->session->user_id;//pega id do usuario logado
			
			// load calendar
            $this->load->library('calendar');
			//$this->data['agenda'] = R::load("agenda", $id);
			if ($user_id == 1){
				$sql = "SELECT 
						ag.id,
						te.hora as hora,
						ag.start_date as dtinicial,
						ag.color as color,
						SUBSTRING_INDEX(SUBSTRING_INDEX(pa.nome, ' ', 1), ' ', -1) as nome     
					FROM `agenda`as ag

					inner join tempo as te
					on te.id = ag.hora

					inner join pacientes as pa
					on pa.id = ag.idpaciente"; 
			}else{	
				$sql = "SELECT 
						ag.id,
						te.hora as hora,
						ag.start_date as dtinicial,
						ag.color as color,
						pa.ativo,
						SUBSTRING_INDEX(SUBSTRING_INDEX(pa.nome, ' ', 1), ' ', -1) as nome     
					FROM `agenda`as ag
		
					inner join tempo as te
					on te.id = ag.hora
	
					inner join pacientes as pa
					on pa.id = ag.idpaciente
		
					WHERE ag.user_id ='.$user_id.' and pa.ativo = 1";
			}
			$this->data['agend'] = R::getAll($sql);

           if($id != 0 ){
			//--busca para mostrar no modal_mostra
				$sqlid = "SELECT  ag.id as id,	te.hora as hora, ag.start_date as dtinicial, ag.color as color, pa.nome as nome, pa.email,pa.telefone, pa.endereco
							FROM agenda as ag

							inner join tempo as te
							on te.id = ag.hora

							inner join pacientes as pa
							on pa.id = ag.idpaciente

							where ag.id =".$id; 
				$this->data['agenda'] = R::getAll($sqlid);
			}
			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Marcar Atendimento';

			/* Data */
			$this->data['error'] = NULL;
			
			$this->data['idpaciente'] = array(
                'name'  => 'idpaciente',
                'id'    => 'idpaciente',
                'options' => $this->getpaciente(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idpaciente'),
            );
			$this->data['hora'] = array(
                'name'  => 'hora',
                'id'    => 'hora',
                'options' => $this->gettempo(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('hora'),
            );
			$this->data['color'] = array(
               'name'  => 'color',
                'id'    => 'color',
                'options' => $this->getcolor(),
				'class' => 'form-control',
				//'style'=> 'color: '.$this->getstyle(),
                'value' => $this->form_validation->set_value('color'),
            );
			$this->data['start_date'] = array(
				'name'  => 'start_date',
				'id'    => 'start_date',
				'type'  => 'date',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('start_date'),
			);

			/* Load Template */
			$this->template->admin_render('admin/calendar/index', $this->data);
        }
    }
	public function create(){
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Horário", 'admin/calendar/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Criar Calendario';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('idpaciente', 'Nome', 'required');
		$user_id = $this->session->user_id;      
        
		$dat = $this->input->post('start_date');
		$hor = $this->input->post('hora');

		//var_dump($hor,$dat);die;
		$test = testaagenda($hor,$dat);
		
		/* cria a tabela com seus campos */
		if ($this->form_validation->run()) {

			$age = R::dispense("agenda");
            $age->idpaciente = $this->input->post('idpaciente');
            $age->hora = $this->input->post('hora');
            $age->color = $this->input->post('color');
            $age->start_date = $this->input->post('start_date');
            $age->user_id = $user_id;

			R::store($age);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/calendar', 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

			$this->data['idpaciente'] = array(
                'name'  => 'idpaciente',
                'id'    => 'idpaciente',
                'options' => $this->getpaciente(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idpaciente'),
            );
			$this->data['hora'] = array(
                'name'  => 'hora',
                'id'    => 'hora',
                'options' => $this->gettempo(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('hora'),
            );
			$this->data['start_date'] = array(
				'name'  => 'start_date',
				'id'    => 'start_date',
				'type'  => 'date',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('start_date'),
			);
        }         
        /* Load Template */
        $this->template->admin_render('admin/calendar/create', $this->data);
    }
	public function getusers() {
        $sql = "SELECT 	concat(u.first_name, ' ',u.last_name)  as username,
						u.id 
						
				FROM users_groups as ug

		inner join groups as g
		on g.id = ug.group_id
		
		inner join users as u
		on u.id = ug.user_id
		
		where g.name = 'psicologa'";

        $options = array("0" => "Selecione uma Psicologa");
                
        $agen = R::getAll($sql);        

		foreach ($agen as $a) {   
            $options[$a['id']] = $a['username'];           
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
	public function getpaciente() {
		$user_id = $this->session->user_id;

		if ($user_id == 1){
			$sql = "SELECT id,nome,id_psico,ativo FROM pacientes where ativo = 1";
		}else{
			$sql = "SELECT id,nome,id_psico,ativo FROM pacientes where id_psico =" .$user_id. " and ativo = 1";
		}
   
        $options = array("0" => "Selecione um Paciente");
                
        $tem = R::getAll($sql);        

		foreach ($tem as $t) {   
            $options[$t['id']] = $t['nome'];           
        }
		return $options;
    }
    public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}
		
		
		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("agenda", $id);
			R::trash($lixo);
		}
		redirect('admin/calendar', 'refresh');
	}
    public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Agenda", 'admin/agenda/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Agenda';
		/* Validate form input */
		$this->form_validation->set_rules('hora', 'hora', 'required');
		$this->form_validation->set_rules('dagenda', 'dagenda', 'required');
		$this->form_validation->set_rules('idpsico', 'idpsico', 'required');
		
		$agend = R::load("agenda", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$agend->hora = $this->input->post('hora');
				$agend->dagenda = $this->input->post('dagenda');
            	$agend->id_psico = $this->input->post('idpsico');
				
								
				R::store($agend);

				redirect('admin/calendar/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $agend->id,
		);

		$this->data['hora'] = array(
            'name'  => 'hora',
            'id'    => 'hora',
            'selected'=>$agend->hora,	
            'options'  => $this->gettempo(),
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hora'),
        );

        $this->data['dagenda'] = array(
			'name'  => 'dagenda',
			'id'    => 'dagenda',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $agend->dagenda,
        );
        
		
		$this->data['idpsico'] = array(
            'name'  => 'idpsico',
            'id'    => 'idpsico',
            'selected'=>$agend->idpsico,	
            'options'  => $this->getusers(),
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('idpsico'),
        );

		/* Load Template */
		$this->template->admin_render('admin/calendar/edit', $this->data);
	}
	public function save()	{
		
		$idpac   = $this->input->post('idpaciente');
		$hor     = $this->input->post('hora');
		$st      = $this->input->post('start_date');
		$cor     = $this->input->post('color');
		$user_id = $this->session->user_id;

	  	$sql = "SELECT *		 
				FROM agenda
				where start_date = '$st' ";
		
		$age = R::getAll($sql); 
		
		$teste = 0;
		foreach($age as $ag){
			if($ag['hora'] == $hor){
				//ja existe a hora na data
				$testehora = 1;
				break;

			}else{
				//nao existe a hora na data
				$testehora = 2;
				
			}
		}
		
		$this->form_validation->set_rules('idpaciente', 'Nome do paciente é obrigatório ', 'required');
		if ($this->form_validation->run() == TRUE){
			if($testehora == 1)
			{
				$this->data['message'] = "<p class='alert alert-success'>Horario já existente. </p>";
				//error.insertAfter('.section_erro');   
				//$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');	
			}else{
				$agend = R::dispense("agenda");
					$agend->idpaciente = $idpac;
					$agend->hora = $hor;
					$agend->color = $cor;
					$agend->start_date = $st;
					$agend->user_id = $user_id;
					
				R::store($agend);
			}
		}
		      
		$this->session->set_flashdata('message', "Dados gravados");
        redirect('admin/calendar/', 'refresh');
		
	}
	public function idmostra($id){
		$sqlid = "SELECT  ag.id as id,
						  te.hora as hora, 
						  ag.start_date as dtinicial, 
						  ag.color as color, 
						  pa.nome as nome, 
						  pa.email,
						  pa.telefone as telefone, 
						  pa.endereco
							FROM agenda as ag

							inner join tempo as te
							on te.id = ag.hora

							inner join pacientes as pa
							on pa.id = ag.idpaciente

							where ag.id =".$id; 
				$this->data["agenda"] = R::getAll($sqlid);
				
				foreach ($this->data["agenda"] as $ag){
					$result = $ag;
				}	
		
		echo json_encode($result);		
	
	}
	public function getcolor(){
		$sql = "SELECT id,cor,nome FROM cores ";

        $options = array("0" => "Selecione uma Cor" );
                
        $tem = R::getAll($sql);        
		foreach ($tem as $t) {   
            $options[$t['id']] = $t['nome'];
			//$selected = $t['cor'];		
	    }
		return $options;
	}
/*	public function getstyle(){
		$sql = "SELECT id,cor,nome FROM cores ";
                      
        $tem = R::getAll($sql);        
		foreach ($tem as $t) {   
            $selected = $t['cor'];		
	    }
		return $selected;
	}
*/
}//fim da class
