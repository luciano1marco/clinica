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
	public function index()	{  
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
        }
        else
        {
			/* dados  */
			// load calendar
            $this->load->library('calendar');
		  
			//dados do banco events
			//$this->data['evento'] = R::findAll("events");
			//$this->data['agend'] = R::findAll("agenda");
			$sql = "SELECT  	
						ag.id,
						te.hora as hora,
						dagenda,
						concat(us.first_name, ' ',us.last_name)  as nome	     

				FROM agenda as ag

				inner join users as us
				on us.id = ag.idpsico

				inner join tempo as te
				on ag.hora = te.id

				";

		$this->data['agend'] = R::getAll($sql);




           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Marcar Atendimento';

			/* Data */
			$this->data['error'] = NULL;

			/* Load Template */
			$this->template->admin_render('admin/calendar/index', $this->data);
        }
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
		$this->form_validation->set_rules('idpsico', 'idpsico', 'required');
		        
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$agend = R::dispense("agenda");
            $agend->hora = $this->input->post('hora');
            $agend->dagenda = $this->input->post('dagenda');
            $agend->idpsico = $this->input->post('idpsico');
            
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

			$this->data['idpsico'] = array(
                'name'  => 'idpsico',
                'id'    => 'idpsico',
                'options' => $this->getusers(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idpsico'),
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





}//fim da classe
