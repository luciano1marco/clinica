<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class parentes extends Admin_Controller {

	public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('parentes'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');


	}
	public function index(){  
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{ redirect('auth/login', 'refresh');
        } else {
			/* dados  */
			// pega o id do usuário logado----($user_id)
			$user_id = $this->session->user_id;
		   // $this->data['parentes'] = R::findAll("parentes");
		    /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Adicionar Familiar';
			/* Data */
			$this->data['error'] = NULL;
			//$this->data['aparelhos'] = R::findAll('aparelhos');
			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }
    public function create($id){

		$this->data['idpa'] = $id;
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Familiar", 'admin/parentes/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Adiconar Familiar';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			//pegar data atual se data vazia
			$dt = $this->input->post('dtcad');
			if($dt == ''){
				$dt = date('Y/m/d');
			} 
			
			$parentes = R::dispense("parentes");
				$parentes->nome     = $this->input->post('nome');
				$parentes->email    = $this->input->post('email');
				$parentes->telefone = $this->input->post('telefone');
				$parentes->endereco = $this->input->post('endereco');
				$parentes->dtcad    = $dt;
				$parentes->dtnasc   = $this->input->post('dtnasc');
				$parentes->cpf      = $this->input->post('cpf');
				$parentes->grau     = $this->input->post('grau');
				$parentes->idpa     = $id;
            R::store($parentes);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/pacientes', 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['nome'] = array(
                'name'  => 'nome',
                'id'    => 'nome',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('nome'),
            );
            
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email'),
            );

            $this->data['telefone'] = array(
                'name'  => 'telefone',
                'id'    => 'telefome',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('telefone'),
			);
			$this->data['endereco'] = array(
                'name'  => 'endereco',
                'id'    => 'endereco',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('endereco'),
			);
			
			$this->data['cpf'] = array(
                'name'  => 'cpf',
                'id'    => 'cpf',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('cpf'),
			);
			$this->data['grau'] = array(
                'name'  => 'grau',
                'id'    => 'grau',
                'options' => $this->getgrau(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('grau'),
            );
			$this->data['dtcad'] = array(
                'name'  => 'dtcad',
                'id'    => 'dtcad',
                'type'  => 'date',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('dtcad'),
			);
			$this->data['dtnasc'] = array(
                'name'  => 'dtnasc',
                'id'    => 'dtnasc',
                'type'  => 'date',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('dtnasc'),
			);

        }         
        /* Load Template */
        $this->template->admin_render('admin/parentes/create', $this->data);
    }
	public function getgrau(){
        $sql = "SELECT * FROM grau";
        $options = array("0" => "Selecione Grau de Parentensco");
        $resp = R::getAll($sql);        
		foreach ($resp as $r) {   
            $options[$r['id']] = $r['descricao'];           
        }
		return $options;
    }
    public function deleteyes($id){
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/parentes', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("parentes", $id);
			R::trash($lixo);
		}
		redirect('admin/parentes', 'refresh');
	}
    public function edit($id,$idp){
		$id = (int) $id;
		$user_id = $this->session->user_id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar parentes", 'admin/parentes/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['idview'] = $idp;
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Familiar';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
		
		$parentes = R::load("parentes", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$parentes->nome     = $this->input->post('nome');
				$parentes->email    = $this->input->post('email');
				$parentes->telefone = $this->input->post('telefone');
				$parentes->endereco = $this->input->post('endereco');
				$parentes->dtcad    = $dt;
				$parentes->dtnasc   = $this->input->post('dtnasc');
				$parentes->cpf      = $this->input->post('cpf');
				$parentes->grau     = $this->input->post('grau');
				//$parentes->idpa     = $idp;
								
				R::store($parentes);

				redirect('admin/parentes/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $parentes->id,
		);

		$this->data['nome'] = array(
			'name'  => 'nome',
			'id'    => 'nome',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $parentes->nome,
		);

        $this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $parentes->email,
        );
        
		$this->data['telefone'] = array(
			'name'  => 'telefone',
			'id'    => 'telefome',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $parentes->telefone,
		);
		$this->data['endereco'] = array(
			'name'  => 'endereco',
			'id'    => 'endereco',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $parentes->endereco,
		);
		
		$this->data['cpf'] = array(
			'name'  => 'cpf',
			'id'    => 'cpf',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $parentes->cpf,
		);
		$this->data['grau'] = array(
			'name'  => 'grau',
			'id'    => 'grau',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $parentes->grau,
		);
		$this->data['dtcad'] = array(
			'name'  => 'dtcad',
			'id'    => 'dtcad',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $parentes->dtcad,
		);
		$this->data['dtnasc'] = array(
			'name'  => 'dtnasc',
			'id'    => 'dtnasc',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $parentes->dtnasc,
		);

		/* Load Template */
		$this->template->admin_render('admin/parentes/edit', $this->data);
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

			//-----------dados parentes -----------------
			$sql = "SELECT  id,nome,email,telefone,endereco,cpf,
							date_format(dtcad, '%d/%m/%Y') as dtcad,
							dtnasc
					FROM parentes 
								 
					where id =  " .$id;

			$this->data['parentes'] = R::getAll($sql);			
			
			//--- dados do descatende --------------	
			$sql1 ="SELECT  id,titulo,
							descricao,
							idpa,
							date_format(dtcad, '%d/%m/%Y') as dtcad

				from descatende  
			
				where idpa = " . $id;

			$this->data["descatende"] = R::getAll($sql1);	

			//--- dados do procedimento --------------	
			$sql1 ="SELECT  id,titulo,
							descricao,
							idpa,
							date_format(dtcad, '%d/%m/%Y') as dtcad
			
				 from procedimento  
			
				where idpa = " . $id;

			$this->data["procedimento"] = R::getAll($sql1);	

			//--- dados da analise --------------	
			$sql2 ="SELECT  id,titulo,
							descricao,
							idpa,
							date_format(dtcad, '%d/%m/%Y') as dtcad
			
					from analises 
			
					where idpa = " .$id;

			$this->data['analise'] = R::getAll($sql2);	

			//--- dados da conclusao --------------	
			$sql1 ="SELECT  id,titulo,
							descricao,
							idpa,
							date_format(dtcad, '%d/%m/%Y') as dtcad
			
				from conclusao  
			
				where idpa = " . $id;

			$this->data["conclusao"] = R::getAll($sql1);	


			//---
			$this->template->admin_render('admin/parentes/view', $this->data);

		}

 	}   
	 function activate($id) {
		$id = (int) $id;

		$conc = R::load("parentes", $id);
		$conc->ativo = 1;
		R::store($conc);
		
		$this->session->set_flashdata('message', "parentes ativado");
		redirect('admin/parentes', 'refresh');
	}
    public function deactivate($id) {
    
		$id = (int) $id;

		$conc = R::load("parentes", $id);
		$conc->ativo = 0;
		R::store($conc);
		
		$this->session->set_flashdata('message', "parentes Inativo");
		redirect('admin/parentes', 'refresh');    

    } 
}//fim da class
