<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sections extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		/* Title Page :: Common */
		$this->page_title->push("Sessões de Menu");
		$this->data['pagetitle'] = $this->page_title->show();

		/* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, "Sessões de Menu", 'admin/sections');
	}

	public function index()
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Data */
			$this->data['sections'] = R::findAll("menusection");
			
			/* Load Template */
			$this->template->admin_render('admin/sections/index', $this->data);
		}
	}

	public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Nova Sessão de Menu', 'admin/sections/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');

		if ($this->form_validation->run() == TRUE) {
			$section = R::dispense("menusection");
			$section->descricao = $this->input->post("descricao");
			$section->publicado = !empty($this->input->post("publicado"))?1:0;
			R::store($section);

			$this->session->set_flashdata('message', 'Seção de Menu criada');
			redirect('admin/sections', 'refresh');
		} 
		else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['descricao'] = array(
				'name'  => 'descricao',
				'id'    => 'descricao',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('descricao'),
			);
			$this->data['publicado'] = array(
				'name' 	=> 'publicado',
				'id'    => 'publicado',
				'class' => 'icheck',
				'type'  => 'checkbox',
				'value' => 1,
				'checked' => $this->form_validation->set_value('publicado', 1),
				'style' => 'margin-top:10px'
			);
			
			/* Load Template */
			$this->template->admin_render('admin/sections/create', $this->data);
		}
	}

	public function edit($id) {
		$id = (int) $id;

		$this->data['id'] = $id;

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Editar Sessão de Menu', 'admin/sections/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');

		$section = R::load("menusection", $id);
		if ($this->form_validation->run() == TRUE) {			
			$section->descricao = $this->input->post("descricao");
			$section->publicado = !empty($this->input->post("publicado"))?1:0;
			R::store($section);
			$this->session->set_flashdata('message', 'Seção de Menu atualizada');

			redirect('admin/sections', 'refresh');
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['descricao'] = array(
				'name'  => 'descricao',
				'id'    => 'descricao',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('descricao', $section->descricao),
			);

			$this->data['publicado'] = array(
				'name' 	=> 'publicado',
				'id'    => 'publicado',
				'class' => 'icheck',
				'type'  => 'checkbox',
				'value' => $this->form_validation->set_value('publicado', $section->publicado?1:0),
				'checked' => $this->form_validation->set_value('publicado', 1),
				'style' => 'margin-top:10px'
			);
					
			/* Load Template */
			$this->template->admin_render('admin/sections/edit', $this->data);
		}
	}

	public function deleteyes($id = null) {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			$this->session->set_flashdata('message', 'Sem Seção de Menu para Exclusão');
			redirect('admin/sections', 'refresh');
		}

		$lixo = R::load("menusection", $id);
		R::trash($lixo);
		$this->session->set_flashdata('message', 'Sessão de Menu Excluída');			

		redirect('admin/sections', 'refresh');
	}

	public function profile($id)
	{
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, lang('menu_users_profile'), 'admin/groups/profile');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Data */
		$id = (int) $id;

		/* Variables */
		$groups = $this->ion_auth->group($id)->row();
	
		/* Data */
		$this->data['menusection'] = R::load("menusection", $id);
	
		/* Load Template */
		$this->template->admin_render('admin/sections/profile', $this->data);
	}

	function activate($id) {
		$id = (int) $id;
	
		$menusection = R::load("menusection", $id);

		$menusection->publicado = 1;
		
		R::store($menusection);
		
		$this->session->set_flashdata('message', "Seção de Menu ativada");
		redirect('admin/sections', 'refresh');
	}

	public function deactivate($id) {
		$id = (int) $id;

		$menusection = R::load("menusection", $id);
		$menusection->publicado = 0;
		
		R::store($menusection);
		
		$this->session->set_flashdata('message', "Seção de Menu desativada");		
		redirect('admin/sections', 'refresh');
	}
}
