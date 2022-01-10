<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class analises extends Admin_Controller {

	public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('analises'));
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
			// pega o id do usuário logado----($user_id)
			//$user_id = $this->session->user_id;
			
		    $this->data['analise'] = R::findAll("analises");
		   

           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Criar Analises';

			/* Data */
			$this->data['error'] = NULL;

			//$this->data['aparelhos'] = R::findAll('aparelhos');


			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }
    public function create($id){
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Analises", 'admin/analises/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Criar Analises';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$analise = R::dispense("analises");
            $analise->descricao = $this->input->post('descricao');
            $analise->idpa = $id;
            
			R::store($analise);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/pacientes', 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['descricao'] = array(
                'name'  => 'descricao',
                'id'    => 'descricao',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('descricao'),
            );
            
           $this->data['idpa'] = array(
                'name'  => 'idpa',
                'id'    => 'idpa',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idpa'),
            );
           
        }         
        /* Load Template */
        $this->template->admin_render('admin/analises/create', $this->data);
    }
    public function deleteyes($id){
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/pacientes', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("analises", $id);
			R::trash($lixo);
		}
		redirect('admin/pacientes', 'refresh');
	}
    public function edit($id){
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Analises", 'admin/analises/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Analises';
		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
		
		$analise = R::load("analises", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$analise->descricao = $this->input->post('descricao');
           		
				R::store($analise);

				redirect('admin/pacientes', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $analise->id,
		);

		$this->data['descricao'] = array(
			'name'  => 'descricao',
			'id'    => 'descricao',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $analise->descricao,
		);
		
		$this->data['danalise'] = array(
			'name'  => 'danalise',
			'id'    => 'danalise',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $analise->danalise,
		);
		$this->data['idpa'] = array(
			'name'  => 'idpa',
			'id'    => 'idpa',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $analise->idpa,
		);
        
		
		/* Load Template */
		$this->template->admin_render('admin/analises/edit', $this->data);
	}


}
