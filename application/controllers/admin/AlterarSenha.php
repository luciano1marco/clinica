<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class alterarSenha extends Admin_Controller {

	public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('alterarSenha'));
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
			$user_id = $this->session->user_id;
			
            $sql="SELECT * FROM users where id= ".$user_id; 
		    $this->data['alterar'] = R::getAll($sql);
		   

           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			//$this->data['texto_btn_create'] = 'Criar Analises';

			/* Data */
			$this->data['error'] = NULL;

			//$this->data['aparelhos'] = R::findAll('aparelhos');


			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }
    public function edit($id){
		$id = (int) $id;

		if ( ! $this->ion_auth->logged_in() OR ( ! $this->ion_auth->is_admin() && ! ($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, lang('menu_users_edit'), 'admin/users/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Data */
		$user = $this->ion_auth->user($id)->row();
		
		/* Validate form input */
		$this->form_validation->set_rules('password', 'lang:edit_user_validation_company_label', 'required');

		if (isset($_POST) && ! empty($_POST))
		{
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() == TRUE)
			{
				

				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				if ($this->ion_auth->is_admin())
				{
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData))
					{
						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp)
						{
							$this->ion_auth->add_to_group($grp, $id);
						}
					}
				}

				if($this->ion_auth->update($user->id, $data))
				{
					$this->session->set_flashdata('message', $this->ion_auth->messages());

					if ($this->ion_auth->is_admin())
					{
						redirect('admin/alterarSenha', 'refresh');
					}
					else
					{
						redirect('admin', 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());

					if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}
				}
			}
		}

		// display the edit user form
		//$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'class' => 'form-control',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'class' => 'form-control',
			'type' => 'password'
		);

		/* Load Template */
		$this->template->admin_render('admin/alterarSenha/edit', $this->data);
	}
}//fim da class
