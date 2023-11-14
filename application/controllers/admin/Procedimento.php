<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class procedimento extends Admin_Controller {

	public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('procedimento'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->load->library("Pdf");
		
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');


	}
	public function index(){  
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{ redirect('auth/login', 'refresh');
        }else {
			/* dados  */
			// pega o id do usuário logado----($user_id)
			//$user_id = $this->session->user_id;
		    $this->data['procede'] = R::findAll("procedimento");
		   /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Adicionar Procedimento';
			/* Data */
			$this->data['error'] = NULL;
			//$this->data['aparelhos'] = R::findAll('aparelhos');
			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }
    public function create($id){
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Procedimento", 'admin/procedimento/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Adicionar Procedimento';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
		$this->data['idview'] = $id;
		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        
		/* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			//pegar data atual se data vazia
				$dt = $this->input->post('dtcad');
				if($dt == ''){
					$dt = date('Y/m/d');
				}       
			$procede = R::dispense("procedimento");
				$procede->idpa = $id;
				$procede->descricao = $this->input->post('descricao');
				$procede->titulo    = $this->input->post('titulo');
				$procede->dtcad     = $dt;
           R::store($procede);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/pacientes/view/'.$id, 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

			$this->data['id'] = array(
				'id' => $id,
			);

            $this->data['descricao'] = array(
                'name'  => 'descricao',
                'id'    => 'descricao',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('descricao'),
            );
			$this->data['titulo'] = array(
                'name'  => 'titulo',
                'id'    => 'titulo',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('titulo'),
            );
            $this->data['idpa'] = array(
                'name'  => 'idpa',
                'id'    => 'idpa',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idpa'),
            );
			$this->data['dtcad'] = array(
                'name'  => 'dtcad',
                'id'    => 'dtcad',
                'type'  => 'date',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('dtcad'),
            );
	    }         
        /* Load Template */
        $this->template->admin_render('admin/procedimento/create', $this->data);
    }
	public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/pacientes', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("procedimento", $id);
			R::trash($lixo);
		}
		redirect('admin/pacientes', 'refresh');
	}
	public function edit($id,$idpa) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Procedimento", 'admin/procedimento/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['idview'] = $idpa;
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Procedimento';
		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
		$this->form_validation->set_rules('titulo', 'titulo', 'required');
		//pegar data atual se data vazia
		$dt = $this->input->post('dtcad');
		if($dt == ''){
			$dt = date('Y/m/d');
		} 
		$procede = R::load("procedimento", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$procede->descricao = $this->input->post('descricao');
				$procede->titulo    = $this->input->post('titulo');
				$procede->dtcad     = $dt;
			R::store($procede);

				redirect('admin/pacientes/view/'.$idpa, 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $procede->id,
		);

		$this->data['descricao'] = array(
			'name'  => 'descricao',
			'id'    => 'descricao',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $procede->descricao,
		);
		$this->data['titulo'] = array(
			'name'  => 'titulo',
			'id'    => 'titulo',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $procede->titulo,
		);
        $this->data['dprocede'] = array(
			'name'  => 'dprocede',
			'id'    => 'dprocede',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $procede->dprocede,
        );
		$this->data['idpa'] = array(
			'name'  => 'idpa',
			'id'    => 'idpa',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $procede->idpa,
		);
        $this->data['dtcad'] = array(
			'name'  => 'dtcad',
			'id'    => 'dtcad',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $procede->dtcad,
		);
		
		/* Load Template */
		$this->template->admin_render('admin/procedimento/edit', $this->data);
	}
	public function view($id,$idpa){
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
			{ redirect('auth/login', 'refresh'); }
		else{ 
		
		$this->data['idview'] = $idpa;
		/* -- Breadcrumbs ----------------------------------------------------*/
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->anchor = 'admin/' . $this->router->class;
		/* -- Data -----------------------------------------------------------*/
		$this->data['error'] = NULL;

		//--- dados do procedimento --------------	
		$sql2 ="SELECT  id,titulo,
						descricao,
						idpa,
						date_format(dtcad, '%d/%m/%Y') as dtcad
			 from procedimento  
			where id = " . $id;
			$this->data["procedimento"] = R::getAll($sql2);	

		$sql=" SELECT * FROM pacientes where id = " .$idpa;	
		$this->data["pacie"] = R::getAll($sql);	

			$this->template->admin_render('admin/procedimento/view', $this->data);
		}
	}

	public function imprime($id,$idpa){
		$procede  = R::load("procedimento", $id);
		$paciente = R::load("pacientes" , $idpa);

		//--cria o nome do arquivo pdf
		$nome  = $procede->titulo;
		$nomearquivo = $nome .date('d-m-Y') . '.pdf';
		
		//---titulo do laudo
		$titulo ='<h3 align="center">'. $procede->titulo .'</h3>' ;
		//--texto do laudo
		$texto = 'teste de inclusao para laudo escrito do fulano &nbsp;';
		$texto .= $paciente->nome;
		$texto .= '&nbsp;segue testo do laudo';
		//--descricao digitada no clinica
		$desc = $procede->descricao;
		
		//--dados a serem mostrados
		$dadospdf = $titulo .$texto .$desc ;
		$pdf = $this->pdf->createPDF($dadospdf, $nomearquivo, true, true);

		//echo $pdf;
	
	}

}//fim da class
