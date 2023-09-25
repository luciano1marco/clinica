<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pacientes extends Admin_Controller {

	public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('pacientes'));
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
		   // $this->data['paciente'] = R::findAll("pacientes");
		   if ($user_id == 1){
					$sql = "SELECT id,nome,email,telefone,id_psico,ativo,
									date_format(dtnasc, '%d/%m/%Y') as dtnasc
	 						FROM pacientes "; 
		   }else{
					$sql = "SELECT p.id,p.nome,p.email,p.telefone, p.id_psico,p.ativo,
								   date_format(dtnasc, '%d/%m/%Y') as dtnasc
					FROM pacientes as p

					inner join users as u 
					on p.id_psico = u.id
					
					where u.id = ". $user_id ;
		   }
			$this->data['paciente'] = R::getAll($sql);
           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Adicionar Paciente';
			/* Data */
			$this->data['error'] = NULL;
			//$this->data['aparelhos'] = R::findAll('aparelhos');
			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }
    public function create(){

		$user_id = $this->session->user_id;
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Paciente", 'admin/pacientes/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Adiconar Paciente';
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
			
			$paciente = R::dispense("pacientes");
				$paciente->nome     = $this->input->post('nome');
				$paciente->email    = $this->input->post('email');
				$paciente->telefone = $this->input->post('telefone');
				$paciente->endereco = $this->input->post('endereco');
				$paciente->dtcad    = $dt;
				$paciente->cpf      = $this->input->post('cpf');
				$paciente->dtnasc   = $this->input->post('dtnasc');
				$paciente->id_psico = $user_id;
            R::store($paciente);

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
			$this->data['id_psico'] = array(
                'name'  => 'id_psico',
                'id'    => 'id_psico',
                'options' => $this->getusers(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('id_psico'),
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
        $this->template->admin_render('admin/pacientes/create', $this->data);
    }
	public function getusers(){
        $sql = "SELECT u.username,u.first_name,u.id FROM users_groups as ug

		inner join groups as g
		on g.id = ug.group_id
		
		inner join users as u
		on u.id = ug.user_id
		
		where g.name = 'Psicologa'";

        $options = array("0" => "Selecione uma Psicologa");
                
        $bairros = R::getAll($sql);        

		foreach ($bairros as $b) {   
            $options[$b['id']] = $b['first_name'];           
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
			redirect('admin/pacientes', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("pacientes", $id);
			R::trash($lixo);
		}
		redirect('admin/pacientes', 'refresh');
	}
    public function edit($id){
		$id = (int) $id;
		$user_id = $this->session->user_id;
		$this->dados['idview'] = $id;
		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Pacientes", 'admin/pacientes/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['idview'] = $id;
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Paciente';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
		
		$paciente = R::load("pacientes", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$paciente->nome = $this->input->post('nome');
				$paciente->email = $this->input->post('email');
           		$paciente->telefone = $this->input->post('telefone');
            	$paciente->endereco = $this->input->post('endereco');
            	$paciente->cpf = $this->input->post('cpf');
				$paciente->dtcad = $this->input->post('dtcad');
				$paciente->dtnasc = $this->input->post('dtnasc');
				$paciente->id_psico = $user_id;
								
				R::store($paciente);

				redirect('admin/pacientes/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $paciente->id,
		);

		$this->data['nome'] = array(
			'name'  => 'nome',
			'id'    => 'nome',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $paciente->nome,
		);

        $this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $paciente->email,
        );
        
		$this->data['telefone'] = array(
			'name'  => 'telefone',
			'id'    => 'telefome',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $paciente->telefone,
		);
		$this->data['endereco'] = array(
			'name'  => 'endereco',
			'id'    => 'endereco',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $paciente->endereco,
		);
		
		$this->data['cpf'] = array(
			'name'  => 'cpf',
			'id'    => 'cpf',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $paciente->cpf,
		);
		$this->data['id_psico'] = array(
			'name'  => 'id_psico',
			'id'    => 'id_psico',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $paciente->id_psico,
		);
		$this->data['dtcad'] = array(
			'name'  => 'dtcad',
			'id'    => 'dtcad',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $paciente->dtcad,
		);
		$this->data['dtnasc'] = array(
			'name'  => 'dtnasc',
			'id'    => 'dtnasc',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $paciente->dtnasc,
		);

		/* Load Template */
		$this->template->admin_render('admin/pacientes/edit', $this->data);
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
			$sql = "SELECT  	
						p.id,
						p.nome as nomep,
						p.email as emailp,
						p.telefone as telefonep,
						p.endereco enderecop,
						p.cpf as cpfp,
						date_format(p.dtcad, '%d/%m/%Y') as dtcadp,
						p.dtnasc as dtnascp,
						pe.id as idpe,
						pe.nome as nomepe,
						pe.email as emailpe,
						pe.telefone as telefonepe,
						pe.endereco as enderecope,
						pe.grau as graupe,
						pe.cpf as cpfpe,
						date_format(pe.dtcad, '%d/%m/%Y') as dtcadpe,
						pe.dtnasc as dtnascpe,
						g.descricao as grau
				FROM pacientes as p

				left join parentes as pe
				on pe.idpa = p.id
				
				left join grau as g
				on g.id = pe.grau

				where p.id =   " .$id;

			$this->data['paciente'] = R::getAll($sql);			
			
			//--- dados do descatende --------------	
			$sql1 ="SELECT  id,titulo,
							descricao,
							idpa,
							date_format(dtcad, '%d/%m/%Y') as dtcad

				from descatende  
			
				where idpa = " . $id;

			$this->data["descatende"] = R::getAll($sql1);	

			//--- dados do procedimento --------------	
			$sql2 ="SELECT  id,titulo,
							descricao,
							idpa,
							date_format(dtcad, '%d/%m/%Y') as dtcad
			
				 from procedimento  
			
				where idpa = " . $id;

			$this->data["procedimento"] = R::getAll($sql2);	

			//--- dados da analise --------------	
			$sql3 ="SELECT  id,titulo,
							descricao,
							idpa,
							date_format(dtcad, '%d/%m/%Y') as dtcad
			
					from analises 
			
					where idpa = " .$id;

			$this->data['analise'] = R::getAll($sql3);	

			//--- dados da conclusao --------------	
			$sql4 ="SELECT  id,titulo,
							descricao,
							idpa,
							date_format(dtcad, '%d/%m/%Y') as dtcad
			
				from conclusao  
			
				where idpa = " . $id;

			$this->data["conclusao"] = R::getAll($sql4);	


			//---
			$this->template->admin_render('admin/pacientes/view', $this->data);

		}

 	}   
	 function activate($id) {
		$id = (int) $id;

		$conc = R::load("pacientes", $id);
		$conc->ativo = 1;
		R::store($conc);
		
		$this->session->set_flashdata('message', "Paciente ativado");
		redirect('admin/pacientes', 'refresh');
	}
    public function deactivate($id) {
    
		$id = (int) $id;

		$conc = R::load("pacientes", $id);
		$conc->ativo = 0;
		R::store($conc);
		
		$this->session->set_flashdata('message', "Paciente Inativo");
		redirect('admin/pacientes', 'refresh');    

    } 
}//fim da class
