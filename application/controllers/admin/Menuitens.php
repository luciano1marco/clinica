<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menuitens extends Admin_Controller {

	public function __construct(){
		parent::__construct();

		/* Title Page :: Common */
		$this->page_title->push("Itens de Menu");
		$this->data['pagetitle'] = $this->page_title->show();

		/* Anchor */
		$this->anchor = 'admin/'.$this->router->class;

		/* Utilidades IE FontAwesome */
		$this->load->helper('utilidades');

		/* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		$this->fa_icons = getFontAwesomeIcons();

		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, "Itens de Menu", 'admin/menuitens');
	}
	public function index()	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			$sql = "select 
						mi.id, 
						mi.descricao, 
						mi.controller, 
						mi.icone, 
						ms.descricao as section,
						mi.publicado
					from menuitens mi
					inner join menusection ms
					on mi.section = ms.id";

			$this->data['menuitens'] = R::getAll($sql);
			
			/* Load Template */
			$this->template->admin_render('admin/menuitens/index', $this->data);
		}
	}
	public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Novo Item de Menu', 'admin/menuitens/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		$this->form_validation->set_rules('controller', 'Controlador', 'required');
		$this->form_validation->set_rules('icone', 'Ícone', 'required');

		if ($this->form_validation->run() == TRUE) {
			$menuitem = R::dispense("menuitens");
			$menuitem->descricao 	= ucfirst($this->input->post("descricao"));
			$menuitem->controller 	= $this->input->post("controller");
			$menuitem->icone 		= strtolower($this->input->post('icone'));
			$menuitem->section 		= $this->input->post("section");
			$menuitem->publicado 	= !empty($this->input->post("publicado")) ? 1: 0;
			
			$idMenu = R::store($menuitem);

			$grupos = $this->input->post("groups");

			if ($grupos != null && $idMenu != null) {
				foreach ($grupos as $g) {
					try{
						$mg = R::dispense("menugroups");
						$mg->grupo = $g;
						$mg->menu = $idMenu;
						R::store($mg);

						$this->session->set_flashdata('message', 'Item de Menu criado');
					}
					catch(Exception $e) {
						R::rollback();
						$this->session->set_flashdata('message', 'Não foi possível adicionar Item');
					}          		
				}
			}
			
			redirect('admin/menuitens', 'refresh');
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

			$this->data['controller'] = array(
				'name'  => 'controller',
				'id'    => 'controller',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('controller'),
			);

			$this->data['icone'] = array(
				'name'  			=> 'icone',
				'id'    			=> 'icone',
				'options'  			=> 'null',
				'class' 			=> 'form-control selectpicker show-tick',
				'value' 			=> $this->form_validation->set_value('icone'),
				'data-live-search' 	=> TRUE,						
				'title' 			=> 'Escolha um Ícone',
				'options'			=> $this->fa_icons,
				'data-style' 		=> 'btn-primary'					
			);	
			
			$this->data['section'] = array(
				'name'  => 'section',
				'id'    => 'section',
				'class' => 'form-control',
				'options' => $this->getSections(),
				'selected' => $this->form_validation->set_value('section'),
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

			$this->data['groups'] = R::findAll("groups");
			
			/* Load Template */
			$this->template->admin_render('admin/menuitens/create', $this->data);
		}
	}
	public function edit($id) {
		$id = (int) $id;

		$this->data['id'] = $id;

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Novo Item de Menu', 'admin/menuitens/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		$this->form_validation->set_rules('controller', 'Controlador', 'required');
		$this->form_validation->set_rules('icone', 'Ícone', 'required');

		$menuitem = R::load("menuitens", $id);
		if ($this->form_validation->run() == TRUE) {
			R::begin();
			try {
				$menuitem->descricao 	= ucfirst($this->input->post("descricao"));
				$menuitem->controller 	= $this->input->post("controller");
				$menuitem->icone 		= strtolower($this->input->post('icone'));
				$menuitem->section 		= $this->input->post("section");
				$menuitem->publicado 	= !empty($this->input->post("publicado")) ? 1: 0;

				R::store($menuitem);

				$gruposLixo = R::findAll("menugroups", "menu = {$id}");
				R::trashAll($gruposLixo);

				$grupos = $this->input->post("groups");
				if ($grupos != null) {
					foreach ($grupos as $g) {
						$mg = R::dispense("menugroups");
						$mg->grupo = $g;
						$mg->menu = $id;
						R::store($mg);
					}
				}
				R::commit();

				$this->session->set_flashdata('message', 'Item de Menu atualizado');
			} catch (Exception $e) {
				R::rollback();

				$this->session->set_flashdata('message', 'Não foi possível adicionar Item');
			}

			redirect('admin/menuitens', 'refresh');
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['descricao'] = array(
				'name'  => 'descricao',
				'id'    => 'descricao',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('descricao', $menuitem->descricao),
			);

			$this->data['controller'] = array(
				'name'  => 'controller',
				'id'    => 'controller',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('controller', $menuitem->controller),
			);

			$this->data['icone'] = array(
				'name'  			=> 'icone',
				'id'    			=> 'icone',
				'options'  			=> 'null',
				'class' 			=> 'form-control selectpicker show-tick',
				'selected' 			=> $this->form_validation->set_value('icone',$menuitem->icone),
				'data-live-search' 	=> TRUE,						
				'title' 			=> 'Escolha um Ícone',
				'options'			=> $this->fa_icons,
				'value' 			=> $this->form_validation->set_value('icone', $menuitem->icone),
				'data-style' 		=> 'btn-primary'					
			);	

			$this->data['section'] = array(
				'name'  => 'section',
				'id'    => 'section',
				'class' => 'form-control',
				'options' => $this->getSections(),
				'selected' => $this->form_validation->set_value('section', $menuitem->section),
			);

			$this->data['publicado'] = array(
				'name' 	=> 'publicado',
				'id'    => 'publicado',
				'class' => 'icheck',
				'type'  => 'checkbox',
				'value' => $this->form_validation->set_value('publicado', $menuitem->publicado?1:0),
				'checked' => $this->form_validation->set_value('publicado', 1),
				'style' => 'margin-top:10px'
			);

			$this->data['groups'] = R::findAll("groups");
			$this->data['currentGroups'] = R::findAll("menugroups", "menu = {$id}");
			
			/* Load Template */
			$this->template->admin_render('admin/menuitens/edit', $this->data);
		}
	}
	public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/menuitens', 'refresh');
		}

		$lixo = R::load("menuitens", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item de Menu removido");

		redirect('admin/menuitens', 'refresh');
	}
	private function getSections() {
		$ret = array();
		$data = R::findAll("menusection");
		foreach ($data as $d) {
			$ret[$d->id] = $d->descricao;
		}
		return $ret;
	}
	public function profile($id){
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, lang('menu_users_profile'), 'admin/menuitens/profile');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Data */
		$id = (int) $id;

		/* Variables */
		$groups = $this->ion_auth->group($id)->row();
	
		/* Data */
		$this->data['menuitens'] = R::load("menuitens", $id);
	
		/* Load Template */
		$this->template->admin_render('admin/menuitens/profile', $this->data);
	}
	function activate($id) {
		$id = (int) $id;
	
		$menuitens = R::load("menuitens", $id);

		$menuitens->publicado = 1;
		
		R::store($menuitens);
		
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/menuitens', 'refresh');
	}
	public function deactivate($id) {
		$id = (int) $id;

		$menuitens = R::load("menuitens", $id);
		$menuitens->publicado = 0;
		
		R::store($menuitens);
		
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/menuitens', 'refresh');
	}
}//fim da class
