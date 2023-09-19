<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class atendimento extends Admin_Controller {

	public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('atendimento'));
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
			$this->data['atende'] = R::findAll("atendimento");

           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Adicionar Atendimento';

			/* Data */
			$this->data['error'] = NULL;

			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }
    public function create() {
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Atendimento", 'admin/atendimento/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Adicionar Atendimento';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$atende = R::dispense("atendimento");
				$atende->idpa = $this->input->post('idpa');
				$atende->descricao   = $this->input->post('descricao');
				$atende-> datende = date();
				$atende->conclusao = $this->input->post('conclusao');
          	R::store($atende);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/pacientes', 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['idpa'] = array(
                'name'  => 'idpa',
                'id'    => 'idpa',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idpa'),
            );
            
            $this->data['descricao'] = array(
                'name'  => 'descricao',
                'id'    => 'descricao',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('descricao'),
            );

           $this->data['conclusao'] = array(
                'name'  => 'conclusao',
                'id'    => 'conclusao',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('conclusao'),
			);
			
			
        }         
        /* Load Template */
        $this->template->admin_render('admin/atendimento/create', $this->data);
    }
    public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/atendimento', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("atendimento", $id);
			R::trash($lixo);
		}
		redirect('admin/atendimento', 'refresh');
	}
    public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Atendimento", 'admin/atendimento/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Atendimento';
		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
		
		$atende = R::load("atendimento", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {

				$atende->idpa = $this->input->post('idpa');
				$atende->descricao   = $this->input->post('descricao');
				$atende->datende = $this->input->post('datende');
				$atende->conclusao = $this->input->post('conclusao');
				
				R::store($atende);

				redirect('admin/atendimento/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $atende->id,
		);

		$this->data['idpa'] = array(
			'name'  => 'idpa',
			'id'    => 'idpa',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $atende->idpa,
		);
		
		$this->data['descricao'] = array(
			'name'  => 'descricao',
			'id'    => 'descricao',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $atende->descricao,
		);

		$this->data['conclusao'] = array(
			'name'  => 'conclusao',
			'id'    => 'conclusao',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $atende->conclusao,
		);
		$this->data['datende'] = array(
			'name'  => 'datende',
			'id'    => 'datende',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $atende->datende,
		);
		

		/* Load Template */
		$this->template->admin_render('admin/atendimento/edit', $this->data);
	}
	public function view($id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
            { redirect('auth/login', 'refresh'); }
        else{ 
			
			/* -- Breadcrumbs ----------------------------------------------------*/
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->anchor = 'admin/' . $this->router->class;
			/* -- Data -----------------------------------------------------------*/
            $this->data['error'] = NULL;

			//-----------dados paciente -----------------
			$sql = "SELECT  p.id, p.nome,p.email,p.telefone,p.endereco,p.cpf,p.id_psico,
							ate.id as idate,
							ate.descricao as atedescricao,
							ate.idpa, ate.conclusao, ate.datende
							
	 			FROM pacientes as p
	 
					inner join atendimento as ate
					on ate.idpa = p.id
					
				where p.id =  " .$id;

			$this->data['paciente'] = R::getAll($sql);			
			
			//--- dados do procedimento --------------	
			$sql1 ="SELECT * from procedimento  
			
				where id = " . $id;

			$this->data["procedimento"] = R::getAll($sql1);	

			//--- dados da analise --------------	
			$sql2 ="SELECT * from analises 
			where id = " .$id;

			$this->data['analise'] = R::getAll($sql2);	

			//---
			$this->template->admin_render('admin/atendimento/view', $this->data);

		}

 	}//fim função view    
}//fim da class
