<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class comunidade extends Admin_Controller {

    public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('comunidade'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');

        /* Breadcrumbs :: Common */
       // $this->breadcrumbs->unshift(1, 'apoiador', 'admin/apoiador');
    }

	public function index()	{  
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* dados  */
           // $this->data['comunidade'] = R::findAll("comunidade");
            /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Criar Comunidade';

			/* Data */
			$this->data['error'] = NULL;

			//$this->data['aparelhos'] = R::findAll('aparelhos');
			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }
}
