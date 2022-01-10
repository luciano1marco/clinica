<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

        /* COMMON :: ADMIN & PUBLIC */
        /* Load */
        $this->load->database();

        /* Data */
        $this->data['lang'] = element($this->config->item('language'), $this->config->item('language_abbr'));
        $this->data['charset'] = $this->config->item('charset');
        $this->data['frameworks_dir'] = $this->config->item('frameworks_dir');
        $this->data['plugins_dir'] = $this->config->item('plugins_dir');
        $this->data['avatar_dir'] = $this->config->item('avatar_dir');

        /* Any mobile device (phones or tablets) */
        if ($this->mobile_detect->isMobile())
        {
            $this->data['mobile'] = TRUE;

            if ($this->mobile_detect->isiOS()){
                $this->data['ios'] = TRUE;
                $this->data['android'] = FALSE;
            }
            elseif ($this->mobile_detect->isAndroidOS())
            {
                $this->data['ios'] = FALSE;
                $this->data['android'] = TRUE;
            }
            else
            {
                $this->data['ios'] = FALSE;
                $this->data['android'] = FALSE;
            }

            if ($this->mobile_detect->getBrowsers('IE')){
                $this->data['mobile_ie'] = TRUE;
            }
            else
            {
                $this->data['mobile_ie'] = FALSE;
            }
        }
        else
        {
            $this->data['mobile'] = FALSE;
            $this->data['ios'] = FALSE;
            $this->data['android'] = FALSE;
            $this->data['mobile_ie'] = FALSE;
        }
	}
}


class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Load */
            $this->load->config('admin/dp_config');
            $this->load->library(['admin/breadcrumbs', 'admin/page_title']);
            $this->load->model('admin/core_model');
            $this->load->helper('menu');
            $this->lang->load(['admin/main_header', 'admin/main_sidebar', 'admin/footer', 'admin/actions']);

            /* Load library function  */
            $this->breadcrumbs->unshift(0, $this->lang->line('menu_dashboard'), 'admin/dashboard');

            /* Data */
            $this->data['title'] = $this->config->item('title');
            $this->data['title_lg'] = $this->config->item('title_lg');
            $this->data['title_mini'] = $this->config->item('title_mini');
            $this->data['admin_prefs'] = $this->prefs_model->admin_prefs();
            $this->data['user_login'] = $this->prefs_model->user_info_login($this->ion_auth->user()->row()->id);

            /* Controla o que carrega de JS e CSS extra para cada model */
            $this->data['includes'] = !empty($this->config->item('includes')) ? $this->config->item('includes') : null;

            if ($this->router->fetch_class() == 'dashboard')
            {
                $this->data['dashboard_alert_file_install'] = $this->core_model->get_file_install();
                $this->data['header_alert_file_install'] = NULL;
            }
            else
            {
                $this->data['dashboard_alert_file_install'] = NULL;
                $this->data['header_alert_file_install'] = NULL; /* << A MODIFIER !!! */
            }

            /* protege area admin */
            $this->load->model("admin/usuario_model");
            $isAdmin = $this->usuario_model->isAdmin($this->session->user_id);
            $this->data['isAdmin'] = $isAdmin;

            /* menu dinamico */
            //$sections = R::findAll("menusection");
            $sections = R::find("menusection", 'publicado = 1');
            $SQLmenu = "select 
                        mi.controller, 
                        mi.descricao, 
                        mi.icone
                        from menuitens mi ";
            
            $itensMenu = array();
            foreach ($sections as $s) {
                if (!$isAdmin) {
                    $where = " INNER JOIN menugroups mg
                                ON mi.id = mg.menu
                                INNER JOIN users_groups ug
                                ON mg.grupo = ug.group_id
                                WHERE ug.user_id = {$this->session->user_id}
                                AND mi.section = {$s->id}";
                } else {
                    $where = " where mi.section = {$s->id}";
                }

                $where_publicado = ' and mi.publicado = 1';
                $where .=  $where_publicado;              
                $itensMenu[$s->descricao] = R::getAll($SQLmenu . $where);
            }
            $this->data['itensMenu'] = $itensMenu;
        }
    }
}


class Public_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
        {
            $this->data['admin_link'] = TRUE;
        }
        else
        {
            $this->data['admin_link'] = FALSE;
        }

        if ($this->ion_auth->logged_in())
        {
            $this->data['logout_link'] = TRUE;
        }
        else
        {
            $this->data['logout_link'] = FALSE;
        }
	}
}
