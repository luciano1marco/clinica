<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class License extends Admin_Controller {

    public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_license'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_license'), 'admin/license');
    }
	public function index()	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Load Template */
            $this->template->admin_render('admin/license/index', $this->data);
        }
	}
}//fim da class
