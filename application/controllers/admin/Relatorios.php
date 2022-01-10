<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends Admin_Controller {

    public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push('Relatórios');
        $this->data['pageicon'] = 'ul-list';
		$this->data['pagetitle'] = $this->page_title->show();
        
        /* Pega controller */
		$this->anchor = 'admin/'.$this->router->class;
		
        $this->load->helper('configuracao');
        $this->load->helper('utilidades');
        
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Questionário', $this->anchor);
    }
	public function index(){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['error'] = NULL;

            $questionarios = R::find( 'questionarios' );

            /* Carrega os Tipos de Eventos */
			$this->data['questionarios'] = $questionarios;
			
			$this->data['id_check'] = array(
				'name'          => 'id',
				'id'            => 'id_check[]',
				'value'         => null,
				'checked'       => FALSE,
				'style'         => 'margin:10px'
			);
						
			/* Load Template */		
            $this->template->admin_render($this->anchor.'/index', $this->data);
        }
    }
    public function getmes(){      
        header('Content-Type: application/json');
                    
        $sql = "SELECT 
                    COUNT(*) AS total, 
                    MONTH(dagenda) AS mes, 
                    users.first_name AS nome
                FROM agenda         
    
                INNER JOIN users
                ON agenda.idpsico = users.id        
     
                GROUP BY MONTH(dagenda)
            ";        

        $rows = R::getAll($sql);

        $relatorio = $rows;       

        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        } 
      
    }
   

    
    //---fim dos getrel...()-------------
 
}