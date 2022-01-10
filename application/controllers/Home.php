<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

    public function __construct() {
        parent::__construct();
        // Carrega helper URL
        //$this->load->helper("url");
        $this->load->helper('configuracao');
        $this->load->helper('utilidades');
    }
	public function index() {
        $cfg = configuracao();
        $php = configuracao_PHP();

        /* Os dados da Model aqui 
        $dados = array(
            array('id' =>1, 'nome' => 'Arroz'),
            array('id' =>2, 'nome' => 'Feijão'),
            array('id' =>3, 'nome' => 'Massa'),
        );*/

       // $this->data['dados'] = $dados;

        // Caso sistema funcione apenas logado, descomentar a linha abaixo e importar o helper URL no construtor
       // redirect("admin");
        $this->data['modulo_cabecalho'] = $this->load->view('public/includes/header.php', $cfg, TRUE);	
        $this->data['modulo_rodape'] = $this->load->view('public/includes/footer.php',$cfg, TRUE);      
        $this->data['modulo_menu'] = $this->load->view('public/includes/menu.php', $this->data, TRUE);	
        $this->data['modulo_faleconosco'] = $this->load->view('public/includes/fale_conosco.php', $this->data, TRUE);	

        $this->load->view('public/home', $this->data);
	}
}
