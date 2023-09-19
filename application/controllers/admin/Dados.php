<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dados extends Admin_Controller {

	public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('dados'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');


	}
	public function index(){  
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
        }
        else
        {
			/* dados  */
			// pega o id do usuário logado----($user_id)
			$user_id = $this->session->user_id;
			
		  // $this->data['dado'] = R::findAll("dados");
		  //$this->data['foto'] = R::findAll("fotos");
		  //select para consulta de usuario logado	
		  $sql = "SELECT * FROM dados where id_user = ".$user_id;
		  $this->data['dado'] = R::getAll($sql);

           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Preencher Dados';

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
		$this->breadcrumbs->unshift(2, "Novo dado", 'admin/dados/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Adicionar dados';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
                
        /* cria a tabela com seus campos */
		$dado = R::dispense("dados");
		if ($this->form_validation->run()) {
				$dado->id_user = $user_id;
				$dado->nome = $this->input->post('nome');
				$dado->telefone = $this->input->post('telefone');
				$dado->profissao = $this->input->post('profissao');
				$dado->descricao = $this->input->post('descricao');
				$dado->rede1 = $this->input->post('rede1');
				$dado->rede2 = $this->input->post('rede2');
				$dado->rede3 = $this->input->post('rede3');
				$dado->rede4 = $this->input->post('rede4');
								
				R::store($dado);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/dados', 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

			$this->data['nome'] = array(
				'name'  => 'nome',
				'id'    => 'nome',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $dado->nome,
			);
			
			$this->data['telefone'] = array(
				'name'  => 'telefone',
				'id'    => 'telefome',
				'type'  => 'int',
				'class' => 'form-control',
				'value' => $dado->telefone,
			);
			$this->data['profissao'] = array(
				'name'  => 'profissao',
				'id'    => 'profissao',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $dado->profissao,
			);
			
			$this->data['imagem'] = array(
				'name'  => 'imagem',
				'id'    => 'imagem',
				'type'  => 'int',
				'class' => 'form-control',
				'value' => $dado->imagem,
			);
			$this->data['descricao'] = array(
				'name'  => 'descricao',
				'id'    => 'descricao',
				'type'  => 'int',
				'class' => 'form-control',
				'value' => $dado->descricao,
			);
			$this->data['rede1'] = array(
				'name'  => 'rede1',
				'id'    => 'rede1',
				'type'  => 'int',
				'class' => 'form-control',
				'value' => $dado->rede1,
			);
			$this->data['rede2'] = array(
				'name'  => 'rede2',
				'id'    => 'rede2',
				'type'  => 'int',
				'class' => 'form-control',
				'value' => $dado->rede2,
			);
			$this->data['rede3'] = array(
				'name'  => 'rede3',
				'id'    => 'rede3',
				'type'  => 'int',
				'class' => 'form-control',
				'value' => $dado->rede3,
			);
			$this->data['rede4'] = array(
				'name'  => 'rede4',
				'id'    => 'rede4',
				'type'  => 'int',
				'class' => 'form-control',
				'value' => $dado->rede4,
			);
        }         
        /* Load Template */
        $this->template->admin_render('admin/dados/create', $this->data);
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

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Dados", 'admin/pacientes/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Dados';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
		
		$dado = R::load("dados", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$dado->nome = $this->input->post('nome');
				$dado->telefone = $this->input->post('telefone');
				$dado->profissao = $this->input->post('profissao');
				$dado->imagem = $this->input->post('imagem');
				$dado->descricao = $this->input->post('descricao');
				$dado->rede1 = $this->input->post('rede1');
				$dado->rede2 = $this->input->post('rede2');
				$dado->rede3 = $this->input->post('rede3');
				$dado->rede4 = $this->input->post('rede4');
								
				R::store($dado);

				redirect('admin/dados/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $dado->id,
		);

		$this->data['nome'] = array(
			'name'  => 'nome',
			'id'    => 'nome',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $dado->nome,
		);
		
		$this->data['telefone'] = array(
			'name'  => 'telefone',
			'id'    => 'telefome',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $dado->telefone,
		);
		$this->data['profissao'] = array(
			'name'  => 'profissao',
			'id'    => 'profissao',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $dado->profissao,
		);
		
		$this->data['imagem'] = array(
			'name'  => 'imagem',
			'id'    => 'imagem',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $dado->imagem,
		);
		$this->data['descricao'] = array(
			'name'  => 'descricao',
			'id'    => 'descricao',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $dado->descricao,
		);
		$this->data['rede1'] = array(
			'name'  => 'rede1',
			'id'    => 'rede1',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $dado->rede1,
		);
		$this->data['rede2'] = array(
			'name'  => 'rede2',
			'id'    => 'rede2',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $dado->rede2,
		);
		$this->data['rede3'] = array(
			'name'  => 'rede3',
			'id'    => 'rede3',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $dado->rede3,
		);
		$this->data['rede4'] = array(
			'name'  => 'rede4',
			'id'    => 'rede4',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $dado->rede4,
		);

		/* Load Template */
		$this->template->admin_render('admin/dados/edit', $this->data);
	}
	//--Aexar Arquivos-------------------------------- 
	public function arquivos($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Foto 3x4", 'admin/dados/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		//$ae = R::findAll("arquivosetapas", "etapa = {$id}");
		$sql ="	SELECT *
				FROM fotos
				where id_dados =".$id;

		$this->data['dado'] = R::load("dados", $id);
		//$this->data['arquivos'] = $ae;
		$this->data['fotos'] = R::getAll($sql);
		
		/* Load Template */
		$this->template->admin_render('/admin/dados/arquivos', $this->data);
	}    
	public function upload($id) {
		$nomesarquivos = $_FILES['fotos']['name'];
		//var_dump($nomesarquivos);
		//die;
	
		for ($i=0; $i<count($nomesarquivos); $i++) {
			$_FILES['fotos']['name'] = $_FILES['fotos']['name'][$i];
			$_FILES['fotos']['type'] = $_FILES['fotos']['type'][$i];
			$_FILES['fotos']['tmp_name'] = $_FILES['fotos']['tmp_name'][$i];
			$_FILES['fotos']['error'] = $_FILES['fotos']['error'][$i];
			$_FILES['fotos']['size'] = $_FILES['fotos']['size'][$i];

			if (!is_dir("upload/fotos/foto-".$id)) {                                 
				mkdir("upload/fotos/foto-".$id);
			}                        
			$config['upload_path'] = "upload/fotos/foto-".$id;
			$config['allowed_types'] = '*';
			$config['max_size'] = 10240;
			$config['file_name'] = $_FILES['fotos']['name'][$i];

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload("fotos")) {
				$datafile = $this->upload->data();
				
				$ae = R::dispense("fotos");
				$ae->id_dados = $id;
				$ae->arquivo = $_FILES['fotos']['name'];
				//$ae->arquivo = $datafile["file_name"];
				$nome = explode(".",$ae->arquivo);
				$ae->arquivo = $nome[0];

				$caminhotmp = explode("/",$datafile["full_path"]);
				

				$ae->caminho =$caminhotmp[6]."/".$caminhotmp[7];
				//var_dump($ae->caminho);
				//die;
				R::store($ae);
			}
		}

		redirect('admin/dados/arquivos/'.$id, 'refresh');
	}  
	//-----Deletar arquivos-----------------------------
 	public function apagararquivoestagio($id) {
	
		$ae = R::load("fotos", $id);
		$estagio = R::load("fotos", $ae->id_dados);//para fazer o refresh

		R::trash($ae);

		redirect('admin/dados/arquivos/' .$ae->id_dados, 'refresh');
	}
}//fim da class
