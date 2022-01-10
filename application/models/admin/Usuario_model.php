<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->dados = null;
    }


    public function isAdmin($id) {
        $this->carregaDados($id);
        return ($this->dados->admin == 1);
    }

    public function isContador($id) {
        $this->carregaDados($id);
        return ($this->dados->contador == 1);
    }

    private function carregaDados($id) {
        $this->dados = R::load("users", $id);
    }
}
